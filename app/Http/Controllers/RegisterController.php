<?php

namespace App\Http\Controllers;

use App\Helper\MailHelper;
use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Http\Mail\CreatePassword;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $_new = 'RGTR';

    public function index()
    {
        return view('contents.register.index');
    }

    public function register(Request $request, $action)
    {
        if (!in_array($action, config('global.action.form'))) {
            $response = new ResponseHelper('UKWN');
            $response->setResponse(0, __('messages.error.404'), 'Unknown post action in module privilege : ' . $action);
            $account = (object) ['id' => 0];
        } else {
            $response = new ResponseHelper($this->_new);

            $param = SecureHelper::unpack($request->input('json'));
            if (!is_array($param)) {
                $response->setResponse(0, __('messages.error.404'), 'Bad paramater pequest');
                $account = (object) ['id' => 0];
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
                        $account = (object) ['id' => 0];
                    }
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
                            'created_by' => 0,
                            'updated_by' => 0,
                            'privilege_group_id' => $param['privilege_group_id'],
                        ]);
                        if ($account->id) {
                            $content = [
                                'to' => $param['email'],
                                'subject' => 'Verify Account',
                                'title' => 'Verify Account',
                                'link' => route('password.new', ['id' => SecureHelper::secure($account->id), 'hash' => SecureHelper::secure($hash . $account->id)]),
                                'button' => 'Verify Account',
                                'executor' => 0
                            ];
                            $mail = new CreatePassword($content);

                            MailHelper::sendMail($mail, $content);

                            $response->setResponse(1, __('messages.account.add.success'), 'Username : ' . $param['username']);
                            $response->setRedirect(route('auth.index'));
                        } else {
                            $response->setResponse(2, __('messages.account.add.failed'), 'Username : ' . $param['username']);
                            $account = (object) ['id' => 0];
                        }
                    } else {
                        $response->setResponse(2, __('messages.account.add.exist'));
                        $account = (object) ['id' => 0];
                    }
                }
            }
        }

        $response->getResponse($request, $account);
        return $response->jsonResponse();
    }
}
