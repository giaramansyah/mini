<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SecureHelper;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    protected $_readall = 'SLRA';
    protected $_readid = 'SLRD';

    public function index()
    {
        if (!$this->hasPrivilege($this->_readall)) {
            return abort(401);
        }

        return view('contents.sales.index');
    }

    public function list(Request $request)
    {
        $response = new ResponseHelper($this->_readall);

        if ($request->ajax()) {
            $data = Sales::select('id', 'invoice_no', 'total_weight', 'shipping_fee', 'total_price', 'total_sale', 'shipping_date', 'shipping_type', 'sales_date')->orderBy('id');
            $table = DataTables::eloquent($data)->setTotalRecords(Sales::count());
            $table->addColumn('invoice', function ($row) {
                if ($this->hasPrivilege($this->_readid)) {
                    return '<a href="' . route('master.sales.view', ['id' => SecureHelper::secure($row->id)]) . '">' . $row->invoice_no . '</a>';
                } else {
                    return $row->invoice_no;
                }
            });
            $table->addColumn('shipping_fee_label', function ($row) {
                return 'Rp ' . $row->shipping_fee;
            });
            $table->addColumn('total_price_label', function ($row) {
                return 'Rp ' . $row->total_price;
            });
            $table->addColumn('total_sale_label', function ($row) {
                return 'Rp ' . $row->total_sale;
            });
            $table->rawColumns(['invoice', 'shipping_fee_label', 'total_price_label', 'total_sale_label']);

            $response->setResponse(1, __('messages.sales.data.success'));
            $response->setData($table->toJson());
        } else {
            $response->setResponse(1, __('messages.sales.data.failed'));
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

        $sales = Sales::find($plainId);
        if (!$sales) {
            return abort(404);
        }

        $response = new ResponseHelper($this->_readid);

        $detail = $sales->detail()->get()->toArray();
        $sales = $sales->toArray();
        $sales['detail'] = $detail;

        $view = [];

        $view = array_merge($sales, $view);

        $response->setResponse(1, __('messages.sales.data'), 'sales ID : ' . $sales['id']);
        $response->setData($view);

        $response->getResponse($request, Auth::user());

        return view('contents.sales.view', $view);
    }
}
