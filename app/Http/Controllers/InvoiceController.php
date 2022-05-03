<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceHasCustomer;
use App\Models\InvoiceHasProducts;
use App\Models\InvoiceType;
use App\Models\Products;
use App\Models\stockHasProducts;
use App\Models\vat;
use App\Models\warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index()
    {
        Session::forget('invoiceProducts');
        Session::forget('data');
        $invoiceCode = 'INV/' . date('smy') . '/' . str_pad((new Invoice)->getInvoiceCount() + 1, 3, '0', STR_PAD_LEFT);

        $invoice_types = InvoiceType::where('status', 1)->get();

        return view('/back_end/invoice', compact('invoiceCode', 'invoice_types'));
    }

    public function sessionRecords()
    {
        $sessionData = Session::get('data', []);
        return $sessionData;
    }

    public function addSessionProduct(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'unit_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:8',
            'qty' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:8',
            'vat' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:8',
            'discount' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:8',
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if ((new Invoice)->getProductQty($request->product_id)['totqty'] == null) {
            return 'RESP1';
        }

        if ($request->qty > (new invoice)->getProductQty($request->product_id)['totqty']) {
            return 'RESP2';
        } else {

            $isNew = true;
            $data = $this->sessionRecords();

            foreach ($data as $index => $v) {
                if ($data[$index][0] == $request->product_id) {
                    $data[$index][1][0] = $request->product_id;
                    $data[$index][1][1] = $request->unit_price;
                    $data[$index][1][2] = $request->qty;
                    $data[$index][1][3] = $request->discount;
                    $data[$index][1][4] = $request->vat;

                    $product_stocks = (new stockHasProducts)->getProductStocksForInvoice($request->product_id)->get();
                    $invoiceQty = $request->qty;

                    while ($invoiceQty != 0) {
                        foreach ($product_stocks as $key => $value) {
                            if ($value['status'] == 1) {
                                if ($value['qty'] >= $invoiceQty) {
                                    $value['qty'] = $value['qty'] - $invoiceQty;

                                    if ($value['qty'] == 0) {
                                        $value['status'] = 2;
                                    }

                                    $datadummy[] = [
                                        'id' => $value['id'],
                                        'stock_id' => $value['stock_id'],
                                        'product_id' => $value['product_id'],
                                        'qty' => intval($invoiceQty),
                                        'unit_price' => $request->unit_price,
                                        'discount' => $request->discount,
                                        'vat' => vat::find($request->vat)->value,
                                        'status' => $value['status'],
                                    ];

                                    $data[$index][2] = $datadummy;
                                    $invoiceQty = 0;

                                    break;
                                } else {
                                    $value['status'] = 2;

                                    $datadummy[] = [
                                        'id' => $value['id'],
                                        'stock_id' => $value['stock_id'],
                                        'product_id' => $value['product_id'],
                                        'qty' => intval($value['qty']),
                                        'unit_price' => $request->unit_price,
                                        'discount' => $request->discount,
                                        'vat' => vat::find($request->vat)->value,
                                        'status' => 2,
                                    ];

                                    $invoiceQty = $invoiceQty - $value['qty'];
                                    $value['qty'] = 0;
                                }
                            }
                        }
                    }
                    $isNew = false;
                    break;
                }
            }

            if ($isNew) {

                $product_stocks = (new stockHasProducts)->getProductStocksForInvoice($request->product_id)->get();
                $invoiceQty = $request->qty;

                while ($invoiceQty != 0) {
                    foreach ($product_stocks as $key => $value) {

                        if ($value['status'] == 1) {
                            if ($value['qty'] >= $invoiceQty) {

                                $value['qty'] = $value['qty'] - $invoiceQty;

                                if ($value['qty'] == 0) {
                                    $value['status'] = 2;
                                }

                                $datadummy[] = [
                                    'id' => $value['id'],
                                    'stock_id' => $value['stock_id'],
                                    'product_id' => $value['product_id'],
                                    'qty' => intval($invoiceQty),
                                    'unit_price' => $request->unit_price,
                                    'discount' => $request->discount,
                                    'vat' => vat::find($request->vat)->value,
                                    'status' => $value['status'],
                                ];

                                $data[] = [$request->product_id, [$request->product_id, $request->unit_price, $request->qty, $request->discount, $request->vat], $datadummy];

                                $invoiceQty = 0;

                                break;
                            } else {

                                $value['status'] = 2;

                                $datadummy[] = [
                                    'id' => $value['id'],
                                    'stock_id' => $value['stock_id'],
                                    'product_id' => $value['product_id'],
                                    'qty' => intval($value['qty']),
                                    'unit_price' => $request->unit_price,
                                    'discount' => $request->discount,
                                    'vat' => vat::find($request->vat)->value,
                                    'status' => $value['status'],
                                ];

                                $invoiceQty = $invoiceQty - $value['qty'];
                                $value['qty'] = 0;
                            }
                        }
                    }
                }
            }

            Session::put('data', $data);
            return 'DONE';
        }
    }

    public function getInvoiceTotal(Request $request)
    {
        $data_for_tot = Session::get('data');
        $nettot = 0;

        $invoiceVatValue = vat::find($request->vat_id)->value;

        if ($data_for_tot == null) {
            return env('CURRANCY') . ' ' . number_format(0, 2);
        } else {
            foreach ($data_for_tot as $key => $val) {
                $nettot += (($val[2][0]['unit_price'] * $val[2][0]['qty']) * (100 + $val[2][0]['vat']) / 100) * (100 - $val[2][0]['discount']) / 100;
            }

            return env('CURRANCY') . ' ' . number_format($nettot * (100 + $invoiceVatValue) / 100, 2);
        }
    }

    public function getInvoiceTotalForSave($vat_id)
    {
        $data_for_tot = Session::get('data');
        $nettot = 0;

        $invoiceVatValue = vat::find($vat_id)->value;

        if ($data_for_tot == null) {
            return 0;
        } else {
            foreach ($data_for_tot as $key => $val) {
                $nettot += (($val[2][0]['unit_price'] * $val[2][0]['qty']) * (100 + $val[2][0]['vat']) / 100) * (100 - $val[2][0]['discount']) / 100;
            }
            return $nettot * (100 + $invoiceVatValue) / 100;
        }
    }

    public function getInvoiceNetTotalForSave()
    {
        $data_for_tot = Session::get('data');
        $nettot = 0;

        if ($data_for_tot == null) {
            return 0;
        } else {
            foreach ($data_for_tot as $key => $val) {
                $nettot += (($val[2][0]['unit_price'] * $val[2][0]['qty']) * (100 + $val[2][0]['vat']) / 100) * (100 - $val[2][0]['discount']) / 100;
            }
            return $nettot;
        }
    }

    public function invoiceTableView()
    {
        $tableData = [];
        $records = $this->sessionRecords();
        if (count($records) == 0) {
            return $tableData = [];
        }

        foreach ($records as $index => $value) {

            foreach ($records[$index][2] as $key => $product) {

                $actions = '<div class="mt-md-0 mt-2">' .
                    '<a href="#" data-bs-toggle="dropdown" class="btn btn-sm btn-default text-decoration-none">' .
                    '<i class="fa fa-bars" aria-hidden="true"></i></a><div class="dropdown-menu bg-white rounded-0">' .
                    '<a class="dropdown-item" onclick="invoice_product_remove_func(' . $index . ')">' .
                    '<i class="fa fa-trash-o px-2" aria-hidden="true"></i>Remove' .
                    '</a>' .
                    '<a onclick="grn_product_view_func(' . $product['product_id'] . ')" class="dropdown-item">' .
                    '<i class="fa fa-eye px-2" aria-hidden="true"></i>View Product' .
                    '</a>' .
                    '</div>' .
                    '</div>';

                $tableData[] = [
                    ++$key,
                    $actions,
                    Products::find($product['product_id'])->code,
                    Str::limit((Products::find($product['product_id'])->lang1_name), 20, '...'),
                    env('CURRANCY') . ' ' . number_format($product['unit_price'], 2),
                    number_format($product['qty'], 2),
                    env('CURRANCY') . ' ' . number_format($product['unit_price'] * $product['qty'], 2),
                    number_format($product['discount'], 2),
                    number_format($product['vat'], 2),
                    env('CURRANCY') . ' ' . number_format((($product['unit_price'] * $product['qty']) * (100 + $product['vat']) / 100) * (100 - $product['discount']) / 100, 2),
                ];
            }
        }

        return $tableData;
    }

    public function removeProductFromSession(Request $request)
    {

        $index = $request->index;
        $records = $this->sessionRecords();

        if (count($records) > 0) {
            array_splice($records, $index, 1);
            Session::put('data', $records);
            return 'Successfully Removed';
        } else {
            return 2;
        }
    }

    public function saveInvoice(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'invoice_vat' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $records = $this->sessionRecords();
        if ($records == null) {
            return 1;
        } else {

            $data = [
                'invoice_code' => 'INV/' . date('smy') . '/' . str_pad((new invoice)->getInvoiceCount() + 1, 3, '0', STR_PAD_LEFT),
                'order_type_id' => 1,
                'referance' => $request->invoice_ref,
                'administration_id' => Auth::user()->id,
                'warehouse_id' => 1,
                'total' => $this->getInvoiceNetTotalForSave(),
                'discount' => 0,
                'vat_id' => $request->invoice_vat,
                'net_total' => $this->getInvoiceTotalForSave($request->invoice_vat),
                'remark' => $request->invoice_remark,
                'billing_to' => $request->invoice_billing_to,
                'billing_address' => $request->invoice_billing_address,
                'status' => 1,
            ];

            $invoice = (new Invoice)->add($data);

            foreach ($records as $key => $val) {

                foreach ($val[2] as $pkey => $productval) {

                    $phs = stockHasProducts::find($productval['id']);
                    $phs->qty = $phs->qty - $productval['qty'];
                    $phs->status = $productval['status'];
                    $phs->save();

                    $product_stocks_data = [
                        'invoice_id' => $invoice->id,
                        'unit_price' => $productval['unit_price'],
                        'qty' => $productval['qty'],
                        'total' => $productval['qty'] * $productval['unit_price'],
                        'discount' => $productval['discount'],
                        'vat_id' => 1,
                        'vat_value' => $productval['vat'],
                        'net_total' => ($productval['qty'] * $productval['unit_price']) * (100 + $productval['vat']) / 100,
                        'shp_id' => $productval['id'],
                        // 'chp_id' => '',
                        'status' => 1,
                    ];

                    (new InvoiceHasProducts)->add($product_stocks_data);
                }
            }

            if ($request->customer_id != '') {

                $invoiceHasCustomerData = [
                    'invoice_id' => $invoice->id,
                    'customer_id' => $request->customer_id,
                    'invoice_type_id' => $request->type_id,
                    'pay_done_date' => $request->pay_done_date,
                    'status' => 1,
                ];

                (new InvoiceHasCustomer)->add($invoiceHasCustomerData);
            }

            Session::forget('data');
            return 'INV/' . date('smy') . '/' . str_pad((new invoice)->getInvoiceCount() + 1, 3, '0', STR_PAD_LEFT);
        }
    }


    public function getInvoiceList()
    {

        $tableData = [];

        if (Auth::user()->email == 'tmsav55@gmail.com') {
            $invoices = (new Invoice)->getAllInvoices();
        } else {
            $invoices = (new Invoice)->getAdministrationWiseInvoices(Auth::user()->id);
        }


        foreach ($invoices as $key => $value) {

            switch ($value->status) {
                case 1:
                    $invoiceTypeText = 'Successfull';
                    $invoiceTypeColor1 = 'success';
                    $invoiceTypeColor2 = 'success';
                    break;
                case 2:
                    $invoiceTypeText = 'Error';
                    $invoiceTypeColor1 = 'warning';
                    $invoiceTypeColor2 = 'warning';
                    break;
            }

            $invoice_type = '<span class="badge rounded-1 my-1 font-weight-400 bg-' . $invoiceTypeColor1 . '-transparent-2 text-' . $invoiceTypeColor2 . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">' .
                '<i class="fa fa-circle text-' . $invoiceTypeColor2 . '-transparent-8 fs-9px fa-fw me-5px"></i>'
                . $invoiceTypeText .
                '</span>';

            $actions = '<div class="mt-md-0 mt-2">' .
                '<a href="#" data-bs-toggle="dropdown"class="btn btn-sm btn-default text-decoration-none">' .
                'Action&nbsp<i class="fa fa-caret-down" aria-hidden="true"></i></a><div class="dropdown-menu bg-white rounded-0">' .
                '<a class="dropdown-item font-weight-400 small_font" onclick="view_invoice_func(' . $value->id . ')">' .
                '<i class="fa fa-file-text-o pe-3" aria-hidden="true"></i>' .
                'Invoice Details' .
                '</a>' .
                '</div>' .
                '</div>';

            $tableData[] = [
                ++$key,
                $value->invoice_code,
                date('d-m-Y', strtotime($value->created_at)),
                (empty($value->referance) ? '-' : $value->referance),
                warehouses::find($value->warehouse_id)->name,
                (empty($value->billing_to) ? '-' : $value->billing_to),
                (empty($value->billing_address) ? '-' : Str::limit($value->billing_address, 20, '...')),
                $invoice_type,
                $actions,
            ];
        }

        return $tableData;
    }

    public function viewInvoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        return (new Invoice)->viewInvoice($request->id);
    }
}
