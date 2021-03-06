@extends('back_end.layout.app')

@section('content')

    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin" class="small_font font-weight-400 theme_font_color">Dashboard
                        </a></li>
                    <li class="breadcrumb-item active small_font font-weight-400">GRN Registration</li>
                </ul>
            </div>
        </div>

        <div class="row">

            <div class="card rounded-0 shadow-none">

                <div class="card-header d-flex align-items-center rounded-0" style="margin-left:-8px ; margin-right:-8px">
                    <span class="flex-grow-1 font-weight-600"><i class="fa fa-folder-open pe-2" aria-hidden="true"></i>Add
                        New Purchasing</span>
                    <a href="#" class="text-muted text-decoration-none fs-12px">
                        <i class="fa fa-fw fa-redo"></i>
                    </a>
                </div>

                <div class="px-3 py-3"
                    style="border-bottom: 1px solid #eee ; padding-right: 0px ; margin-left:-8px ; margin-right:-8px">
                    <div class="row">
                        <span>
                            Please fill in the information below. The field labels marked with * are required input
                            fields.
                        </span>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-3 col-md-4 col-12 px-0">

                        <div class="card rounded-0 shadow-sm border-0">

                            <div class="card-header d-flex align-items-center rounded-0">
                                <span class="flex-grow-1 font-weight-600"><i class="fa fa-folder-open pe-2"
                                        aria-hidden="true"></i>Add GRN Primary Details</span>
                                <a href="#" class="text-muted text-decoration-none fs-12px">
                                    <i class="fa fa-fw fa-redo"></i>
                                </a>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_code">GRN Code</label>
                                            <input id="new_grn_code" name="new_grn_code" type="text" class="form-control"
                                                value="{{ $grnCode }}" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_type">Select GRN Type</label>
                                            <select id="new_grn_type" name="new_grn_type" class="form-select">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_warehouse">Select
                                                Warehouse</label>
                                            <select id="new_grn_warehouse" name="new_grn_warehouse" class="form-select">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_supplier">Select
                                                Supplier</label>

                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                <input id="new_grn_supplier" name="new_grn_supplier" type="text"
                                                    class="form-control" placeholder="Type 'Supplier Name / Code' ">
                                            </div>
                                            <input type="hidden" id="new_grn_supplier_id" name="new_grn_supplier_id" />

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_po_ref">Purchase Order
                                                Ref#</label>
                                            <input id="new_grn_po_ref" name="new_grn_po_ref" type="text"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_remark">Remark</label>
                                            <textarea id="new_grn_remark" name="new_grn_remark" class="form-control"
                                                rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_vat">Product
                                                VAT</label>
                                            <select id="new_grn_vat" name="new_grn_vat" class="form-select">
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="px-3 py-3"
                            style="border-bottom: 1px solid #eee ; padding-right: 0px ; margin-left:-8px ; margin-right:-8px">
                            <div class="row">
                                <span>
                                    Below information includes the Item shipping & logistic payment charges
                                </span>
                            </div>
                        </div>

                        <div class="card rounded-0 shadow-sm border-0">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_logistic_name">Logistic
                                                Name</label>
                                            <input id="new_grn_logistic_name" name="new_grn_logistic_name" type="text"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_logistic_amount">Paid
                                                Amount</label>
                                            <input id="new_grn_logistic_amount" name="new_grn_logistic_amount" type="number"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_logistic_ref">Paid
                                                Ref#</label>
                                            <input id="new_grn_logistic_ref" name="new_grn_logistic_ref" type="number"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grn_logistic_paid_date">Paid
                                                Date</label>
                                            <input id="new_grn_logistic_paid_date" name="new_grn_logistic_paid_date" type="date"
                                                class="form-control" />
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
                                        <h3 id="new_grn_total_view" class="mb-1 font-weight-700">LKR. 0.00</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-9 col-md-8 col-12 px-0">
                        <div class="card rounded-0 shadow-sm border-0 h-100">

                            <div class="card-header d-flex align-items-center rounded-0">
                                <span class="flex-grow-1 font-weight-600"><i class="fa fa-folder-open pe-2"
                                        aria-hidden="true"></i>Add Purchasing Products</span>
                                <a href="#" class="text-muted text-decoration-none fs-12px">
                                    <i class="fa fa-fw fa-redo"></i>
                                </a>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grnproduct_product">Select
                                                Product</label>

                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                <input id="new_grnproduct_product" name="new_grnproduct_product" type="text"
                                                    class="form-control" placeholder="Type 'Product Name / Code' ">
                                            </div>
                                            <input type="hidden" id="new_grnproduct_product_id"
                                                name="new_grnproduct_product_id" />

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small_font" for="new_grnproduct_unit_price">Unit
                                                Price</label>
                                            <input id="new_grnproduct_unit_price" name="new_grnproduct_unit_price"
                                                type="number" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group mb-3">

                                            <label class="form-label small_font" for="new_grn_foreign_model">Select Foreign
                                                Model</label>
                                            <select id="new_grn_foreign_model" name="new_grn_foreign_model"
                                                class="form-select">
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <div class="row theme_bg_color_light me-0 ms-0"
                                        style="border-top-left-radius: 5px; border-top-right-radius: 5px">

                                        <div class="col-lg-10 col-md-12">
                                            <div class="form-group mb-3">
                                                <div class="form-group mb-3">
                                                    <label class="form-label font-weight-600 mt-2"
                                                        for="new_grnproduct_imei_number">Add Product IMEI Number</label>
                                                    <input id="new_grnproduct_imei_number" name="new_grnproduct_imei_number"
                                                        type="text" class="form-control"
                                                        style="border: 2px solid #a2cf6e; font-weight:600;" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label mt-2"
                                                    for="new_grnproduct_save_btn">&nbsp;</label><br>
                                                <button id="new_grnproduct_save_btn"
                                                    class="btn btn-primary w-100 shadow-sm">Add to
                                                    GRN</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="table-responsive" style="margin-top: -16px;">

                                        <table id="grn_save_product_list"
                                            class="table table-borderless table-striped text-nowrap w-100">
                                            <thead class="display-heading">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Actions</th>
                                                    <th>Product Name</th>
                                                    <th>Product IMEI</th>
                                                    <th>Unit Price</th>
                                                    <th>Foreign Model</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-0">
                                <div class="d-flex flex-row-reverse">
                                    <button id="new_grn_save_btn" class="btn btn-primary mb-2">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                                        Save GRN
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <div class="modal fade" id="grn_product_view_modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="grn_product_view_code_name" class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="row">
                                <div class="col-12">
                                    <img id="grn_product_view_img1" class="w-100 p-4"
                                        src="{{ asset('assets_front_end/image/products/left_pulses_bg_2.jpeg') }}" alt="">
                                </div>
                                <div class="col-12">
                                    <img id="grn_product_view_img2" class="w-100 p-4"
                                        src="{{ asset('assets_front_end/image/products/829166_2.jpeg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div id="grn_product_view_content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('back_end.layout.script')

@endsection
