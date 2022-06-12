@extends('back_end.layout.app')

@section('content')
    <div id="content" class="app-content">

        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"
                            class="small_font font-weight-400  theme_font_color">Dashboard </a></li>
                    <li class="breadcrumb-item active small_font font-weight-400">Installation List</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="card mb-3 rounded-0">

                <div class="card-header d-flex align-items-center rounded-0" style="margin-left:-8px ; margin-right:-8px">
                    <span class="flex-grow-1 font-weight-600">
                        <i class="fa fa-folder-open pe-2" aria-hidden="true"></i>
                        Installation Directory
                    </span>
                    <a href="#" class="text-muted text-decoration-none fs-12px">
                        <i class="fa fa-fw fa-redo"></i>
                    </a>
                </div>

                <div class="px-3 py-3 d-flex align-items-center"
                    style="border-bottom: 1px solid #eee ; padding-right: 0px ; margin-left:-8px ; margin-right:-8px">
                    <span class="flex-grow-1">
                        Please use the table below to navigate or filter the results. You can download the table as
                        excel and pdf.
                    </span>
                    <a class="btn btn-default btn-sm" href="/admin/new/installation">
                        <i class="fa fa-plus fa-fw"></i>
                        New
                    </a>
                </div>

                <div class="row">

                    <div class="mb-3">
                        <div class="table-responsive">
                            <br>
                            <table id="installation_list" class="table table-borderless table-striped text-nowrap w-100">
                                <thead class="display-heading">
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice Code</th>
                                        <th>Customer Name</th>
                                        <th>SIM</th>
                                        <th>Device IMEI</th>
                                        <th>Installation Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
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

    <div class="modal fade" id="sim_change_modal" style="height: 100%">
        <div class="modal-dialog modal-md">
            <div class="modal-content rounded-0">
                <div class="card-header d-flex align-items-center">

                    <span class="flex-grow-1 font-weight-400">
                        <i class="fa fa-star pe-2" aria-hidden="true"></i>Installed SIM Card Change
                    </span>

                    <button id="new_category_modal_close_btn" type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="installation_sim_customer_name">
                                        Customer Name
                                    </label>
                                    <input id="installation_sim_customer_name" name="installation_sim_customer_name"
                                        type="text" class="form-control" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="installation_sim_customer_email">
                                        Customer Email
                                    </label>
                                    <input id="installation_sim_customer_email" name="installation_sim_customer_email"
                                        type="text" class="form-control w-100" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="installation_sim_vehicle_number">
                                        Vehicle Number
                                    </label>
                                    <input id="installation_sim_vehicle_number" name="installation_sim_vehicle_number"
                                        type="text" class="form-control w-100" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="installation_sim_vehicle_model">
                                        Vehicle Model
                                    </label>
                                    <input id="installation_sim_vehicle_model" name="installation_sim_vehicle_model"
                                        type="text" class="form-control" disabled />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr style="border-top: 1px dashed #9e9e9e;">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="installation_sim_current_sim">
                                        Current SIM
                                    </label>
                                    <input id="installation_sim_current_sim" name="installation_sim_current_sim" type="text"
                                        class="form-control" disabled />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">

                                    <label class="form-label small_font" for="new_invoice_billing_to">
                                        New SIM Card Number
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        <input id="installation_new_sim" name="installation_new_sim" type="text"
                                            class="form-control" placeholder="Type 'New SIM Number' " autocomplete="off">
                                    </div>
                                    <input type="hidden" id="installation_new_sim_id" name="installation_new_sim_id" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr style="border-top: 1px dashed #9e9e9e;">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="installation_sim_additional_amount">
                                        Additional Amount
                                    </label>
                                    <input id="installation_sim_additional_amount" name="installation_sim_additional_amount" type="number"
                                        class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="installation_sim_remark">
                                        Remark
                                    </label>
                                    <textarea name="installation_sim_remark" id="installation_sim_remark" rows="3" class="form-control"></textarea>
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
                                <h3 id="installation_new_sim_total" class="mb-1 font-weight-700">LKR. 0.00</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer p-0 m-0">
                    <div class="d-flex justify-content-end">
                        <button id="rider_rating_confirm_btn" class="btn btn-success text-white w-100 rounded-0">
                            <i class="fa fa-long-arrow-right me-1" aria-hidden="true"></i> Submit
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
