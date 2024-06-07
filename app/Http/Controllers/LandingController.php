<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Models\ParentMenus;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function auth(Request $request)
    {
        $response = new ResponseHelper('AUTH');
        $param = SecureHelper::unpack($request->input('json'));

        if (is_array($param)) {
            $validator = Validator::make($param, [
                'username' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                foreach ($errors->all() as $error) {
                    $response->setResponse(0, __($error));
                }
            } else {
                $account = Accounts::where('username', $param['username'])->where('is_trash', 0)->first();
                if ($account) {
                    $password = $account->username . $param['password'] . $account->hash;
                    if (Hash::check($password, $account->password)) {
                        if (!$account->is_active) {
                            $response->setResponse(0, __('messages.login.disabled'));
                        } elseif ($account->is_locked) {
                            $response->setResponse(0, __('messages.login.locked'));
                        } elseif ($account->is_login) {
                            $response->setResponse(0, __('messages.login.logged'));
                        } else {
                            $remember = isset($param['remember']) ? true : false;
                            if (Auth::attempt(['username' => $param['username'], 'password' => $password], $remember)) {
                                $privileges = $account->privilegeGroup()->first()->privileges()->select('code', 'menu_id')->where('is_active', 1)->get()->toArray();
                                $navigations = $this->getNavigation(array_unique(array_column($privileges, 'menu_id')));
                                session(['privileges' => array_column($privileges, 'code'), 'navigation' => $navigations]);
                                $account->is_login = 1;
                                $account->last_login = Carbon::now();
                                $response->setResponse(1, __('messages.login.welcome', ['name' => $account->getFullnameAttribute()]));
                                $response->setRedirect(route('home'));
                            } else {
                                if ($account->login_attempt < 4) {
                                    $account->login_attempt += 1;
                                    $response->setResponse(0, __('messages.login.invalid'));
                                } else {
                                    $account->is_locked = 1;
                                    $response->setResponse(0, __('messages.login.locked'));
                                }
                            }
                            $account->save();
                        }
                    } else {
                        if($account->is_new) {
                            $response->setResponse(0, __('messages.login.invalid'));
                        } else {
                            if ($account->login_attempt < 4) {
                                $account->login_attempt += 1;
                                $response->setResponse(0, __('messages.login.invalid'));
                            } else {
                                $account->is_locked = 1;
                                $response->setResponse(0, __('messages.login.locked'));
                            }
                            $account->save();
                        }
                    }
                } else {
                    $response->setResponse(0, __('messages.login.unregister'));
                }
            }
        }

        $response->getResponse($request, Auth::user());
        return $response->jsonResponse();
    }

    public function logout(Request $request)
    {
        $response = new ResponseHelper('LOUT');

        $account = Accounts::find(Auth::user()->id);
        $account->is_login = 0;
        $account->remember_token = null;
        $account->save();

        $response->setResponse(1, __('Logout success'));

        Session::forget(['privileges', 'navigation']);
        Auth::logout();

        $response->getResponse($request, $account);
        return redirect(route('auth.index'));
    }

    private function getNavigation($array)
    {
        $navigations = array();
        $parentmenus = ParentMenus::where('is_active', 1)->orderBy('order', 'asc')->get();
        foreach ($parentmenus as $parentmenu) {
            $menus = $parentmenu->menus()->whereIn('id', $array)->where('is_active', 1)->orderBy('order', 'asc')->get();
            foreach ($menus as $menu) {
                if (!array_key_exists($parentmenu->alias, $navigations)) {
                    $navigations[$parentmenu->alias] = array(
                        'alias' => $parentmenu->alias,
                        'icon' => $parentmenu->icon,
                        'menus' => array()
                    );
                }

                $navigations[$parentmenu->alias]['menus'][$menu->alias] = array(
                    'alias' => $menu->alias,
                    'url' => $menu->url,
                );
            }
        }

        return $navigations;
    }
}
