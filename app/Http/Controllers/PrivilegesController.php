<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Models\MapPrivileges;
use App\Models\ParentMenus;
use App\Models\Privileges;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PrivilegesController extends Controller
{
    protected $_create = 'PRCR';
    protected $_update = 'PRUP';
    protected $_delete = 'PRRM';
    protected $_readall = 'PRRA';

    public function index()
    {
        if (!$this->hasPrivilege($this->_readall)) {
            return abort(401);
        }

        return view('contents.privilege.index', ['has_create' => $this->hasPrivilege($this->_create)]);
    }

    public function form($id = null)
    {
        if ($id === null && !$this->hasPrivilege($this->_create)) {
            return abort(401);
        }

        if ($id !== null && !$this->hasPrivilege($this->_update)) {
            return abort(401);
        }

        $menuArr = array();
        $parentmenus = ParentMenus::select(['id', 'alias'])->where('is_active', 1)->get()->toArray();
        foreach ($parentmenus as $key => $value) {
            $menuArr[$key] = [
                'id' => $value['id'],
                'text' => __('label.navigation.parent_menu.' . $value['alias']),
                'items' => array()
            ];
            $menus = ParentMenus::find($value['id'])->menus()->select(['id', 'alias'])->where('is_active', 1)->get()->toArray();
            foreach ($menus as $index => $val) {
                $menuArr[$key]['items'][$index] = [
                    'id' => $val['id'],
                    'text' => __('label.navigation.menu.' . $val['alias'])
                ];
            }
        }

        $modulesArr = array();
        $modules = array_combine(config('global.modules.code'), config('global.modules.desc'));
        foreach ($modules as $key => $value) {
            $modulesArr[] = [
                'id' => $key,
                'text' => __($value)
            ];
        }

        $view = [
            'menuArr' => $menuArr,
            'modulesArr' => $modulesArr,
            'action' => route('setting.privilege.post', ['action' => config('global.action.form.add'), 'id' => 0]),
            'mandatory' => $this->hasPrivilege($this->_create)
        ];

        if ($id !== null) {
            $plainId = SecureHelper::unsecure($id);
            if (!$plainId) {
                return abort(404);
            }

            $privilege = Privileges::find($plainId)->toArray();

            if (!$privilege) {
                return abort(404);
            }

            $view['action'] = route('setting.privilege.post', ['action' => config('global.action.form.edit'), 'id' => $id]);
            $view['mandatory'] = $this->hasPrivilege($this->_update);

            $view = array_merge($privilege, $view);
        }

        return view('contents.privilege.form', $view);
    }

    public function list(Request $request)
    {
        $response = new ResponseHelper($this->_readall);

        if ($request->ajax()) {
            $data = Privileges::select(['id', 'code', 'modules', 'desc'])->orderBy('id');
            $table = DataTables::eloquent($data);
            $table->addIndexColumn();
            $table->addColumn('menu', function ($row) {
                return __('label.navigation.menu.' . $row->getMenuAttribute()['alias']);
            });
            $table->addColumn('action', function ($row) {
                $column = '';

                if ($this->hasPrivilege($this->_update)) {
                    $param = [
                        'action' => route('setting.privilege.edit', ['id' => SecureHelper::secure($row->id)]),
                        'class' => 'btn-outline-info btn-xs mr-2',
                        'icon' => 'fas fa-pen',
                        'label' => __('label.button.edit')
                    ];
                    $column .= View::make('partials.button.default', $param);
                }

                // if ($this->hasPrivilege($this->_delete)) {
                //     $param = [
                //         'action' => route('setting.privilege.post', ['action' => config('global.action.form.delete'), 'id' => SecureHelper::secure($row->id)]),
                //         'class' => 'btn-xs',
                //         'source' => 'table',
                //         'label' => __('label.button.delete')
                //     ];
                //     $column .= View::make('partials.button.delete', $param);
                // }

                return $column;
            });
            $table->rawColumns(['menu', 'action']);

            $response->setResponse(1, __('messages.privilege.data.success'));
            $response->setData($table->toJson());
        } else {
            $response->setResponse(1, __('messages.privilege.data.failed'));
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
                        'code' => 'required|alpha_num',
                        'menu_id' => 'required|numeric',
                        'modules' => 'required|numeric',
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
                                $privilege = Privileges::where('code', $param['code'])->first();

                                if (!$privilege) {
                                    $privilege = Privileges::create([
                                        'code' => Str::upper($param['code']),
                                        'menu_id' => $param['menu_id'],
                                        'modules' => $param['modules'],
                                        'desc' => $param['desc'],
                                    ]);
                                    if ($privilege->id) {
                                        MapPrivileges::create([
                                            'privilege_group_id' => 1,
                                            'privilege_id' => $privilege->id,
                                        ]);
                                        $response->setResponse(1, __('messages.privilege.add.success'));
                                        $response->setRedirect(route('setting.privilege.index'));
                                    } else {
                                        $response->setResponse(2, __('messages.privilege.add.failed'));
                                    }
                                } else {
                                    $response->setResponse(2, __('messages.privilege.add.exist'));
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
                                    $privilege = Privileges::find($plainId);
                                    $privilege->menu_id = $param['menu_id'];
                                    $privilege->modules = $param['modules'];
                                    $privilege->desc = $param['desc'];

                                    if ($privilege->save()) {
                                        $response->setResponse(1, __('messages.privilege.edit.success'));
                                        $response->setRedirect(route('setting.privilege.index'));
                                    } else {
                                        $response->setResponse(2, __('messages.privilege.edit.failed'));
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $response = new ResponseHelper($this->_delete);
                if (!$this->hasPrivilege($this->_delete)) {
                    $response->setResponse(2, __('messages.error.401'));
                } else {
                    $plainId = SecureHelper::unsecure($id);
                    if (!$plainId) {
                        $response->setResponse(0, __('messages.error.404'), 'Bad paramater id pequest');
                    } else {
                        $privilege = Privileges::find($plainId);

                        if ($privilege->forceDelete()) {
                            MapPrivileges::where('privilege_id', $plainId)->forceDelete();
                            $response->setResponse(1, __('messages.privilege.delete.success'));
                            $response->setRedirect(route('setting.privilege.index'));
                        } else {
                            $response->setResponse(2, __('messages.privilege.delete.failed'));
                        }
                    }
                }
            }
        }

        $response->getResponse($request, Auth::user());
        return $response->jsonResponse();
    }
}
