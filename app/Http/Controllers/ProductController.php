<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    protected $_readall = 'SLRA';

    public function index()
    {
        if (!$this->hasPrivilege($this->_readall)) {
            return abort(401);
        }

        return view('contents.product.index');
    }

    public function list(Request $request)
    {
        $response = new ResponseHelper($this->_readall);

        if ($request->ajax()) {
            $data = Products::orderBy('id');
            $table = DataTables::eloquent($data)->setTotalRecords(Products::count());
            $table->addColumn('price_label', function ($row) {
                return 'Rp ' . $row->price;
            });
            $table->addColumn('sale_label', function ($row) {
                return 'Rp ' . $row->sale;
            });
            $table->rawColumns(['price_label', 'sale_label']);

            $response->setResponse(1, __('messages.product.data.success'));
            $response->setData($table->toJson());
        } else {
            $response->setResponse(1, __('messages.product.data.failed'));
        }

        $response->getResponse($request, Auth::user());

        return $response->dataResponse();
    }
}
