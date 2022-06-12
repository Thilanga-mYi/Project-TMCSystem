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
                                        <th>Vehicle Plate</th>
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
                        <i class="fa fa-star pe-2" aria-hidden="true"></i>Installation SIM Change
                    </span>

                    <button id="new_category_modal_close_btn" type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button id="rider_rating_confirm_btn" class="btn btn-teal text-white me-1">
                            <i class="fa fa-long-arrow-right me-1" aria-hidden="true"></i> Procced to Complete
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
