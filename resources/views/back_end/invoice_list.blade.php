@extends('back_end.layout.app')

@section('content')

    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"
                            class="small_font font-weight-400  theme_font_color">Dashboard</a></li>
                    <li class="breadcrumb-item active small_font font-weight-400">Online Orders</li>
                </ul>
            </div>
        </div>

        <div class="row">

            <div class="card rounded-0 shadow-none">

                <div class="card-header d-flex align-items-center rounded-0" style="margin-left:-8px ; margin-right:-8px">
                    <span class="flex-grow-1 font-weight-600"><i class="fa fa-star pe-2" aria-hidden="true"></i>
                        View Online Orders
                    </span>
                    <a href="#" class="text-muted text-decoration-none fs-12px">
                        <i class="fa fa-fw fa-redo"></i>
                    </a>
                </div>

                <div class="px-3 py-3"
                    style="border-bottom: 1px solid #eee ; padding-right: 0px ; margin-left:-8px ; margin-right:-8px">
                    <div class="row">
                        <span>
                            Please use the table below to navigate or filter the results. You can download the table as
                            excel and pdf.
                        </span>
                    </div>
                </div>

                <div class="row">

                    <div class="mt-3 mb-3">

                        <div class="table-responsive">

                            <table id="administration_wise_invoices" class="table table-borderless table-striped text-nowrap w-100">
                                <thead class="display-heading">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Invoice Code</th>
                                        <th>Referance</th>
                                        <th>Warehouse</th>
                                        <th>Billing to</th>
                                        <th>Billing Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>

                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_invoice">
        <div class="modal-dialog modal-xl">
            <div class="modal-content rounded-0">
                <div class="card-header d-flex align-items-center">
                    <span class="flex-grow-1 font-weight-400">
                        <i class="fa fa-eye pe-2" aria-hidden="true"></i>Purchase Details
                    </span>
                    <button id="new_category_modal_close_btn" type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row mb-3">

                        <div class="col-lg-4">
                            <div class="card rounded-0 border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex flex-row">
                                        <div class="me-3">
                                            <i class="fa fa-3x fa-building padding010 theme_font_color"></i>
                                        </div>
                                        <div>
                                            <h5 id="view_invoice_invoice_code"></h5>
                                            <p id="view_billing_to" class="small_font">
                                            </p>
                                            <span id="view_invoice_billing_address" class="small_font"></span>
                                            <br>
                                            <span id="view_invoice_referance" class="small_font"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card rounded-0 border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex flex-row">
                                        <div class="me-3">
                                            <i class="fa fa-3x fa-truck padding010 theme_font_color"></i>
                                        </div>
                                        <div>
                                            <h5 id="view_invoice_warehouse_name"></h5>
                                            <p id="view_invoice_warehouse_address" class="small_font"></p>
                                            <span id="view_invoice_warehouse_tel" class="small_font"></span>
                                            <br>
                                            <span id="view_invoice_warehouse_email" class="small_font"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card rounded-0 border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex flex-row">
                                        <div class="me-3">
                                            <i class="fa fa-3x fa-file-text-o padding010 theme_font_color"></i>
                                        </div>
                                        <div>
                                            <h5 id="view_invoice_date"></h5>
                                            <span id="view_invoice_status" class="small_font"></span>
                                            <br>
                                            <span id="view_invoice_payment_status" class="small_font"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table id="view_invoice_list" class="table table-bordered text-nowrap w-100">
                                <thead class="display-heading">
                                    <tr>
                                        <th>#</th>
                                        <th class="w-50">Description</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Sub Total</th>
                                        <th>Discount</th>
                                        <th>Net Total</th>
                                    </tr>
                                </thead>
                                <tbody id="view_invoice_table"></tbody>
                            </table>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <span>Created by: {{Auth::user()->email}}</span>
                            <br>
                            <span>Date: 01/11/2021</span>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex d-flex-row">
                        <button class="btn btn-default me-1">
                            <i class="fa fa-print me-1" aria-hidden="true"></i> Print
                        </button>
                        {{-- <button class="btn btn-default mx-1" onclick="view_purchase_payment_func()">
                            <i class="fa fa-money me-1" aria-hidden="true"></i> View Payment
                        </button> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
