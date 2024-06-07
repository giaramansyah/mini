<?php

namespace App\Http\Controllers;

use App\Helper\MailHelper;
use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Http\Mail\CreatePassword;
use App\Models\LogAccounts;
use App\Models\Menus;
use App\Models\ParentMenus;
use App\Models\PrivilegeGroups;
use App\Models\Accounts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    protected $_create = 'ACCR';
    protected $_update = 'ACUP';
    protected $_delete = 'ACRM';
    protected $_readall = 'ACRA';
    protected $_readid = 'ACRD';

    public function index()
    {
        if (!$this->hasPrivilege($this->_readall)) {
            return abort(401);
        }

        return view('contents.account.index', ['has_create' => $this->hasPrivilege($this->_create)]);
    }

    public function form($id = null)
    {
        if ($id === null && !$this->hasPrivilege($this->_create)) {
            return abort(401);
        }

        if ($id !== null && !$this->hasPrivilege($this->_update)) {
            return abort(401);
        }

        $privigroupArr = array();
        $privigroup = PrivilegeGroups::select(['id', 'name'])->whereNotIn('name', config('global.privilege_group'))->get();
        foreach ($privigroup as $value) {
            $privigroupArr[] = [
                'id' => $value->id,
                'text' => $value->name
            ];
        }

        $view = [
            'privigroupArr' => $privigroupArr,
            'action' => route('setting.account.post', ['action' => config('global.action.form.add'), 'id' => 0]),
            'mandatory' => $this->hasPrivilege($this->_create)
        ];

        if ($id !== null) {
            $plainId = SecureHelper::unsecure($id);
            if (!$plainId) {
                return abort(404);
            }

            $account = Accounts::find($plainId)->toArray();

            if (!$account) {
                return abort(404);
            }

            $view['action'] = route('setting.account.post', ['action' => config('global.action.form.edit'), 'id' => $id]);
            $view['mandatory'] = $this->hasPrivilege($this->_update);

            $view = array_merge($account, $view);
        }

        return view('contents.account.form', $view);
    }

    public function view(Request $request, $id)
    {
        if (!$this->hasPrivilege($this->_readid)) {
            return abort(401);
        }

        $plainId = SecureHelper::unsecure($id);
        if (!$plainId) {
            return abort(404);
        }

        $account = Accounts::find($plainId)->toArray();
        if (!$account) {
            return abort(404);
        }

        $response = new ResponseHelper($this->_readid);

        $privilegeArr = array();
        $modulesArr = array_combine(config('global.modules.code'), config('global.modules.desc'));
        $parentmenus = ParentMenus::select(['id', 'alias'])->where('is_active', 1)->get()->toArray();
        foreach ($parentmenus as $key => $value) {
            $privilegeArr[$key] = [
                'text' => __('label.navigation.parent_menu.' . $value['alias']),
                'menus' => array()
            ];
            $menus = ParentMenus::find($value['id'])->menus()->select(['id', 'alias'])->where('is_active', 1)->get()->toArray();
            foreach ($menus as $index => $val) {
                if (in_array($val['alias'], config('global.menu'))) {
                    continue;
                }

                $privilegeArr[$key]['menus'][$index] = [
                    'text' => __('label.navigation.menu.' . $val['alias']),
                    'privileges' => array()
                ];

                $items = array_map(function ($val) {
                    array();
                }, $modulesArr);

                $privilges = Menus::find($val['id'])->privileges()->select('id', 'modules')->get()->toArray();

                foreach ($privilges as $v) {
                    $items[$v['modules']] = $v['id'];
                }

                $privilegeArr[$key]['menus'][$index]['privileges'] = $items;
            }
        }

        $groups = PrivilegeGroups::find($account['privilege_group_id'])->first();
        $privileges = $groups->privileges()->get()->toArray();
        $account['privileges'] = array_column($privileges, 'id');
        $account['group_name'] = $groups->name;
        $account['group_desc'] = $groups->description;

        $activities = LogAccounts::where('account_id', $plainId)->orderBy('created_at', 'desc')->limit(10)->get()->toArray();
        $account['activities'] = $activities;

        $view = [
            'privilegeArr' => $privilegeArr,
            'modulesArr' => $modulesArr,
            'has_update' => $this->hasPrivilege($this->_update),
            'has_delete' => $this->hasPrivilege($this->_delete)
        ];

        $view = array_merge($account, $view);

        $response->setResponse(1, __('messages.account.data'), 'Username : ' . $account['username']);
        $response->setData($view);

        $response->getResponse($request, Auth::user());

        return view('contents.account.view', $view);
    }

    public function list(Request $request)
    {
        $response = new ResponseHelper($this->_readall);

        if ($request->ajax()) {
            $data = Accounts::where('is_trash', 0)->where('id', '!=', Auth::user()->id)->whereNotIn('username', config('global.accounts'))->orderBy('id');
            // $data = Accounts::where('is_trash', 0)->orderBy('id');
            $table = DataTables::eloquent($data);
            $table->addIndexColumn();
            $table->addColumn('account', function ($row) {
                return $row->fullname . ' (<a href="' . route('setting.account.view', ['id' => SecureHelper::secure($row->id)]) . '">' . $row->username . '</a>)';
            });
            $table->addColumn('status', function ($row) {
                if ($row->is_new) {
                    $column = '<small class="badge badge-info"><i class="fas fa-user"></i> ' .  __('label.account.view.new') . '</small>';
                } elseif ($row->is_locked) {
                    $column = '<small class="badge badge-warning"><i class="fas fa-lock"></i> ' .  __('label.account.view.locked') . '</small>';
                } elseif (!$row->is_active) {
                    $column = '<small class="badge badge-danger"><i class="fas fa-ban"></i> ' .  __('label.account.view.deactive') . '</small>';
                } else {
                    $column = '<small class="badge badge-success"><i class="fas fa-check"></i> ' .  __('label.account.view.active') . '</small>';
                }

                return $column;
            });
            $table->addColumn('action', function ($row) {
                $column = '';

                if ($this->hasPrivilege($this->_update)) {
                    $param = [
                        'action' => route('setting.account.edit', ['id' => SecureHelper::secure($row->id)]),
                        'class' => 'btn-outline-info btn-xs mr-2',
                        'icon' => 'fas fa-pen',
                        'label' => __('label.button.edit')
                    ];
                    $column .= View::make('partials.button.default', $param);
                }

                if ($this->hasPrivilege($this->_delete)) {
                    $param = [
                        'action' => route('setting.account.post', ['action' => config('global.action.form.delete'), 'id' => SecureHelper::secure($row->id)]),
                        'class' => 'btn-xs',
                        'source' => 'table',
                        'label' => __('label.button.delete')
                    ];
                    $column .= View::make('partials.button.delete', $param);
                }

                if ($row->is_login) {
                    $column .= '<button type="button" class="btn btn-lazy-control btn-xs btn-outline-primary ml-2"
                    data-button="button-action" data-action="' . route('setting.account.post', ['action' => config('global.action.form.logout'), 'id' =>
                    SecureHelper::secure($row->id)]) . '" data-method="view" data-dial="form" data-source="table"
                    data-intent="#modalForceLogout">
                    <i class="fas fa-power-off"></i> ' . __('label.button.logout') . '
                  </button>';
                }

                return $column;
            });
            $table->rawColumns(['status', 'account', 'action']);

            $response->setResponse(1, __('messages.account.data'));
            $response->setData($table->toJson());
        } else {
            $response->setResponse(1, __('messages.account.data.failed'));
        }

        $response->getResponse($request, Auth::user());

        return $response->dataResponse();
    }

    public function post(Request $request, $action, $id)
    {
        if (!in_array($action, config('global.action.form'))) {
            $response = new ResponseHelper('UKWN');
            $response->setResponse(0, __('messages.error.404'), 'Unknown post action in module privilege : ' . $action);
        } else {
            if (in_array($action, Arr::only(config('global.action.form'), ['add', 'edit']))) {
                if ($action == config('global.action.form.add')) {
                    $response = new ResponseHelper($this->_create);
                } else {
                    $response = new ResponseHelper($this->_update);
                }

                $param = SecureHelper::unpack($request->input('json'));
                if (!is_array($param)) {
                    $response->setResponse(0, __('messages.error.404'), 'Bad paramater pequest');
                } else {
                    $validator = Validator::make($param, [
                        'username' => 'required|alpha_num',
                        'first_name' => 'required|alpha_num',
                        'email' => 'required|email:rfc,dns',
                        'privilege_group_id' => 'required|numeric',
                    ]);

                    if ($validator->fails()) {
                        $errors = $validator->errors();
                        foreach ($errors->all() as $error) {
                            $response->setResponse(0, __($error));
                        }
                    } else {
                        if ($action == config('global.action.form.add')) {
                            if (!$this->hasPrivilege($this->_create)) {
                                $response->setResponse(2, __('messages.error.401'));
                            } else {
                                $account = Accounts::where('username', $param['username'])->where('is_trash', 0)->first();
                                if (!$account) {
                                    $pass_hash = md5(sha1(date('ymdHis')));
                                    $password = $param['username'] . $param['username'] . $pass_hash . $pass_hash;
                                    $hash = md5(sha1(date('ymdHis') . $param['username']));
                                    $now = Carbon::now();
                                    $account = Accounts::create([
                                        'first_name' => $param['first_name'],
                                        'last_name' => $param['last_name'],
                                        'email' => $param['email'],
                                        'username' => $param['username'],
                                        'password' => $password,
                                        'hash' => $hash,
                                        'is_cashier' => isset($param['is_cashier']) ? $param['is_cashier'] : 0,
                                        'is_author' => isset($param['is_author']) ? $param['is_author'] : 0,
                                        'password_request' => $hash,
                                        'last_password_request' => $now->toDateTimeString(),
                                        'expire_password_request' => $now->addHours(6)->toDateTimeString(),
                                        'created_by' => Auth::user()->id,
                                        'updated_by' => Auth::user()->id,
                                        'privilege_group_id' => $param['privilege_group_id'],
                                    ]);
                                    if ($account->id) {
                                        $content = [
                                            'to' => $param['email'],
                                            'subject' => 'Verify Account',
                                            'title' => 'Verify Account',
                                            'link' => route('password.new', ['id' => SecureHelper::secure($account->id), 'hash' => SecureHelper::secure($hash . $account->id)]),
                                            'button' => 'Verify Account',
                                            'executor' => Auth::user()
                                        ];
                                        $mail = new CreatePassword($content);

                                        MailHelper::sendMail($mail, $content);

                                        $response->setResponse(1, __('messages.account.add.success'), 'Username : ' . $param['username']);
                                        $response->setRedirect(route('setting.account.index'));
                                    } else {
                                        $response->setResponse(2, __('messages.account.add.failed'), 'Username : ' . $param['username']);
                                    }
                                } else {
                                    $response->setResponse(2, __('messages.account.add.exist'));
                                }
                            }
                        } else {
                            if (!$this->hasPrivilege($this->_update)) {
                                $response->setResponse(2, __('messages.error.401'));
                            } else {
                                $plainId = SecureHelper::unsecure($id);
                                if (!$plainId) {
                                    $response->setResponse(0, __('messages.error.404'), 'Bad paramater id pequest');
                                } else {
                                    $account = Accounts::find($plainId);
                                    $account->first_name = $param['first_name'];
                                    $account->last_name = $param['last_name'];
                                    $account->email = $param['email'];
                                    $account->privilege_group_id = $param['privilege_group_id'];
                                    $account->is_cashier = isset($param['is_cashier']) ? $param['is_cashier'] : 0;
                                    $account->is_author = isset($param['is_author']) ? $param['is_author'] : 0;
                                    $account->updated_by = Auth::user()->id;
                                    $account->updated_at = Carbon::now()->toDateTimeString();

                                    if ($account->save()) {
                                        $response->setResponse(1, __('messages.account.edit.success'), 'Username : ' . $param['username']);
                                        $response->setRedirect(route('setting.account.index'));
                                    } else {
                                        $response->setResponse(2, __('messages.account.edit.failed'), 'Username : ' . $param['username']);
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                if ($action == config('global.action.form.delete')) {
                    $response = new ResponseHelper($this->_delete);
                } else {
                    $response = new ResponseHelper($this->_update);
                }

                if (!$this->hasPrivilege($this->_delete)) {
                    $response->setResponse(2, __('messages.error.401'));
                } else {
                    $plainId = SecureHelper::unsecure($id);
                    if (!$plainId) {
                        $response->setResponse(0, __('messages.error.404'), 'Bad paramater id pequest');
                    } else {
                        $account = Accounts::find($plainId);

                        if ($action == config('global.action.form.delete')) {
                            $account->is_trash = 1;
                            if ($account->save()) {
                                $response->setResponse(1, __('messages.account.delete.success'), 'Username : ' . $account->username);
                                $response->setRedirect(route('setting.account.index'));
                            } else {
                                $response->setResponse(2, __('messages.account.delete.failed'), 'Username : ' . $account->username);
                            }
                        } else {
                            if ($action == config('global.action.form.able')) {
                                if ($account->is_active) {
                                    $account->is_active = 0;
                                } else {
                                    $account->is_active = 1;
                                }
                                $account->updated_by = Auth::user()->id;
                                $account->updated_at = Carbon::now()->toDateTimeString();
                                if ($account->save()) {
                                    if ($account->is_active) {
                                        $response->setResponse(1, __('messages.account.active.activate'), 'Activate : ' . $account->username);
                                    } else {
                                        $response->setResponse(1, __('messages.account.active.deactivate'), 'Deactivate : ' . $account->username);
                                    }
                                    $response->setRedirect(route('setting.account.view', ['id' => $id]));
                                } else {
                                    $response->setResponse(2, __('messages.account.active.failed'), 'Activation : ' . $account->username);
                                }
                            } elseif ($action == config('global.action.form.lock')) {
                                if ($account->is_locked) {
                                    $account->is_locked = 0;
                                    $account->login_attempt = 0;
                                } else {
                                    $account->is_locked = 1;
                                }
                                $account->updated_by = Auth::user()->id;
                                $account->updated_at = Carbon::now()->toDateTimeString();
                                if ($account->save()) {
                                    if ($account->is_locked) {
                                        $response->setResponse(1, __('messages.account.lock.locked'), 'Lock : ' . $account->username);
                                    } else {
                                        $response->setResponse(1, __('messages.account.lock.unlocked'), 'Unlock : ' . $account->username);
                                    }
                                    $response->setRedirect(route('setting.account.view', ['id' => $id]));
                                } else {
                                    $response->setResponse(2, __('messages.account.lock.failed'), 'Lock Username : ' . $account->username);
                                }
                            } elseif ($action == config('global.action.form.logout')) {
                                $account->is_login = 0;
                                $account->remember_token = null;
                                if ($account->save()) {
                                    $response->setResponse(1, __('messages.account.logout.success'), 'Force Logout : ' . $account->username);
                                    $response->setRedirect(route('setting.account.view', ['id' => $id]));
                                } else {
                                    $response->setResponse(2, __('messages.account.logout.failed'), 'Force Logout : ' . $account->username);
                                }
                            }
                        }
                    }
                }
            }
        }

        $response->getResponse($request, Auth::user());
        return $response->jsonResponse();
    }
}
