<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    protected $_readall = 'TCRA';
    protected $_readid = 'TCRD';

    public function index()
    {
        if (!$this->hasPrivilege($this->_readall)) {
            return abort(401);
        }

        return view('contents.ticket.index');
    }

    public function list(Request $request)
    {
        $response = new ResponseHelper($this->_readall);

        if ($request->ajax()) {
            $data = Tickets::orderBy('id');
            $table = DataTables::eloquent($data)->setTotalRecords(Tickets::count());
            $table->addColumn('ticket', function ($row) {
                if ($this->hasPrivilege($this->_readid)) {
                    return '<a href="' . route('master.ticket.view', ['id' => SecureHelper::secure($row->id)]) . '">' . $row->ticket_code . '</a>';
                } else {
                    return $row->ticket_code;
                }
            });
            $table->rawColumns(['ticket']);

            $response->setResponse(1, __('messages.ticket.data.success'));
            $response->setData($table->toJson());
        } else {
            $response->setResponse(1, __('messages.ticket.data.failed'));
        }

        $response->getResponse($request, Auth::user());

        return $response->dataResponse();
    }

    public function view(Request $request, $id)
    {
        if (!$this->hasPrivilege($this->_readid)) {
            return abort(401);
        }

        $plainId = SecureHelper::unsecure($id);
        if (!$plainId) {
            return abort(404);
        }

        $ticket = Tickets::find($plainId);
        if (!$ticket) {
            return abort(404);
        }

        $response = new ResponseHelper($this->_readid);

        $detail = $ticket->detail()->get()->toArray();
        $ticket = $ticket->toArray();
        $ticket['detail'] = $detail;

        $view = [];

        $view = array_merge($ticket, $view);

        $response->setResponse(1, __('messages.ticket.data'), 'Ticket ID : ' . $ticket['ticket_code']);
        $response->setData($view);

        $response->getResponse($request, Auth::user());

        return view('contents.ticket.view', $view);
    }
}
