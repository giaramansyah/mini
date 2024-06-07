<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\LogAccounts;
use App\Models\Menus;
use App\Models\ParentMenus;
use App\Models\PrivilegeGroups;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $_readid = 'ACRD';

    public function index(Request $request)
    {
        $plainId = Auth::user()->id;

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
        ];

        $view = array_merge($account, $view);

        $response->setResponse(1, __('messages.account.data'), 'Profile');
        $response->setData($view);

        $response->getResponse($request, Auth::user());

        return view('contents.profile.index', $view);
    }
}
