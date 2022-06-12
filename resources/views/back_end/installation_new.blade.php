@extends('back_end.layout.app')

@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"
                            class="small_font font-weight-400  theme_font_color">Dashboard </a></li>
                    <li class="breadcrumb-item active small_font font-weight-400">New Installation</li>
                </ul>
            </div>
        </div>

        <style>
            .product_card_div {
                border-right: 1px solid #eee;
            }

        </style>

        <div class="row">

            <div class="col-lg-12 px-0">
                <div class="card shadow-none border-0 rounded-0">
                    <div class="card-header d-flex align-items-center rounded-0">
                        <span class="flex-grow-1 font-weight-600"><i class="fa fa-folder-open pe-2"
                                aria-hidden="true"></i>New Installation</span>
                        <a href="#" class="text-muted text-decoration-none fs-12px">
                            <i class="fa fa-fw fa-redo"></i>
                        </a>
                    </div>

                    <div class="px-3 py-3" style="border-bottom: 1px solid #eee">
                        <div class="row">
                            <span>
                                Please fill in the information below. The field labels marked with * are required input
                                fields.
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6" style="padding: 0px">

                <div class="card border-0 shadow-sm rounded-0 h-100">

                    <div class="card-header d-flex align-items-center rounded-0"
                        style="border-bottom: 3px solid #78909c; background-color: #eeeeee">
                        <span class="flex-grow-1 font-weight-600">CUSTOMER DETAILS</span>
                        <a onclick="customerDetail_reset_fun(2)" class="text-muted text-decoration-none fs-12px">
                            <i class="fa fa-fw fa-redo"></i>
                        </a>
                    </div>

                    <div class="card-body">

                        <label class="form-label small_font" for="new_installation_customer_name">Name
                            <span class="text-danger">*</span>
                        </label>

                        <div class="d-flex mb-3">
                            <div class="me-1">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input id="new_installation_customer_name" name="new_installation_customer_name"
                                        type="text" class="form-control" placeholder="Type 'Customer Name' "
                                        autocomplete="off">
                                </div>
                                <input type="hidden" id="new_installation_customer_name_id"
                                    name="new_installation_customer_name_id" />
                            </div>
                            <div class="ms-1">
                                <a id="new_category_modal_link" class="btn btn-teal text-white"
                                    data-bs-toggle="modal" data-bs-target="#new_customer_modal">
                                    <i class="fa fa-plus fa-fw"></i>
                                    New
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_customer_contact">Contact
                                        <span class="text-danger">*</span></label>
                                    <input id="new_installation_customer_contact" name="new_installation_customer_contact"
                                        type="text" class="form-control" disabled />
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_customer_nic">NIC/ P.N
                                        <span class="text-danger">*</span></label>
                                    <input id="new_installation_customer_nic" name="new_installation_customer_nic"
                                        type="text" class="form-control" disabled />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label small_font" for="new_installation_customer_location">Location
                                    <span class="text-danger">*</span></label>
                                <input id="new_installation_customer_location" name="new_installation_customer_location"
                                    type="text" class="form-control" disabled />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label small_font" for="new_installation_customer_address">Address
                                    <span class="text-danger">*</span></label>
                                <input id="new_installation_customer_address" name="new_installation_customer_address"
                                    type="text" class="form-control" disabled />
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-lg-6 col-md-6" style="padding: 0px">

                <div class="card border-0 shadow-sm rounded-0 h-100">

                    <div class="card-header d-flex align-items-center rounded-0"
                        style="border-bottom: 3px solid #78909c; background-color: #eeeeee">
                       
                        <div class="d-flex">

                            <div class="me-4">
                                <input id="new_installation_type_vehicle" value="1" type="radio"
                                    class="from-control" name="new_installation_type" />
                                <label for="new_installation_type_vehicle">Vehicle</label>
                            </div>
                            <div>
                                <input id="new_installation_type_device_only" value="2" type="radio"
                                    class="from-control" name="new_installation_type" />
                                <label for="new_installation_type_device_only">Device-Only</label>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_vehicle_plate_number">
                                        Vehicle Plate Number
                                    </label>
                                    <input id="new_installation_vehicle_plate_number"
                                        name="new_installation_vehicle_plate_number" type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_vehicle_milage">Vehicle
                                        Milage (km)
                                    </label>
                                    <input id="new_installation_vehicle_milage" name="new_installation_vehicle_milage"
                                        type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_vehicle_model">Vehicle
                                        Model
                                    </label>
                                    <input id="new_installation_vehicle_model" name="new_installation_vehicle_model"
                                        type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_vehicle_engine_hours">Engine
                                        Hours
                                    </label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input id="new_installation_vehicle_engine_hours"
                                                name="new_installation_vehicle_engine_hours" type="text"
                                                class="form-control" placeholder="H" />
                                        </div>
                                        <div class="col-6">
                                            <input id="new_installation_vehicle_engine_minutes"
                                                name="new_installation_vehicle_engine_minutes" type="text"
                                                class="form-control" placeholder="M" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <form method="POST" id="vehicle_img_form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex d-flex-row">


                                        <div class="custom-file">
                                            <div class="text-center">
                                                <img id="new_install_vehicle_image1_upload_preview"
                                                    src="{{ asset('assets_back_end/img/image_upload_icon.svg') }}" alt=""
                                                    class="mb-2" style="width: 100px ; height: 100px">
                                                <label class="btn btn-sm btn-default w-75"
                                                    for="new_install_vehicle_image1_upload">Add
                                                    Vehicle Image 1</label>
                                                <input type="file" id="new_install_vehicle_image1_upload"
                                                    name="new_install_vehicle_image1_upload"
                                                    accept="image/*;capture=camera">
                                            </div>
                                        </div>

                                        <div class="custom-file">
                                            <div class="text-center">
                                                <img id="new_install_vehicle_image2_upload_preview"
                                                    src="{{ asset('assets_back_end/img/image_upload_icon.svg') }}" alt=""
                                                    class="mb-2" style="width: 100px ; height: 100px">
                                                <label class="btn btn-sm btn-default w-75"
                                                    for="new_install_vehicle_image2_upload">Add
                                                    Vehicle Image 2</label>
                                                <input type="file" id="new_install_vehicle_image2_upload"
                                                    name="new_install_vehicle_image2_upload">
                                            </div>
                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6" style="padding: 0px">

                <div class="card border-0 shadow-sm rounded-0 h-100">

                    <div class="card-header d-flex align-items-center rounded-0"
                        style="border-bottom: 3px solid #78909c; background-color: #eeeeee">
                        <span class="flex-grow-1 font-weight-600">SIM & DEVICE DETAILS</span>
                    </div>

                    <div class="card-body">

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label small_font" for="new_invoice_billing_to">
                                    SIM Card Number
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input id="new_installation_sim_card_number" name="new_installation_sim_card_number"
                                        type="text" class="form-control" placeholder="Type 'SIM Number' ">
                                </div>
                                <input type="hidden" id="new_installation_sim_card_number_id"
                                    name="new_installation_sim_card_number_id" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label small_font" for="new_installation_device_imei">
                                    Device IMEI or ID
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input id="new_installation_device_imei" name="new_installation_device_imei" type="text"
                                        class="form-control" placeholder="Type 'Device IMEI' ">
                                </div>
                                <input type="hidden" id="new_installation_device_imei_id"
                                    name="new_installation_device_imei_id" />
                            </div>

                        </div>

                        <form method="post" id="nic_img_form" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex d-flex-row">


                                <div class="custom-file">
                                    <div class="text-center">
                                        <img id="new_install_nic_image_front_upload_preview"
                                            src="{{ asset('assets_back_end/img/image_upload_icon.svg') }}" alt=""
                                            class="mb-2" style="width: 100px ; height: 100px">
                                        <label class="btn btn-sm btn-default w-75"
                                            for="new_install_nic_image_front_upload">
                                            NIC/PP Front Img</label>
                                        <input type="file" id="new_install_nic_image_front_upload"
                                            name="new_install_nic_image_front_upload">
                                    </div>
                                </div>

                                <div class="custom-file">
                                    <div class="text-center">
                                        <img id="new_install_nic_image_back_upload_preview"
                                            src="{{ asset('assets_back_end/img/image_upload_icon.svg') }}" alt=""
                                            class="mb-2" style="width: 100px ; height: 100px">
                                        <label class="btn btn-sm btn-default w-75" for="new_install_nic_image_back_upload">
                                            NIC/PP Back Img</label>
                                        <input type="file" id="new_install_nic_image_back_upload"
                                            name="new_install_nic_image_back_upload">
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6" style="padding: 0px">

                <div class="card border-0 shadow-sm rounded-0 h-100">

                    <div class="card-header d-flex align-items-center rounded-0"
                        style="border-bottom: 3px solid #78909c; background-color: #eeeeee">
                        <span class="flex-grow-1 font-weight-600">MODEL & FUNCTIONAL DETAILS</span>
                    </div>

                    <div class="card-body">

                        <div class="col-12">
                            <div class="row mb-3">

                                <label class="form-label small_font" for="new_installation_sim_card_number">
                                    Functions
                                </label>
                                </label>

                                <ul class="ui_kit_checkbox selectable-list">

                                    @foreach ($featureList as $feature)
                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" value="{{ $feature->id }}"
                                                    class="custom-control-input me-2" name="funtion_checkbox"
                                                    onchange="viewInvoiceTotal()">
                                                <label class="custom-control-label" for="customCheck1">
                                                    {{ $feature->name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-lg-6 col-md-6" style="padding: 0px">

                <div class="card border-0 shadow-sm rounded-0 h-100">

                    <div class="card-header d-flex align-items-center rounded-0"
                        style="border-bottom: 3px solid #78909c; background-color: #eeeeee">
                        <span class="flex-grow-1 font-weight-600">INVOICE DETAILS</span>
                    </div>

                    <div class="card-body">

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label small_font" for="new_installation_invoice_code">Invoice Code
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="new_installation_invoice_code" name="new_installation_invoice_code" type="text"
                                    class="form-control" value="{{ $invCode }}" disabled />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_annual_fee">Annual Fee
                                        <span class="text-danger">*</span></label>
                                    <input id="new_installation_annual_fee" name="new_installation_annual_fee" type="text"
                                        class="form-control" />
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_travelling_fee">Traveling
                                        Fee</label>
                                    <input id="new_installation_travelling_fee" placeholder="LKR. 0.00" name="new_installation_travelling_fee"
                                        type="text" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label small_font" for="new_installation_warranty_period">Warranty
                                    Period (Months)
                                </label>
                                <div class="d-flex d-flex-row">
                                    <select id="new_installation_warranty_period" name="new_installation_warranty_period"
                                        class="form-select me-2">

                                        <option value="0">Please Select a Warranty Period</option>
                                        @foreach ($warrantyList as $warranty)
                                            <option value="{{ $warranty->id }}">{{ $warranty->title }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_payment_type">Payment
                                        Type
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="d-flex d-flex-row">
                                        <select id="new_installation_payment_type" name="new_installation_payment_type"
                                            class="form-select me-2">
                                            @foreach ($paymentMethodList as $method)
                                                <option value="{{ $method->id }}">{{ $method->method }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_payment_type">Installed
                                        By
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="d-flex d-flex-row">
                                        <select id="new_installation_emp" name="new_installation_emp"
                                            class="form-select me-2">
                                            @foreach ($employeeList as $emp)
                                                <option value="{{ $emp->id }}">{{ $emp->emp_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label small_font" for="new_installation_hand_bill_number">Hand Bill
                                    Number</label>
                                <input id="new_installation_hand_bill_number" name="new_installation_hand_bill_number"
                                    type="text" class="form-control" />
                            </div>
                        </div>

                    </div>

                    <div class="card-footer bg-white px-0 py-0">
                        <div class="card-header d-flex align-items-center rounded-0" style="background-color: #a2cf6e">
                            <span class="flex-grow-1 font-weight-600">Total Payable Amount</span>
                        </div>

                        <div class="card-body" style="border-top: 3px solid #357a38; background-color: #c5e1a5">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h3 id="new_installation_total_view" class="mb-1 font-weight-700">LKR. 0.00</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <div class="col-xl-9 col-lg-6 col-md-6 px-0">
                <div class="card shadow-sm border-0 rounded-0 h-100">
                    <div class="card-header d-flex align-items-center rounded-0"
                        style="border-bottom: 3px solid #78909c; background-color: #eeeeee">
                        <span class="flex-grow-1 font-weight-600">REMARKS</span>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group mb-3">

                                    <div class="d-flex">
                                        <div class="me-3">
                                            <label class="form-label small_font"
                                                for="new_installation_invoice_admin_number_in_use">Admin Number in Use
                                            </label>

                                            <div class="d-flex">

                                                <div class="me-4">
                                                    <input id="new_installation_invoice_admin_number_in_use_yes" value="yes"
                                                        type="radio" class="from-control" name="admin_number_in_use" />
                                                    <label for="new_installation_invoice_admin_number_in_use">Yes</label>
                                                </div>
                                                <div>
                                                    <input id="new_installation_invoice_admin_number_in_use" value="no"
                                                        type="radio" class="from-control" name="admin_number_in_use" />
                                                    <label for="new_installation_invoice_admin_number_in_use_no">No</label>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label small_font"
                                                for="new_installation_invoice_admin_add_numbers">Admin Numbers
                                            </label>
                                            <input id="new_installation_invoice_admin_use"
                                                name="new_installation_invoice_admin_use" type="text"
                                                class="form-control" />
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8">

                                <label class="form-label small_font" for="new_installation_invoice_job_referance">Job
                                    Referance
                                </label>

                                <div class="d-flex">

                                    <div class="me-4">
                                        <input id="job_referance_google" value="1" type="radio" class="from-control"
                                            name="job_referance" />
                                        <label for="job_referance">Google</label>
                                    </div>
                                    <div class="me-4">
                                        <input id="job_referance_facebook" value="2" type="radio" class="from-control"
                                            name="job_referance" />
                                        <label for="job_referance">Facebook</label>
                                    </div>
                                    <div class="me-4">
                                        <input id="job_referance_ikman.lk" value="3" type="radio" class="from-control"
                                            name="job_referance" />
                                        <label for="job_referance">Ikman.lk</label>
                                    </div>
                                    <div class="me-4">
                                        <input id="job_referance_recommendation" value="4" type="radio"
                                            class="from-control" name="job_referance" />
                                        <label for="job_referance">Recommendation</label>
                                    </div>
                                    <div class="me-4">
                                        <input id="job_referance_old_customer" value="5" type="radio"
                                            class="from-control" name="job_referance" />
                                        <label for="job_referance">Old Customer</label>
                                    </div>
                                    <div class="me-4">
                                        <input id="job_referance_shop_boards" value="6" type="radio" class="from-control"
                                            name="job_referance" />
                                        <label for="job_referance">Shop Boards</label>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label small_font" for="new_installation_remark">
                                    Installation Remark
                                </label>
                                <textarea id="new_installation_remark" name="new_installation_remark" class="summernote"
                                    title="Contents"></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-xl-4 col-12">
                                <div class="d-flex d-flex-row justify-content-center">
                                    <div class="me-2 w-100">
                                        <button id="installationUpload_btn" class="btn btn-primary w-100">
                                            <i class="fa fa-fw fa-upload"></i>
                                            Save
                                        </button>
                                    </div>

                                    <div class="me-2 w-100">
                                        <button id="new_installation_form_reset" class="btn btn-default w-100">
                                            <i class="fa fa-fw fa-trash"></i>
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
