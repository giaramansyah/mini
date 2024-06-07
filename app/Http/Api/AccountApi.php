<?php

namespace App\Http\Api;

use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Http\Controllers\Controller;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AccountApi extends Controller
{
    public function auth(Request $request)
    {
        $response = new ResponseHelper('AUTH');

        $parameters = SecureHelper::unpack($request->input('json'));

        if (is_array($parameters)) {
            $validator = Validator::make($parameters, [
                'username' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                foreach ($errors->all() as $error) {
                    $response->setResponse(0, __($error));
                }
            } else {
                $account = Accounts::where('username', $parameters['username'])->where('is_cashier', 1)->where('is_trash', 0)->first();
                if (!$account) {
                    $response->setResponse(0, __('messages.login.unregister'));
                } else {
                    try {
                        $password = $account->username . $parameters['password'] . $account->hash;
                        $token = JWTAuth::attempt(['id' => $account->id, 'password' => $password]);
                        if (!$token) {
                            $response->setResponse(0, __('messages.login.invalid'), $account->getFullnameAttribute());
                        } else {
                            $data = [
                                'id' => $account->id,
                                'username' => $account->username,
                                'full_name' => $account->getFullnameAttribute(),
                                'passport' => $token
                            ];

                            $response->setResponse(1, __('messages.login.welcome', ['name' => $account->getFullnameAttribute()]), $account->getFullnameAttribute());
                            $response->setData($data);
                        }
                    } catch (JWTException $exception) {
                        $response->setResponse(0, $exception->getMessage(), 'Error Token Exception');
                    }
                }
            }
        }

        $response->getAPIResponse($request);
        return $response->jsonResponse();
    }

    public function logout(Request $request)
    {
        $response = new ResponseHelper('LOUT');

        $parameters = $request->only('passport');

        $validator = Validator::make($parameters, [
            'passport' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                $response->setResponse(0, __($error));
            }
        } else {
            try {
                JWTAuth::invalidate($parameters['token']);

                $response->setResponse(1, __('Logout success'));
            } catch (JWTException $exception) {
                $response->setResponse(0, $exception->getMessage(), 'Error Token Exception');
            }
        }

        $response->getAPIResponse($request);
        return $response->jsonResponse();
    }

    public function refresh(Request $request)
    {
        $response = new ResponseHelper('AUTH');

        $authorization = $request->header('authorization');

        $parameters = [
            'authorization' => str_replace('Bearer ', '', $authorization)
        ];

        $validator = Validator::make($parameters, [
            'authorization' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                $response->setResponse(0, __($error));
            }
        } else {
            try {
                $token = JWTAuth::refresh($parameters['authorization']);
                $response->setResponse(1, __('messages.login.success'));
                $response->setData([
                    'passport' => $token,
                ]);
            } catch (JWTException $exception) {
                $response->setResponse(0, $exception->getMessage(), 'Error Token Exception');
            }
        }

        $response->getAPIResponse($request);
        return $response->jsonResponse();
    }
}
