<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\LogApi;
use App\Models\LogMails;
use App\Models\LogAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LogController extends Controller
{
    protected $_account = 'AARA';
    protected $_mail = 'MLRA';
    protected $_api = 'ATRA';

    public function account()
    {
        if (!$this->hasPrivilege($this->_account)) {
            return abort(401);
        }

        return view('contents.log.account');
    }

    public function mail()
    {
        if (!$this->hasPrivilege($this->_account)) {
            return abort(401);
        }

        return view('contents.log.mail');
    }

    public function api()
    {
        if (!$this->hasPrivilege($this->_api)) {
            return abort(401);
        }

        return view('contents.log.api');
    }

    public function list(Request $request, $form)
    {
        $response = new ResponseHelper($form);
        
        if ($request->ajax()) {
            $date = $request->input('date');
            $carbon = Carbon::createFromFormat(config('global.dateformat.viewdate'), $date);
            if($form == $this->_account) {
                $data = LogAccounts::whereDate('created_at', $carbon->format(config('global.dateformat.date')))->orderBy('created_at', 'desc')->where('account_id', Auth::user()->id);
            } else if($form == $this->_mail) {
                $data = LogMails::whereDate('created_at', $date)->orderBy('created_at', 'desc');
            } else if($form == $this->_api) {
                $data = LogApi::whereDate('created_at', $date)->orderBy('created_at', 'desc');
            }
            $table = DataTables::eloquent($data);
            $table->addIndexColumn();

            $response->setResponse(1, __('messages.log.data.success'));
            $response->setData($table->toJson());
        } else {
            $response->setResponse(1, __('messages.log.data.failed'));
        }

        $response->getResponse($request, Auth::user());

        return $response->dataResponse();
    }
}
