<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Products;
use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Tickets;
use App\Models\TicketsDetail;
use App\Models\Transactions;
use Carbon\Exceptions\InvalidTypeException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use OpenSpout\Reader\XLSX\Reader;

class UploadController extends Controller
{
    protected $_create = 'UPCR';

    public function index()
    {
        if (!$this->hasPrivilege($this->_create)) {
            return abort(401);
        }

        $view = [
            'mandatory' => $this->hasPrivilege($this->_create),
            'action' => route('master.upload.post', ['action' => config('global.action.form.add'), 'id' => 0])
        ];

        return view('contents.upload.index', $view);
    }

    public function post(Request $request, $action)
    {
        if (!in_array($action, config('global.action.form'))) {
            $response = new ResponseHelper('UKWN');
            $response->setResponse(0, __('messages.error.404'), 'Unknown post action in module upload : ' . $action);
        } else {
            $response = new ResponseHelper($this->_create);

            if (!$this->hasPrivilege($this->_create)) {
                $response->setResponse(2, __('messages.error.401'));
            } else {
                $param = $request->all();
                $validator = Validator::make($param, [
                    'file' => 'required|mimes:xls,xlsx',
                ]);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    foreach ($errors->all() as $error) {
                        $response->setResponse(0, $error);
                    }
                } else {
                    $file = $request->file('file');
                    $filename = date('d_M_Y_H_i_s') . '_' . $file->getClientOriginalName();
                    $path = $this->pathUpload();

                    if ($file->move($path, $filename)) {
                        $path = $path . '/' . $filename;
                        $reader = new Reader();
                        $reader->open($path);

                        $response = $this->executeFileData($reader, $response);
                    } else {
                        $response->setResponse(0, __('messages.upload.file.failed'));
                    }
                }
            }
        }

        $response->getResponse($request, Auth::user());
        return $response->jsonResponse();
    }

    private function executeFileData(Reader $reader, ResponseHelper $response)
    {
        $validation = config('validation');
        $validationKeys = array_keys($validation);
        foreach ($reader->getSheetIterator() as $sheet) {
            $page = $sheet->getName();
            if (in_array($page, $validationKeys)) {
                $result = $this->extractData($sheet, $validation[$page], $page);
            }

            if ($result['error']) {
                $response->setResponse(0, $result['message'],  'sheet : ' . $sheet->getName());
                return $response;
            }
        }
        $reader->close();

        $response->setResponse(1, __('messages.upload.file.success'));

        return $response;
    }

    private function extractData($sheet, $validator, $name)
    {
        $error = false;
        $message = '';
        $collections = array();
        $data = array();

        foreach ($sheet->getRowIterator() as $index => $row) {
            if ($index == 1) {
                if ($this->validateColumn($row->toArray(), $validator) === false) {
                    $error = true;
                    $message = __('messages.upload.file.column', ['name' => $name]);
                    break;
                }
            } else {
                $collection = $this->collectColumn($row->toArray(), $validator);
                if (!$collection['error']) {
                    $collections[] = $collection['data'];
                } else {
                    $error = true;
                    $message = __('messages.upload.file.mandatory', ['name' => $name, 'row' => $index, 'column' => $collection['data']]);
                    break;
                }
            }
        }

        if (!$error) {
            $data = array();
            foreach ($collections as $key => $value) {
                $data[$key] = $value;
                if (in_array($name, ['transaksi', 'penjualan', 'barang', 'ticket'])) {
                    $data[$key]['created_by'] = Auth::user()->id;
                    $data[$key]['updated_by'] = Auth::user()->id;
                    $data[$key]['created_at'] = Carbon::now();
                    $data[$key]['updated_at'] = Carbon::now();
                }
            }

            $insert = collect($data);
            $chunks = $insert->chunk(1000);

            if ($name == 'transaksi') {
                foreach ($chunks as $chunk) {
                    try {
                        $insert = Transactions::insert($chunk->toArray());
                    } catch (QueryException $exp) {
                        $error = true;
                        $message = $exp->getMessage();
                        break;
                    }
                }
            } else if ($name == 'penjualan') {
                foreach ($chunks as $chunk) {
                    try {
                        $insert = Sales::insert($chunk->toArray());
                    } catch (QueryException $exp) {
                        $error = true;
                        $message = $exp->getMessage();
                        break;
                    }
                }
            } else if ($name == 'penjualan_detail') {
                foreach ($chunks as $chunk) {
                    try {
                        $insert = SalesDetail::insert($chunk->toArray());
                    } catch (QueryException $exp) {
                        $error = true;
                        $message = $exp->getMessage();
                        break;
                    }
                }
            } else if ($name == 'barang') {
                foreach ($chunks as $chunk) {
                    try {
                        $insert = Products::insert($chunk->toArray());
                    } catch (QueryException $exp) {
                        $error = true;
                        $message = $exp->getMessage();
                        break;
                    }
                }
            } else if ($name == 'ticket') {
                foreach ($chunks as $chunk) {
                    try {
                        $insert = Tickets::insert($chunk->toArray());
                    } catch (QueryException $exp) {
                        $error = true;
                        $message = $exp->getMessage();
                        break;
                    }
                }
            } else if ($name == 'ticket_process') {
                foreach ($data as $chunk) {
                    try {
                        $ticket = Tickets::where('ticket_code', $chunk['ticket_code'])->first();
                        if($ticket) {
                            unset($chunk['ticket_code']);
                            $chunk['ticket_id'] = $ticket->id;
                            TicketsDetail::insert($chunk);
                        }
                    } catch (QueryException $exp) {
                        $error = true;
                        $message = $exp->getMessage();
                        break;
                    }
                }
            }
        }

        return ['error' => $error, 'message' => $message];
    }

    private function collectColumn($data, $validator)
    {
        $index = 0;
        $collection = array();
        foreach ($validator['columns'] as $key => $value) {
            if ($validator['regex'][$key] != '' && $validator['regex'][$key] == 'date') {
                try {
                    $carbon = Carbon::instance($data[$index]);
                    $string = $carbon->format(config('global.dateformat.datetime'));
                } catch (InvalidTypeException $exp) {
                    $string = null;
                }
            } else if ($validator['regex'][$key] != '') {
                $string = preg_replace($validator['regex'][$key], '', strval($data[$index]));
            } else {
                $string = strval($data[$index]);
            }
            

            if ($validator['mandatory'][$key] == true) {
                if ($string == null || $string == '') {
                    return [
                        'error' => true,
                        'data' => $value,
                    ];
                }
            }

            $collection[$key] = $string;
            $index++;
        }

        return [
            'error' => false,
            'data' => $collection
        ];
    }

    private function validateColumn($row, $validator)
    {
        $columns = array();
        $validator = $validator['columns'];
        $keys = array_keys($validator);
        foreach (array_values($validator) as $key => $value) {
            if ($row[$key] == $value) {
                $columns[$keys[$key]] = $key;
            }
        }

        $diff = array_diff(array_values($validator), array_values($columns));

        if (empty($diff)) {
            return false;
        }

        return $columns;
    }
}
