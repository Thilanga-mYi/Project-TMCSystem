<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Installation;
use App\Models\InstallationHasFeatures;
use App\Models\Invoice;
use App\Models\InvoiceHasCustomer;
use App\Models\InvoiceHasProducts;
use App\Models\payment_methods;
use App\Models\ProductFeatures;
use App\Models\ProductModel;
use App\Models\Products;
use App\Models\stockHasProducts;
use App\Models\warranty;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InstallationController extends Controller
{
    public function index()
    {

        Session::forget('vehicleImages');
        Session::forget('nicImages');
        Session::forget('installation_total');
        Session::forget('sim_change_total');

        $invCode = 'NWINST/' . date('smy') . '/' . str_pad((new Invoice)->getInvoiceCount() + 1, 3, '0', STR_PAD_LEFT);
        $modelList = (new ProductModel)->getAllActiveModels();
        $featureList = (new ProductFeatures)->getAllActiveFEatures();
        $warrantyList = (new warranty)->getActiveAll();
        $paymentMethodList = (new payment_methods)->getActiveAll();
        $employeeList = (new Employee)->getActiveAll();
        return view('/back_end/installation_new', compact('invCode', 'modelList', 'featureList', 'warrantyList', 'paymentMethodList', 'employeeList'));
    }

    public function getSIMSuggestions(Request $request)
    {
        $data = array();

        $records = DB::table('stock_has_products')
            ->where([
                ['stock_has_products.status', '=', 1],
                ["stock_has_products.imei", "LIKE", "%{$request['query']}%"],
            ])
            ->rightJoin('products', 'stock_has_products.product_id', 'products.id')
            ->where(function ($query) {
                $query->where('products.product_type_id', '2');
            })
            ->get(['stock_has_products.id as stock_product_id', 'products.lang1_name', 'stock_has_products.imei']);

        foreach ($records as $product) {

            $data[] = [
                'id' => $product->stock_product_id,
                'name' => $product->imei . ' (' . $product->lang1_name . ')',
            ];
        }
        return response()->json($data, 200);
    }

    public function getProductSuggestions(Request $request)
    {

        $data = array();

        $records = DB::table('stock_has_products')
            ->where([
                ['stock_has_products.status', '=', 1],
                ["stock_has_products.imei", "LIKE", "%{$request['query']}%"],
            ])
            ->rightJoin('products', 'stock_has_products.product_id', 'products.id')
            ->where(function ($query) {
                $query->where('products.product_type_id', '1');
            })
            ->get(['stock_has_products.id as stock_product_id', 'products.lang1_name', 'stock_has_products.imei']);

        foreach ($records as $product) {

            $data[] = [
                'id' => $product->stock_product_id,
                'name' => $product->imei . ' (' . $product->lang1_name . ')',
            ];
        }
        return response()->json($data, 200);
    }

    public function saveVehicleImages(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'installation_type' => 'required|numeric|min:1|max:2',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if ($request->installation_type == 1) {

            $validator = Validator::make($request->all(), [
                'vehicle_img1' => 'required_if:installation_type,1|mimes:jpeg,png,jpg',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $filestorelocation = public_path('/' . env('VEHICLE_FILE_PATH'));
            $vehicle_img_1_filename = null;
            $vehicle_img_2_filename = null;

            $product_image1_url = $request->file('vehicle_img1');
            $vehicle_img_1_filename = '1-' . time() . $product_image1_url->getClientOriginalName();
            $product_image1_url->move($filestorelocation, $vehicle_img_1_filename);

            if ($request->hasFile('vehicle_img2')) {
                $product_image2_url = $request->file('vehicle_img2');
                $vehicle_img_2_filename = '2-' . time() . $product_image2_url->getClientOriginalName();
                $product_image2_url->move($filestorelocation, $vehicle_img_2_filename);
            }

            Session::put('vehicleImages', [$vehicle_img_1_filename, $vehicle_img_2_filename]);

            return response()->json([
                'code' => 1,
                'type' => 'success',
                'des' => 'Successfully Saved Vehicle Images',
                'refresh_status' => 1,
                'feild_reset_status' => 1,
            ]);
        } else {

            return response()->json([
                'code' => 2,
                'type' => 'success',
                'des' => 'Successfully Saved Vehicle Images',
                'refresh_status' => 1,
                'feild_reset_status' => 1,
            ]);
        }
    }

    public function saveNICImages(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nic_img1' => 'required|mimes:jpeg,png,jpg',
            'nic_img2' => 'required|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $filestorelocation = public_path('/' . env('NIC_FILE_PATH'));
        $nic_img_1_filename = null;
        $nic_img_2_filename = null;

        $nic_image1_url = $request->file('nic_img1');
        $nic_image2_url = $request->file('nic_img2');

        $nic_img_1_filename = '1-' . time() . $nic_image1_url->getClientOriginalName();
        $nic_img_2_filename = '2-' . time() . $nic_image2_url->getClientOriginalName();

        $nic_image1_url->move($filestorelocation, $nic_img_1_filename);
        $nic_image2_url->move($filestorelocation, $nic_img_2_filename);

        Session::put('nicImages', [$nic_img_1_filename, $nic_img_2_filename]);

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => 'Successfully Saved NIC Images',
            'refresh_status' => 1,
            'feild_reset_status' => 1,
        ]);
    }

    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|numeric',
            'vehicle_plate_number' => 'required_if:installation_type,1',
            'vehicle_milage' => 'required_if:installation_type,1',
            'vehicle_model' => 'required_if:installation_type,1',
            'sim_card_id' => 'required|numeric',
            'device_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $vehicleImageArray = Session::get('vehicleImages');
        $nicImagesArray = Session::get('nicImages');

        if (!Session::has('nicImages')) {
            return response()->json([
                'code' => 2,
                'type' => 'error',
                'des' => '',
                'refresh_status' => 1,
                'feild_reset_status' => 1,
            ]);
        }

        $customer_id = $request->customer_id;
        $installation_type = $request->installation_type;
        $vehicle_plate_number = $request->vehicle_plate_number;
        $vehicle_milage = $request->vehicle_milage;
        $vehicle_model = $request->vehicle_model;
        $vehicle_engine_h = $request->vehicle_engine_h;
        $vehicle_engine_m = $request->vehicle_engine_m;
        $sim_card_id = $request->sim_card_id;
        $device_id = $request->device_id;
        $model_id = Products::find(stockHasProducts::find($request->device_id)->product_id)->model_id;
        $annual_fee = $request->annual_fee;
        $travelling_fee = $request->travelling_fee;
        $warranty_id = $request->warranty_id;
        $payment_type_id = $request->payment_type_id;
        $emp_id = $request->emp_id;
        $hand_bill_number = $request->hand_bill_number;
        $admin_use_number = $request->admin_use_numbers;
        $admin_number = $request->admin_number;
        $job_referance = $request->job_referance;
        $selected_functions = $request->selected_functions;
        $remark = $request->remark;
        $vehicle_img1 = $vehicleImageArray != null ? ($vehicleImageArray[0] != null ? $vehicleImageArray[0] : '') : '';
        $vehicle_img2 = $vehicleImageArray != null ? ($vehicleImageArray[0] != null ? $vehicleImageArray[1] : '') : '';
        $nic_front_img = ($nicImagesArray[0] != null ? $nicImagesArray[0] : '');
        $nic_back_img = ($nicImagesArray[1] != null ? $nicImagesArray[1] : '');

        $installationData = [
            'customer_id' => $customer_id,
            'installation_type' => $installation_type,
            'invoice_code' => 'NWINST/' . date('smy') . '/' . '123',
            'annual_fee' => $annual_fee,
            'travelling_fee' => $travelling_fee,
            'warranty_id' => $warranty_id,
            'payment_type_id' => $payment_type_id,
            'installed_by_id' => $emp_id,
            'hand_bill_number' => $hand_bill_number,
            'vehicle_plate_number' => $vehicle_plate_number,
            'vehicle_milage' => $vehicle_milage,
            'vehicle_modal' => $vehicle_model,
            'engine_hours_h' => $vehicle_engine_h,
            'engine_hours_m' => $vehicle_engine_m,
            'sim_card_id' => $sim_card_id,
            'product_id' => $device_id,
            'device_model_id' => $model_id,
            'remark' => $remark,
            'admin_in_use' => $admin_use_number,
            'admin_numbers' => $admin_number,
            'job_referance' => $job_referance,
            'status' => 1,
            'nic_front_img' => $nic_front_img,
            'nic_back_img' => $nic_back_img,
            'vehicle_img1' => $vehicle_img1,
            'vehicle_img2' => $vehicle_img2,
        ];

        $installationObj = (new Installation)->add($installationData);

        foreach ($selected_functions as $key => $function) {
            $featureObj = ProductFeatures::find($function);
            $deviceFunctionData = [
                'installation_id' => $installationObj->id,
                'feature_id' => $featureObj->id,
                'amount' => $featureObj->installation_cost,
                'status' => 1,
            ];

            $installationHasFeaturesObj = (new InstallationHasFeatures)->add($deviceFunctionData);
        }

        $invoice_data = [
            'invoice_code' => 'NWINST/' . date('smy') . '/' . str_pad((new Invoice)->getInvoiceCount() + 1, 3, '0', STR_PAD_LEFT),
            'installation_id' => $installationObj->id,
            'order_type_id' => 1,
            'referance' => $hand_bill_number,
            'administration_id' => Auth::user()->id,
            'warehouse_id' => 1,
            'total' => Session::get('installation_total'),
            'discount' => 0,
            'vat_id' => 1,
            'net_total' => Session::get('installation_total'),
            'remark' => $remark,
            'billing_to' => Customer::find($customer_id)->name,
            'billing_address' => Customer::find($customer_id)->street_address . ' ' . Customer::find($customer_id)->city,
            'status' => 1,
        ];

        $invoiceObj = (new Invoice)->add($invoice_data);
        $sim_price = Products::find(stockHasProducts::find($sim_card_id)->product_id)->default_price;
        $device_price = Products::find(stockHasProducts::find($device_id)->product_id)->default_price;

        $invoice_has_customer = [
            'invoice_id' => $invoiceObj->id,
            'customer_id' => $customer_id,
            'invoice_type_id' => $payment_type_id,
            'status' => 1,
        ];

        $invoice_has_sim_data = [
            'invoice_id' => $invoiceObj->id,
            'unit_price' => $sim_price,
            'qty' => 1,
            'total' => $sim_price * 1,
            'discount' => 0,
            'vat_id' => 1,
            'vat_value' => 0,
            'net_total' => $sim_price * 1,
            'shp_id' => $sim_card_id,
            'status' => 1,
        ];

        $invoice_has_product_data = [
            'invoice_id' => $invoiceObj->id,
            'unit_price' => $device_price,
            'qty' => 1,
            'total' => $device_price * 1,
            'discount' => 0,
            'vat_id' => 1,
            'vat_value' => 0,
            'net_total' => $device_price * 1,
            'shp_id' => $device_id,
            'status' => 1,
        ];

        (new InvoiceHasCustomer)->add($invoice_has_customer);
        (new InvoiceHasProducts)->add($invoice_has_sim_data);
        (new InvoiceHasProducts)->add($invoice_has_product_data);

        (new stockHasProducts)->edit('id', $sim_card_id, ['status' => 2]);
        (new stockHasProducts)->edit('id', $device_id, ['status' => 2]);

        Session::forget('vehicleImages');
        Session::forget('nicImages');
        Session::forget('installation_total');

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => 'Successfully Saved Installation',
            'data' => $installationObj->id,
            'refresh_status' => 1,
            'feild_reset_status' => 1,
        ]);
    }

    public function viewInstallationTotal(Request $request)
    {

        $total = 0;

        if (!empty($request->selected_functions)) {
            foreach ($request->selected_functions as $key => $function) {
                $total += ProductFeatures::find($function)->installation_cost;
            }
        }

        if ($request->has('sim_id') && $request->filled('sim_id') && $request->sim_id != 0) {
            $total += Products::find(stockHasProducts::find($request->sim_id)->product_id)->default_price;
        }
        if ($request->has('device_id') && $request->filled('device_id') && $request->device_id != 0) {
            $total += Products::find(stockHasProducts::find($request->device_id)->product_id)->default_price;
        }
        if ($request->has('warranty_period_id') && $request->filled('warranty_period_id') && $request->warranty_period_id != 0) {
            $total += warranty::find($request->warranty_period_id)->amount;
        }

        $total += $request->travelling_fee;
        Session::put('installation_total', $total);

        return number_format($total, 2);
    }

    public function installationList()
    {
        $tableData = [];

        $records = (new Installation)->getallInstallations();

        foreach ($records as $key => $value) {

            switch ($value->status) {
                case 1:
                    $orderTypeText = 'Active';
                    $orderTypeColor1 = 'success';
                    $orderTypeColor2 = 'success';
                    break;
                case 2:
                    $orderTypeText = 'In-active';
                    $orderTypeColor1 = 'danger';
                    $orderTypeColor2 = 'danger';
                    break;
            }

            $orderStatus = '<span class="badge rounded-1 my-1 font-weight-400 bg-' . $orderTypeColor1 . '-transparent-2 text-' . $orderTypeColor2 . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">' .
                '<i class="fa fa-circle text-' . $orderTypeColor2 . '-transparent-8 fs-9px fa-fw me-5px"></i>'
                . $orderTypeText .
                '</span>';

            $riderAssignAction = '<a onclick="print_invoice(' . $value->id . ')" class="dropdown-item font-weight-400 small_font mb-0 border-bottom">' .
                '<i class="fa fa-file-o pe-3" aria-hidden="true"></i>Print Invoice</a>' .
                '<a onclick="installation_sim_change(' . $value->id . ')" class="dropdown-item font-weight-400 small_font mb-0 border-bottom">' .
                '<i class="fa fa-exchange pe-3" aria-hidden="true"></i>SIM Change</a>';

            $content = '';

            (($value->status == 1) ? $content = $riderAssignAction : '');

            $actions = '<div class="mt-md-0 mt-2">' .
                '<a href="#" data-bs-toggle="dropdown"class="btn btn-sm btn-default text-decoration-none">' .
                'Action&nbsp' .
                '<i class="fa fa-caret-down" aria-hidden="true"></i>' .
                '</a>' .
                '<div class="dropdown-menu bg-white rounded-0 pt-0 pb-0">' .
                '<a class="dropdown-item font-weight-400 small_font border-bottom" onclick="view_installation_func(' . $value->id . ',true)">' .
                '<i class="fa fa-eye pe-3" aria-hidden="true"></i>' .
                'View Installation' .
                '</a>' . $content . '</div>' .
                '</div>';

            switch ($value->installation_type) {
                case 1:
                    $installationTypeText = 'Vehicle';
                    $installationTypeColor1 = 'primary';
                    $installationTypeColor2 = 'primary';
                    break;
                case 2:
                    $installationTypeText = 'Device-Only';
                    $installationTypeColor1 = 'info';
                    $installationTypeColor2 = 'info';
                    break;
            }

            $installationType = '<span class="badge rounded-1 my-1 font-weight-400 bg-' . $installationTypeColor1 . '-transparent-2 text-' . $installationTypeColor2 . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">' .
                '<i class="fa fa-circle text-' . $installationTypeColor2 . '-transparent-8 fs-9px fa-fw me-5px"></i>'
                . $installationTypeText .
                '</span>';

            $tableData[] = [
                ++$key,
                $value->invoice_code,
                $value['getCustomer']->name,
                $value['getSIM']->imei,
                $value['getDevice']->imei,
                $installationType,
                $orderStatus,
                $actions
            ];
        }

        return $tableData;
    }

    public function printInstallationInvoice(Request $request)
    {

        // $request->validate([
        //     'id' => 'required|numeric|exists:installations,id'
        // ]);

        $installation = (new Installation)
            ->where('id', $request->id)
            ->with('getCustomer')
            ->with('getSIM')
            ->with('getDevice')
            ->with('getWarranty')
            ->with('getPaymentType')
            ->with('getDeviceModel')
            ->with('getInstalledEmp')
            ->first();

        $features = (new InstallationHasFeatures)
            ->where('installation_id', $request->id)
            ->with('getFeature')
            ->get();

        $invoice = (new Invoice)->where('installation_id', $request->id)->first();

        if (!empty($installation)) {
            return view('/back_end/reports/invoice')
                ->with('installation_data', $installation)
                ->with('features_data', $features)
                ->with('invoice_data', $invoice)
                ->with('emp', Employee::find($installation->installed_by_id)->emp_name);
        } else {
            return 2;
        }
    }

    public function viewSelectedInstallation(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:installations,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $installation_obj = (new Installation)->where('id', $request->id)->where('status', 1)->first();

        return [
            'installation_type' => $installation_obj->installation_type,
            'customer_name' => Customer::find($installation_obj->customer_id)->name,
            'customer_email' => Customer::find($installation_obj->customer_id)->email,
            'customer_vehicle_number' => $installation_obj->vehicle_plate_number,
            'customer_vehicle_model' => $installation_obj->vehicle_modal,
            'current_sim' => stockHasProducts::find($installation_obj->sim_card_id)->imei,
        ];
    }

    public function getSIMChangeTotal(Request $request)
    {

        $total = 0;

        if ($request->has('sim_id') && $request->filled('sim_id') && $request->sim_id != 0) {
            $total += Products::find(stockHasProducts::find($request->sim_id)->product_id)->default_price;
        }
        if ($request->has('additional_amount') && $request->filled('additional_amount') && $request->additional_amount != 0) {
            $total += $request->additional_amount;
        }

        Session::put('sim_change_total', $total);
        return number_format($total, 2);
    }
}
