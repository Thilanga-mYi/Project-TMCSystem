@extends('back_end.layout.app')

@section('content')

    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"
                            class="small_font font-weight-400  theme_font_color">Dashboard </a></li>
                    <li class="breadcrumb-item active small_font font-weight-400">Re-Installation</li>
                </ul>
            </div>
        </div>

        <style>
            .product_card_div {
                border-right: 1px solid #eee;
            }

        </style>
        <form method="POST" id="new_installation_form" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-12 px-0">
                    <div class="card shadow-none border-0 rounded-0">
                        <div class="card-header d-flex align-items-center rounded-0">
                            <span class="flex-grow-1 font-weight-600"><i class="fa fa-folder-open pe-2"
                                    aria-hidden="true"></i>Re Installation</span>
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
                        </div>

                        <div class="card-body">

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_invoice_billing_to">Installing
                                        To</label>

                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        <input id="new_invoice_billing_to" name="new_invoice_billing_to" type="text"
                                            class="form-control" placeholder="Type 'Customer Name' ">
                                    </div>
                                    <input type="hidden" id="new_invoice_billing_to_id" name="new_invoice_billing_to_id" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label small_font" for="new_installation_customer_contact">Contact
                                            <span class="text-danger">*</span></label>
                                        <input id="new_installation_customer_contact"
                                            name="new_installation_customer_contact" type="text" class="form-control" />
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
                                        type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_customer_address">Address
                                        <span class="text-danger">*</span></label>
                                    <input id="new_installation_customer_address" name="new_installation_customer_address"
                                        type="text" class="form-control" />
                                </div>
                            </div>

                        </div>


                    </div>


                </div>

                <div class="col-xl-3 col-lg-6 col-md-6" style="padding: 0px">

                    <div class="card border-0 shadow-sm rounded-0 h-100">

                        <div class="card-header d-flex align-items-center rounded-0"
                            style="border-bottom: 3px solid #78909c; background-color: #eeeeee">
                            <span class="flex-grow-1 font-weight-600">VEHICLE DETAILS</span>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label small_font" for="new_installation_vehicle_plate_number">
                                            Old Vehicle Plate Number
                                            <span class="text-danger">*</span></label>
                                        </label>
                                        <input id="new_installation_vehicle_plate_number" disabled
                                            name="new_installation_vehicle_plate_number" type="text"
                                            class="form-control" />
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label small_font" for="new_installation_vehicle_plate_number">
                                            Vehicle Plate Number
                                            <span class="text-danger">*</span></label>
                                        </label>
                                        <input id="new_installation_vehicle_plate_number"
                                            name="new_installation_vehicle_plate_number" type="text"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_vehicle_milage">Vehicle
                                        Milage (km)
                                        <span class="text-danger">*</span></label>
                                    </label>
                                    <input id="new_installation_vehicle_milage" name="new_installation_vehicle_milage"
                                        type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_vehicle_model">Vehicle
                                        Model
                                        <span class="text-danger">*</span></label>
                                    </label>
                                    <input id="new_installation_vehicle_model" name="new_installation_vehicle_model"
                                        type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="col-12">
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
                                    <label class="form-label small_font" for="new_installation_sim_card_number">
                                        SIM Card Number (Optional)</label>
                                    </label>
                                    <input id="new_installation_sim_card_number" name="new_installation_sim_card_number"
                                        type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_device_imei">
                                        Device IMEI or ID
                                        <span class="text-danger">*</span></label>
                                    </label>
                                    <input id="new_installation_device_imei" name="new_installation_device_imei" type="text"
                                        class="form-control" />
                                </div>
                            </div>

                            <div class="d-flex d-flex-row">
                                <div class="custom-file">
                                    <div class="text-center">
                                        <img id="re_installation_nic_image"
                                            src="{{ asset('assets_back_end/img/image_upload_icon.svg') }}" alt=""
                                            class="mb-2" style="width: 100px ; height: 100px">
                                    </div>
                                </div>

                                <div class="custom-file">
                                    <div class="text-center">
                                        <img id="product_image2_upload_preview"
                                            src="{{ asset('assets_back_end/img/image_upload_icon.svg') }}" alt=""
                                            class="mb-2" style="width: 100px ; height: 100px">
                                        <label class="btn btn-sm btn-default" for="product_image2_upload">Add
                                            Vehicle Image</label>
                                        <input type="file" id="product_image2_upload" name="product_image2_upload">
                                    </div>
                                </div>

                            </div>

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

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                                    id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">
                                                    Voice Monitor
                                                </label>
                                            </div>

                                        </li>
                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                                    id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">
                                                    Engine Stop
                                                </label>
                                            </div>

                                        </li>
                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                                    id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">
                                                    Ingnition Status
                                                </label>
                                            </div>

                                        </li>
                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                                    id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">
                                                    Fuel Sensor
                                                </label>
                                            </div>

                                        </li>


                                    </ul>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row mb-3">

                                    <label class="form-label small_font" for="new_installation_sim_card_number">
                                        Device Model
                                    </label>
                                    </label>

                                    <ul class="ui_kit_checkbox selectable-list">

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input me-2"
                                                    id="device_model_radio1" name="device_model_radio">
                                                <label class="custom-control-label" for="device_model_radio1">
                                                    TMC-101
                                                </label>
                                            </div>
                                        </li>

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input me-2"
                                                    id="device_model_radio2" name="device_model_radio">
                                                <label class="custom-control-label" for="device_model_radio2">
                                                    TMC-101C
                                                </label>
                                            </div>
                                        </li>

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input me-2"
                                                    id="device_model_radio3" name="device_model_radio">
                                                <label class="custom-control-label" for="device_model_radio3">
                                                    TMC-101T
                                                </label>
                                            </div>
                                        </li>

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input me-2"
                                                    id="device_model_radio4" name="device_model_radio">
                                                <label class="custom-control-label" for="device_model_radio4">
                                                    TMC-102
                                                </label>
                                            </div>
                                        </li>

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input me-2"
                                                    id="device_model_radio5" name="device_model_radio">
                                                <label class="custom-control-label" for="device_model_radio5">
                                                    TMC-106 (Fuel)
                                                </label>
                                            </div>
                                        </li>

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input me-2"
                                                    id="device_model_radio5" name="device_model_radio">
                                                <label class="custom-control-label" for="device_model_radio5">
                                                    TMC-103A
                                                </label>
                                            </div>
                                        </li>

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input me-2"
                                                    id="device_model_radio5" name="device_model_radio">
                                                <label class="custom-control-label" for="device_model_radio5">
                                                    TMC-103A (OBD)
                                                </label>
                                            </div>
                                        </li>

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input me-2"
                                                    id="device_model_radio5" name="device_model_radio">
                                                <label class="custom-control-label" for="device_model_radio5">
                                                    Watch
                                                </label>
                                            </div>
                                        </li>

                                        <li class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input me-2"
                                                    id="device_model_radio5" name="device_model_radio">
                                                <label class="custom-control-label" for="device_model_radio5">
                                                    Pet
                                                </label>
                                            </div>
                                        </li>


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
                                    <label class="form-label small_font" for="new_installation_invoice_code">Invoice
                                        Code
                                        <span class="text-danger">*</span></label>
                                    <input id="new_installation_invoice_code" name="new_installation_invoice_code"
                                        type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label small_font" for="new_installation_annual_fee">Annual
                                            Fee
                                            <span class="text-danger">*</span></label>
                                        <input id="new_installation_annual_fee" name="new_installation_annual_fee"
                                            type="text" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label small_font" for="new_installation_annual_fee">Traveling
                                            Fee</label>
                                        <input id="new_installation_annual_fee" name="new_installation_annual_fee"
                                            type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_warranty_period">Warranty
                                        Period (Months)
                                    </label>
                                    <input id="new_installation_warranty_period" name="new_installation_warranty_period"
                                        type="text" class="form-control" placeholder="Months" />
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
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Paybable">Paybable</option>
                                                <option value="Online">Online</option>
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
                                            <select id="new_installation_payment_type" name="new_installation_payment_type"
                                                class="form-select me-2">
                                                <option value="Cash">Emp 01</option>
                                                <option value="Cheque">Emp 02</option>
                                            </select>
                                        </div>

                                    </div>
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
                                        <h3 id="new_invoice_total_view" class="mb-1 font-weight-700">LKR. 0.00</h3>
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

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_installation_remark">
                                        Installation Remark
                                    </label>
                                    <textarea id="new_installation_remark" name="new_installation_remark"
                                        class="summernote" title="Contents"></textarea>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-xl-4 col-12">
                                    <div class="d-flex d-flex-row justify-content-center">
                                        <div class="me-2 w-100">
                                            <button type="submit" class="btn btn-primary w-100">
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

        </form>

    </div>

    <div class="modal fade" id="add_brand_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register New Brand</h5>
                    <button id="add_brand_modal_close_btn" type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label class="form-label small_font" for="new_supplier_name">Brand Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="new_brand_name" name="new_brand_name" />
                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex flex-row-reverse">
                        <a id="new_brand_save_btn" class="btn btn-primary ">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Save
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('back_end.layout.script')

@endsection
