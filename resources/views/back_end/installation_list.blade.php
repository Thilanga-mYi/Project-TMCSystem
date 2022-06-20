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
                                    <label class="form-label small_font" id="installation_sim_vehicle_number_lbl"
                                        for="installation_sim_vehicle_number">
                                        Vehicle Number
                                    </label>
                                    <input id="installation_sim_vehicle_number" name="installation_sim_vehicle_number"
                                        type="text" class="form-control w-100" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" id="installation_sim_vehicle_model_lbl"
                                        for="installation_sim_vehicle_model">
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
                                    <input id="installation_sim_additional_amount" name="installation_sim_additional_amount"
                                        type="number" class="form-control" />
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
                                <h3 id="sim_change_total" class="mb-1 font-weight-700">LKR. 0.00</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer p-0 m-0">
                    <div class="d-flex justify-content-end">
                        <button id="sim_change_submit_btn" class="btn btn-success text-white w-100 rounded-0">
                            <i class="fa fa-long-arrow-right me-1" aria-hidden="true"></i> Submit
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('back_end.layout.script')

    <script>
        var installation_datatable_list = $('#installation_datatable_list').DataTable({
            dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
            lengthMenu: [10, 20, 30, 40, 50],
            responsive: true,
            pageLength: 20,
            buttons: [{
                    extend: 'print',
                    className: 'btn btn-default d-none '
                },
                {
                    extend: 'csv',
                    className: 'btn btn-default d-none'
                }
            ],
            ajax: {
                url: '/admin/installation/list',
                dataSrc: ''
            },
            createdRow: function(row, data, dataIndex, cells) {
                $(cells).addClass('py-1 align-middle');
            }
        });

        var sim_change_modal = $('#sim_change_modal');

        function sim_change(id) {
            // alert('Installation Id ' + id);
            sim_change_modal.modal('toggle');
        }

        // START PRODUCT IMAGE EDIT

        function product_image_edit(id) {
            window.location.href = '/admin/product/get/advanceEditView?product_id=' + id + '';
        }

        var edit_product_form = $('#edit_product_form');
        var edit_product_des = $('#edit_product_des');

        edit_product_form.on('submit', function(e) {
            e.preventDefault();

            Notiflix.Confirm.Show('Product Save Confirmation', 'Please confirm to edit this product?', 'Confirm',
                'Ignore',
                function() {

                    var formData = new FormData(edit_product_form[0]);

                    $.ajax({
                        url: "/admin/product/save/advanceEditSave",
                        method: "POST",
                        data: formData,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            Notiflix.Loading.Pulse();
                        },
                        success: function(response) {
                            Notiflix.Loading.Remove();

                            if ($.isEmptyObject(response.error)) {
                                if (response['type'] == 'error') {
                                    Notiflix.Notify.Failure(response['des']);
                                } else if (response['type'] == 'success') {
                                    Notiflix.Notify.Success(response['des']);
                                    window.location.href = '/admin/product_list';
                                }
                            } else {
                                $.each(response.error, function(key, value) {
                                    Notiflix.Notify.Failure(value);
                                });
                            }
                        }
                    });

                },
                function() {});
        });

        // END PRODUCT IMAGE EDIT

        // START INSTALLATION LIST

        var installation_list = $('#installation_list').DataTable({
            dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
            lengthMenu: [10, 20, 30, 40, 50],
            responsive: false,
            pageLength: 20,
            searching: true,
            paging: true,
            buttons: [{
                    extend: 'print',
                    className: 'btn btn-default d-none'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-default d-none'
                }
            ],
            ajax: {
                url: '/admin/installation/list',
                dataSrc: ''
            },
            createdRow: function(row, data, dataIndex, cells) {
                $(cells).addClass('py-1 align-middle');
            }
        });

        // END INSTALLATION LIST

        // START INSTALLATION SIM CHANGE

        var sim_change_modal = $('#sim_change_modal')
        var installation_new_sim = $('#installation_new_sim')
        var installation_new_sim_id = $('#installation_new_sim_id')

        var installation_sim_customer_name = $('#installation_sim_customer_name')
        var installation_sim_customer_email = $('#installation_sim_customer_email')
        var installation_sim_vehicle_number = $('#installation_sim_vehicle_number')
        var installation_sim_vehicle_model = $('#installation_sim_vehicle_model')
        var installation_sim_current_sim = $('#installation_sim_current_sim')
        var installation_sim_vehicle_number_lbl = $('#installation_sim_vehicle_number_lbl')
        var installation_sim_vehicle_model_lbl = $('#installation_sim_vehicle_model_lbl')

        var sim_change_total_lbl = $('#sim_change_total')
        var installation_sim_additional_amount = $('#installation_sim_additional_amount')
        var installation_sim_remark = $('#installation_sim_remark')

        function installation_sim_change(id) {

            $.ajax({
                type: "GET",
                url: "/admin/installation/sim-change/view-details",
                data: {
                    id: id,
                },
                beforeSend: function() {
                    Notiflix.Loading.Pulse();
                },
                success: function(response) {
                    Notiflix.Loading.Remove();

                    installation_sim_customer_name.val(response['customer_name']);
                    installation_sim_customer_email.val(response['customer_email']);
                    installation_sim_current_sim.val(response['current_sim']);

                    if (response['installation_type'] == 1) {

                        installation_sim_vehicle_number_lbl.removeClass('d-none');
                        installation_sim_vehicle_model_lbl.removeClass('d-none');
                        installation_sim_vehicle_number.removeClass('d-none');
                        installation_sim_vehicle_model.removeClass('d-none');

                        installation_sim_vehicle_number.val(response['customer_vehicle_number']);
                        installation_sim_vehicle_model.val(response['customer_vehicle_model']);
                    } else {
                        installation_sim_vehicle_number_lbl.addClass('d-none');
                        installation_sim_vehicle_model_lbl.addClass('d-none');
                        installation_sim_vehicle_number.addClass('d-none');
                        installation_sim_vehicle_model.addClass('d-none');
                    }

                    installation_new_sim_id.val("");
                    installation_sim_additional_amount.val("");
                    installation_sim_remark.val("");

                    sim_change_modal.modal('toggle');
                }
            });

        }

        var installation_SIM_changeTempMap = installation_new_sim.typeahead({
            source: function(query, process) {
                return $.get('/admin/product/sim/get/suggetions', {
                    query: query,
                }, function(data) {
                    data.forEach(element => {
                        installation_SIM_changeTempMap[element['name']] = element['id'];
                    });
                    return process(data);
                });
            }
        });

        installation_new_sim.change(function(e) {
            var tempId = installation_SIM_changeTempMap[installation_new_sim.val()];
            if (tempId != 0) {
                installation_new_sim_id.val(tempId);

                calculateSIMChangeAmount();

            }
        });


        installation_sim_additional_amount.keyup(function(e) {
            calculateSIMChangeAmount();
        });

        function calculateSIMChangeAmount() {

            $.ajax({
                type: "GET",
                url: "/admin/installation/sim-change/getSIMChangeTotal",
                data: {
                    sim_id: isNaN(installation_new_sim_id.val()) ? 0 : installation_new_sim_id.val(),
                    additional_amount: isNaN(installation_sim_additional_amount.val()) ? 0 :
                        installation_sim_additional_amount.val()
                },
                success: function(response) {

                    sim_change_total_lbl.html('');
                    sim_change_total_lbl.html('LKR. ' + response);

                }
            });

        }

        var sim_change_submit_btn = $('#sim_change_submit_btn');

        sim_change_submit_btn.click(function(e) {
            e.preventDefault();


            Notiflix.Confirm.Show('SIM Change Confirmation', 'Please confirm to change SIM details', 'Confirm',
                'Ignore',
                function() {

                    $.ajax({
                        type: "GET",
                        url: "/admin/installation/sim-change/submit",
                        data: {
                            sim_id: installation_new_sim_id.val(),
                            additional_amount: installation_sim_additional_amount.val(),
                            remark: installation_sim_remark.val(),
                        },
                        beforeSend: function() {
                            Notiflix.Loading.Pulse();
                        },
                        success: function(response) {
                            Notiflix.Loading.Remove();

                            console.log(response);

                            if ($.isEmptyObject(response.error)) {

                                if (response['type'] == 'success') {

                                    Notiflix.Notify.Success(response['des']);
                                    installation_datatable_list.ajax.reload(null, false);

                                } else {
                                    Notiflix.Notify.Failure(response['des']);
                                }

                            } else {
                                Notiflix.Loading.Remove();
                                $.each(response.error, function(key, value) {
                                    Notiflix.Notify.Failure(value);
                                });
                            }
                        }
                    });
                },
                function() {});
        });


        // END INSTALLATION SIM CHANGE
    </script>
@endsection
