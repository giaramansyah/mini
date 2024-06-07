<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Models\MapPrivileges;
use App\Models\Menus;
use App\Models\ParentMenus;
use App\Models\PrivilegeGroups;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class PrivigroupController extends Controller
{
    protected $_create = 'PGCR';
    protected $_update = 'PGUP';
    protected $_delete = 'PGRM';
    protected $_readall = 'PGRA';

    public function index()
    {
        if (!$this->hasPrivilege($this->_readall)) {
            return abort(401);
        }

        return view('contents.privigroup.index', ['has_create' => $this->hasPrivilege($this->_create)]);
    }

    public function form($id = null)
    {
        if ($id === null && !$this->hasPrivilege($this->_create)) {
            return abort(401);
        }

        if ($id !== null && !$this->hasPrivilege($this->_update)) {
            return abort(401);
        }

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

        $view = [
            'privilegeArr' => $privilegeArr,
            'modulesArr' => $modulesArr,
            'action' => route('setting.privigroup.post', ['action' => config('global.action.form.add'), 'id' => 0]),
            'mandatory' => $this->hasPrivilege($this->_create)
        ];

        if ($id !== null) {
            $plainId = SecureHelper::unsecure($id);
            if (!$plainId) {
                return abort(404);
            }

            $privigroup = PrivilegeGroups::find($plainId)->toArray();

            if (!$privigroup) {
                return abort(404);
            }

            $privileges = PrivilegeGroups::find($plainId)->privileges()->get()->toArray();
            $privigroup['privileges'] = array_column($privileges, 'id');

            $view['action'] = route('setting.privigroup.post', ['action' => config('global.action.form.edit'), 'id' => $id]);
            $view['mandatory'] = $this->hasPrivilege($this->_update);

            $view = array_merge($privigroup, $view);
        }

        return view('contents.privigroup.form', $view);
    }

    public function list(Request $request)
    {
        $response = new ResponseHelper($this->_readall);

        if ($request->ajax()) {
            $data = PrivilegeGroups::select(['id', 'name', 'description', 'updated_at'])->whereNotIn('name', config('global.privilege_group'))->orderBy('id');
            $table = DataTables::eloquent($data);
            $table->addIndexColumn();
            $table->addColumn('action', function ($row) {
                $column = '';

                if ($this->hasPrivilege($this->_update)) {
                    $param = [
                        'action' => route('setting.privigroup.edit', ['id' => SecureHelper::secure($row->id)]),
                        'class' => 'btn-outline-info btn-xs mr-2',
                        'icon' => 'fas fa-pen',
                        'label' => __('label.button.edit')
                    ];
                    $column .= View::make('partials.button.default', $param);
                }

                if ($this->hasPrivilege($this->_delete)) {
                    $param = [
                        'action' => route('setting.privigroup.post', ['action' => config('global.action.form.delete'), 'id' => SecureHelper::secure($row->id)]),
                        'class' => 'btn-xs',
                        'source' => 'table',
                        'label' => __('label.button.delete')
                    ];
                    $column .= View::make('partials.button.delete', $param);
                }

                return $column;
            });
            $table->rawColumns(['menu', 'action']);

            $response->setResponse(1, __('messages.privigroup.data'));
            $response->setData($table->toJson());
        } else {
            $response->setResponse(1, __('messages.privigroup.data.failed'));
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
                        'name' => 'required|alpha_num',
                        'privilege_id' => 'required',
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
                                $privigroup = PrivilegeGroups::where('name', $param['name'])->first();
                                if (!$privigroup) {
                                    $privigroup = PrivilegeGroups::create([
                                        'name' => Str::upper($param['name']),
                                        'description' => $param['description'],
                                        'created_by' => Auth::user()->id,
                                        'updated_by' => Auth::user()->id,
                                    ]);
                                    if ($privigroup->id) {
                                        if (!is_array($param['privilege_id'])) {
                                            $param['privilege_id'] =  array($param['privilege_id']);
                                        }
                                        foreach ($param['privilege_id'] as $value) {
                                            MapPrivileges::create([
                                                'privilege_group_id' => $privigroup->id,
                                                'privilege_id' => $value,
                                            ]);
                                        }
                                        $response->setResponse(1, __('messages.privigroup.add.success'), 'Privilege Group : ' . $param['name']);
                                        $response->setRedirect(route('setting.privigroup.index'));
                                    } else {
                                        $response->setResponse(2, __('messages.privigroup.add.failed'), 'Privilege Group : ' . $param['name']);
                                    }
                                } else {
                                    $response->setResponse(2, __('messages.privigroup.add.exist'));
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
                                    $privigroup = PrivilegeGroups::find($plainId);
                                    $privigroup->name = Str::upper($param['name']);
                                    $privigroup->description = $param['description'];
                                    $privigroup->updated_at = Carbon::now()->toDateTimeString();

                                    if ($privigroup->save()) {
                                        $map = MapPrivileges::where('privilege_group_id', $plainId);
                                        $map->forceDelete();

                                        if (!is_array($param['privilege_id'])) {
                                            $param['privilege_id'] =  array($param['privilege_id']);
                                        }
                                        foreach ($param['privilege_id'] as $value) {
                                            MapPrivileges::create([
                                                'privilege_group_id' => $privigroup->id,
                                                'privilege_id' => $value,
                                            ]);
                                        }

                                        $response->setResponse(1, __('messages.privigroup.edit.success'), 'Privilege Group : ' . $param['name']);
                                        $response->setRedirect(route('setting.privigroup.index'));
                                    } else {
                                        $response->setResponse(2, __('messages.privigroup.edit.failed'), 'Privilege Group : ' . $param['name']);
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
                        $privilege = PrivilegeGroups::find($plainId);
                        $name = $privilege->name;

                        if ($privilege->forceDelete()) {
                            MapPrivileges::where('privilege_group_id', $plainId)->forceDelete();
                            $response->setResponse(1, __('messages.privigroup.delete.success'), 'Privilege Group : ' . $name);
                            $response->setRedirect(route('setting.privigroup.index'));
                        } else {
                            $response->setResponse(2, __('messages.privigroup.delete.failed'), 'Privilege Group : ' . $name);
                        }
                    }
                }
            }
        }

        $response->getResponse($request, Auth::user());
        return $response->jsonResponse();
    }
}
