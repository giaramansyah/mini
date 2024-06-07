<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Models\General;
use App\Models\Accounts;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    protected $_update = 'GRUP';

    public function index()
    {
        if (!$this->hasPrivilege($this->_update)) {
            return abort(401);
        }

        $general = General::all()->toArray();
        $general = array_combine(array_column($general, 'key_id'), array_column($general, 'value'));

        $view = [
            'action' => route('setting.general.post', ['action' => config('global.action.form.edit')]),
            'mandatory' => $this->hasPrivilege($this->_update)
        ];

        $view = array_merge($general, $view);

        return view('contents.general.index', $view);
    }

    public function generateApiKey(Request $request)
    {
        $response = new ResponseHelper($this->_update);

        if ($request->ajax()) {
            $param = SecureHelper::unpack($request->input('json'));

            if (!is_array($param)) {
                $response->setResponse(0, __('messages.error.404'), 'Bad paramater pequest');
            } else {
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
                    if (!$this->hasPrivilege($this->_update)) {
                        $response->setResponse(2, __('messages.error.401'));
                    } else {
                        $account = Accounts::where('username', $param['username'])->where('is_trash', 0)->first();
                        if (!$account) {
                            $response->setResponse(0, __('messages.login.unregister'));
                        } else {
                            $password = $account->username . $param['password'] . $account->hash;
                            if (Hash::check($password, $account->password)) {
                                // $key = bin2hex(random_bytes(32));
                                $key = Str::random(64);

                                General::updateOrCreate(
                                    ['key_id' => 'api_key'],
                                    ['value' => $key]
                                );

                                $response->setResponse(1, __('messages.general.api.success'), 'API Key Generated');
                                $response->setRedirect(route('setting.general.index'));
                            } else {
                                $response->setResponse(0, __('messages.login.invalid'));
                            }
                        }
                    }
                }
            }
        }

        $response->getResponse($request, Auth::user());
        return $response->jsonResponse();
    }

    public function post(Request $request, $action)
    {
        if (!in_array($action, config('global.action.form'))) {
            $response = new ResponseHelper('UKWN');
            $response->setResponse(0, __('messages.error.404'), 'Unknown post action in module privilege : ' . $action);
        } else {
            $response = new ResponseHelper($this->_update);

            $param = SecureHelper::unpack($request->input('json'));
            if (!is_array($param)) {
                $response->setResponse(0, __('messages.error.404'), 'Bad paramater pequest');
            } else {
                $param = SecureHelper::unpack($request->input('json'));
                if (!is_array($param)) {
                    $response->setResponse(0, __('messages.error.404'), 'Bad paramater pequest');
                } else {
                    if (!$this->hasPrivilege($this->_update)) {
                        $response->setResponse(2, __('messages.error.401'));
                    } else {
                        if ($request->hasFile('file')) {
                            $file = $request->file('file');
                            $image = base64_encode(file_get_contents($file->path()));
                            $param['shop_image'] = "data:image/png;base64," . $image;
                        }
                        foreach ($param as $key => $value) {
                            if($key == "submit") {
                                continue;
                            }
                            General::updateOrCreate(
                                ['key_id' => $key],
                                ['value' => $value]
                            );
                        }

                        $response->setResponse(1, __('messages.general.edit.success'), 'General Setting Update');
                        $response->setRedirect(route('setting.general.index'));
                    }
                }
            }
        }

        $response->getResponse($request, Auth::user());
        return $response->jsonResponse();
    }
}
