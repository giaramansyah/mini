<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    protected $_readall = 'TRRA';

    public function index()
    {
        if (!$this->hasPrivilege($this->_readall)) {
            return abort(401);
        }

        return view('contents.transaction.index');
    }

    public function list(Request $request)
    {
        $response = new ResponseHelper($this->_readall);

        if ($request->ajax()) {
            $data = Transactions::select('invoice_no', 'total_weight', 'shipping_fee', 'total_price', 'shipping_date', 'shipping_type', 'transaction_date')->orderBy('id');
            $table = DataTables::eloquent($data)->setTotalRecords(Transactions::count());
            $table->addColumn('shipping_fee_label', function ($row) {
                return 'Rp ' . $row->shipping_fee;
            });
            $table->addColumn('total_price_label', function ($row) {
                return 'Rp ' . $row->total_price;
            });
            $table->rawColumns(['shipping_fee_label', 'total_price_label']);

            $response->setResponse(1, __('messages.transaction.data.success'));
            $response->setData($table->toJson());
        } else {
            $response->setResponse(1, __('messages.transaction.data.failed'));
        }

        $response->getResponse($request, Auth::user());

        return $response->dataResponse();
    }
}
