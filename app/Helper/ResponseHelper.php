<?php

namespace App\Helper;

use App\Models\LogApi;
use App\Models\LogAccounts;
use App\Models\Privileges;
use App\Models\Accounts;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacades;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ResponseHelper
{
    protected $_privilege;
    protected $_user;
    protected $_alert = 'error';
    protected $_status = false;
    protected $_message = 'Bad Request';
    protected $_description = '';
    protected $_data;
    protected $_redirect;
    protected $_response;

    public function __construct($privilege)
    {
        $this->_privilege = $privilege;
    }

    public function setResponse($code = 0, $message = 'Bad Request', $description = '')
    {
        $this->_status = $code == 1 ? true : false;
        $this->_message = $message;
        $this->_alert = config('global.alert')[$code];
        $this->_description = $description;
    }

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function setRedirect($redirect)
    {
        $this->_redirect = $redirect;
    }

    public function getResponse(Request $request, $user)
    {
        $this->_user = $user;
        $this->makeResponse();
        $this->writeLog($request);
    }

    public function getAPIResponse(Request $request)
    {
        $this->makeResponse();
        $this->writeApiLog($request);
    }

    public function jsonResponse()
    {
        try {
            return response()->json($this->_response);
        } catch (Error $e) {
            dd($e->getMessage());
        }
    }

    public function dataResponse()
    {
        return $this->_data;
    }

    private function makeResponse()
    {
        $this->_response = array(
            'status' => $this->_status,
            'alert' => $this->_alert,
            'message' => $this->_message,
        );

        if ($this->_data !== null) {
            $this->_response['data'] = $this->_data;
        }

        if ($this->_redirect !== null) {
            $this->_response['redirect'] = $this->_redirect;
        }
    }

    private function writeLog(Request $request)
    {
        $staticId = array_combine(config('global.privilege.code'), config('global.privilege.id'));
        $staticDesc = array_combine(config('global.privilege.code'), config('global.privilege.desc'));

        if (in_array($this->_privilege, config('global.privilege.code'))) {
            $id = $staticId[$this->_privilege];
            $desc = $staticDesc[$this->_privilege];
        } else {
            $privilege = Privileges::select('id', 'desc')->where('code', $this->_privilege)->first();
            if ($privilege) {
                $id = $privilege->id;
                $desc = $privilege->desc;
            }
        }

        if ($id) {
            LogAccounts::create([
                'account_id' => isset($this->_user->id) ? $this->_user->id : 0,
                'privilege_id' => $id,
                'description' => $desc . ($this->_description != '' ? ' : ' .  $this->_description : ''),
                'ip_address' => RequestFacades::getClientIp(true),
                'log_request' => $this->grabRequest($request),
                'log_response' => $this->grabResponse(),
                'agent' => Browser::deviceType() . ' : ' . Browser::platformName() . ' : ' . Browser::browserName(),
            ]);

            if(isset($this->_user->id)) {
                $user = Accounts::find($this->_user->id);
                if($user->id) {
                    $user->last_login = Carbon::now();
                    $user->save();
                }
            }
        } else {
            dd('Error User Log Parameter : unknown privilege id');
        }
    }

    private function writeApiLog(Request $request)
    {
        $staticId = array_combine(config('global.privilege.code'), config('global.privilege.id'));
        $staticDesc = array_combine(config('global.privilege.code'), config('global.privilege.desc'));

        if (in_array($this->_privilege, config('global.privilege.code'))) {
            $id = $staticId[$this->_privilege];
            $desc = $staticDesc[$this->_privilege];
        } else {
            $privilege = Privileges::select('id', 'desc')->where('code', $this->_privilege)->first();
            if ($privilege) {
                $id = $privilege->id;
                $desc = $privilege->desc;
            }
        }

        if ($id) {
            LogApi::create([
                'privilege_id' => $id,
                'description' => $desc . ($this->_description != '' ? ' : ' .  $this->_description : ''),
                'ip_address' => RequestFacades::getClientIp(true),
                'log_request' => $this->grabRequest($request),
                'log_response' => $this->grabResponse(),
            ]);
        } else {
            dd('Error User Log Parameter : unknown privilege id');
        }
    }

    private function grabRequest(Request $request)
    {
        $uuid = (string) Str::uuid();
        $header = $request->header();
        $payload = $request->all();

        if (isset($payload['json'])) {
            $secure = SecureHelper::unpack($payload['json']);
            if (is_array($secure)) {
                unset($payload['json']);
                $payload = array_merge($secure, $payload);
            }
        }

        $requestArr = [
            'uuid' => $uuid,
            'header' => $header,
            'payload' => $payload
        ];

        $string = str_replace(array("\\n", "\\r"), '', json_encode($requestArr));
        $string = preg_replace('/\s\s+/', '', $string);

        Log::channel('request')->info($string);

        return $uuid;
    }

    private function grabResponse()
    {
        $uuid = Str::uuid();

        $responseArr = [
            'uuid' => $uuid,
            'response' => $this->_response,
        ];

        $string = str_replace(array("\\n", "\\r"), '', json_encode($responseArr));
        $string = preg_replace('/\s\s+/', '', $string);

        Log::channel('response')->info($string);

        return $uuid;
    }
}
