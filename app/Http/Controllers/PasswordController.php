<?php

namespace App\Http\Controllers;

use App\Helper\MailHelper;
use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Http\Mail\CreatePassword;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    protected $_new = 'NPWD';
    protected $_forget = 'FPWD';
    protected $_resend = 'RPWD';
    protected $_modify = 'MPWD';

    public function new($id, $hash)
    {
        $plainId = SecureHelper::unsecure($id);
        if (!$plainId) {
            return abort(404);
        }

        $plainHash = SecureHelper::unsecure($hash);
        if (!$plainHash) {
            return abort(404);
        }

        $account = Accounts::find($plainId);
        if ($account) {
            if ($account->is_new && $account->password_request != null && $account->expire_password_request != null) {
                $now = Carbon::now();
                $expired = Carbon::createFromFormat(config('global.dateformat.datetime'), $account->expire_password_request);
                if (!$now->greaterThan($expired)) {
                    if ($plainHash != $account->password_request . $plainId) {
                        return abort(404);
                    } else {
                        return view('contents.password.new', ['id' => $id]);
                    }
                } else {
                    return abort(406);
                }
            } else {
                return abort(406);
            }
        } else {
            return abort(404);
        }
    }

    public function forget()
    {
        return view('contents.password.forget');
    }

    public function edit()
    {
        return view('contents.password.edit');
    }

    public function post(Request $request, $action, $id)
    {
        if (!in_array($action, config('global.action.password'))) {
            $response = new ResponseHelper('UKWN');
            $response->setResponse(0, __('messages.error.404'), 'Unknown post action in module privilege : ' . $action);
            $account = (object) ['id' => 0];
        } else {
            if ($action == config('global.action.password.add')) {
                $response = new ResponseHelper($this->_new);
            } else if ($action == config('global.action.password.resend')) {
                $response = new ResponseHelper($this->_resend);
            } else if ($action == config('global.action.password.forget')) {
                $response = new ResponseHelper($this->_forget);
            } else {
                $response = new ResponseHelper($this->_modify);
            }

            if (in_array($action, Arr::only(config('global.action.password'), ['add', 'resend', 'edit']))) {
                $plainId = SecureHelper::unsecure($id);
                if (!$plainId) {
                    $response->setResponse(0, __('messages.error.404'), 'Bad paramater id pequest');
                    $account = (object) ['id' => 0];
                } else {
                    $account = Accounts::find($plainId);
                    if ($account) {
                        if ($action == config('global.action.password.add')) {
                            $param = SecureHelper::unpack($request->input('json'));
                            if (!is_array($param)) {
                                $response->setResponse(0, __('messages.error.404'), 'Bad paramater pequest');
                            } else {
                                $validator = Validator::make($param, [
                                    'new_password' => 'required|alpha_num',
                                    'confirm_password' => 'required|alpha_num',
                                ]);

                                if ($validator->fails()) {
                                    $errors = $validator->errors();
                                    foreach ($errors->all() as $error) {
                                        $response->setResponse(0, __($error));
                                    }
                                } else {
                                    $hash = md5(sha1(date('ymdHis')));
                                    $account->password = $account->username . $param['new_password'] . $hash;
                                    $account->hash = $hash;
                                    $account->is_new = 0;
                                    $account->password_request = null;
                                    $account->expire_password_request = null;

                                    if ($account->save()) {
                                        $response->setResponse(1, __('messages.password.add.success'), 'Account : ' . $account->username);
                                        $response->setRedirect(route('auth.index'));
                                    } else {
                                        $response->setResponse(2, __('messages.password.add.failed'), 'Account : ' . $account->username);
                                    }
                                }
                            }
                        } else if ($action == config('global.action.password.resend')) {
                            $now = Carbon::now();
                            if ($account->last_password_request != null) {
                                $last = Carbon::createFromFormat(config('global.dateformat.datetime'), $account->last_password_request);
                            } else {
                                $last = Carbon::now()->subHours(7);
                            }

                            if ($last->diffInHours($now) < 6) {
                                $response->setResponse(2, __('messages.password.resend.hasty'));
                            } else {
                                $hash = md5(sha1(date('ymdHis') . $account->username));
                                $now = Carbon::now();
                                $account->password_request = $hash;
                                $account->last_password_request = $now->toDateTimeString();
                                $account->expire_password_request = $now->addHours(6)->toDateTimeString();

                                if ($account->save()) {
                                    $content = [
                                        'to' => $account->email,
                                        'subject' => 'Reset Password',
                                        'title' => 'Reset Password',
                                        'link' => route('password.new', ['id' => SecureHelper::secure($account->id), 'hash' => SecureHelper::secure($hash . $account->id)]),
                                        'button' => 'Reset Password',
                                        'executor' => Auth::user()
                                    ];
                                    $mail = new CreatePassword($content);

                                    MailHelper::sendMail($mail, $content);

                                    $account = Auth::user();
                                    $response->setResponse(1, __('messages.password.resend.success'), 'Account : ' . $account->username);
                                    $response->setRedirect(url()->previous());
                                } else {
                                    $response->setResponse(2, __('messages.password.resend.failed'), 'Account : ' . $account->username);
                                }
                            }
                        } else {
                            $param = SecureHelper::unpack($request->input('json'));
                            if (!is_array($param)) {
                                $response->setResponse(0, __('messages.error.404'), 'Bad paramater pequest');
                            } else {
                                $validator = Validator::make($param, [
                                    'password' => 'required|alpha_num',
                                    'new_password' => 'required|alpha_num',
                                    'confirm_password' => 'required|alpha_num',
                                ]);

                                if ($validator->fails()) {
                                    $errors = $validator->errors();
                                    foreach ($errors->all() as $error) {
                                        $response->setResponse(0, __($error));
                                    }
                                } else {
                                    $password = $account->username . $param['password'] . $account->hash;
                                    if (Hash::check($password, $account->password)) {
                                        $hash = md5(sha1(date('ymdHis')));
                                        $account->password = $account->username . $param['new_password'] . $hash;
                                        $account->hash = $hash;
                                        $account->is_new = 0;
                                        $account->password_request = null;
                                        $account->expire_password_request = null;

                                        if ($account->save()) {
                                            $response->setResponse(1, __('messages.password.edit.success'));
                                            $response->setRedirect(route('account'));
                                        } else {
                                            $response->setResponse(2, __('messages.password.edit.failed'));
                                        }
                                    } else {
                                        $response->setResponse(2, __('messages.password.edit.invalid'));
                                    }
                                }
                            }
                        }
                    } else {
                        $response->setResponse(0, __('messages.password.data.failed'));
                        $response->setRedirect(route('auth.index'));
                        $account = (object) ['id' => 0];
                    }
                }
            } else {
                $param = SecureHelper::unpack($request->input('json'));
                if (!is_array($param)) {
                    $response->setResponse(0, __('messages.error.404'), 'Bad paramater pequest');
                } else {
                    $validator = Validator::make($param, [
                        'username' => 'required|alpha_num',
                        'email' => 'required|email:rfc,dns',
                    ]);

                    if ($validator->fails()) {
                        $errors = $validator->errors();
                        foreach ($errors->all() as $error) {
                            $response->setResponse(0, __($error));
                        }
                    } else {
                        $account = Accounts::where('username', $param['username'])->where('email', $param['email'])->first();
                        if ($account) {
                            $now = Carbon::now();
                            if ($account->last_password_request != null) {
                                $last = Carbon::createFromFormat(config('global.dateformat.datetime'), $account->last_password_request);
                            } else {
                                $last = Carbon::now()->subHours(7);
                            }

                            if ($last->diffInHours($now) < 6) {
                                $response->setResponse(1, __('messages.password.forget.success'), 'Account : ' . $account->username);
                            } else {
                                $hash = md5(sha1(date('ymdHis') . $account->username));
                                $now = Carbon::now();
                                $account->password_request = $hash;
                                $account->last_password_request = $now->toDateTimeString();
                                $account->expire_password_request = $now->addHours(6)->toDateTimeString();

                                if ($account->save()) {
                                    $content = [
                                        'to' => $account->email,
                                        'subject' => 'Forget Password',
                                        'title' => 'Forget Password',
                                        'link' => route('password.new', ['id' => SecureHelper::secure($account->id), 'hash' => SecureHelper::secure($hash . $account->id)]),
                                        'button' => 'Forget Password',
                                        'executor' => $account
                                    ];
                                    $mail = new CreatePassword($content);

                                    MailHelper::sendMail($mail, $content);

                                    $response->setResponse(1, __('messages.password.forget.success'), 'Account : ' . $account->username);
                                    $response->setRedirect(route('password.forget'));
                                } else {
                                    $response->setResponse(2, __('messages.password.forget.failed'), 'Account : ' . $account->username);
                                }
                            }
                        } else {
                            $response->setResponse(1, __('messages.password.forget.success'), 'Account : ' . $param['username']);
                            $account = (object) ['id' => 0];
                        }
                    }
                }
            }
        }

        $response->getResponse($request, $account);
        return $response->jsonResponse();
    }
}
