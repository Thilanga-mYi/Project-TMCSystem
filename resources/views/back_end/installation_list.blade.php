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
            <div class="col-xl-12">
                <div class="card mb-3 rounded-0">

                    <div class="card-header d-flex align-items-center rounded-0 ">
                        <span class="flex-grow-1 font-weight-600"><i class="fa fa-folder-open pe-2"
                                aria-hidden="true"></i>Installation Directory</span>
                        <a href="#" class="text-muted text-decoration-none fs-12px">
                            <i class="fa fa-fw fa-redo"></i>
                        </a>
                    </div>

                    <div class="px-3 py-3 d-flex align-items-center">
                        <span class="flex-grow-1">
                            Please use the table below to navigate or filter the results. You can download the table as
                            excel and pdf.
                        </span>
                        <a class="btn btn-default btn-sm" href="/admin/new/installation">
                            <i class="fa fa-plus fa-fw"></i>
                            New
                        </a>
                    </div>

                    <div class="list-group list-group-flush">

                        <div class="table-responsive table-stripped">

                            <table id="installation_list" class="table table-striped text-nowrap w-100">
                                <thead class="display-heading" style="background-color: #e0e0e0">
                                    <tr>
                                        <th>#</th>
                                        <th>Action</th>
                                        <th>Customer Name</th>
                                        <th>SIM Number</th>
                                        <th>Device IMEI</th>
                                        <th>Device Model</th>
                                        <th>Vehicle Plate</th>
                                        <th>Vehicle Model</th>
                                        <th>Vehicle Milage</th>
                                        <th>Engine Hours (h)</th>
                                        <th>Engine Hours (m)</th>
                                        <th>Invoice Code</th>
                                        <th>Annual Fee</th>
                                        <th>Travelling Fee</th>
                                        <th>Warranty</th>
                                        <th>Payment Method</th>
                                        <th>Installed By</th>
                                        <th>Hand Bill Number</th>
                                        <th>Admin Number In Use</th>
                                        <th>Admin Number</th>
                                        <th>Job Referance</th>
                                        <th>Status</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input id="installation_list_customer_name" type="text" class="form-control"
                                                style="width: 200px">
                                        </td>
                                        <td>
                                            <input id="installation_list_sim_number" type="number" class="form-control"
                                                style="width: 150px">
                                        </td>
                                        <td>
                                            <input id="installation_list_device_imei" type="text" class="form-control"
                                                style="width: 150px">
                                        </td>
                                        <td>
                                            <select id="installation_list_device_model" class="form-select"
                                                style="width: 150px">
                                                <option>Abc</option>
                                                <option>Def</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input id="installation_list_vehicle_plate" type="text" class="form-control"
                                                style="width: 100px">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input id="installation_list_invoice_code" type="text" class="form-control"
                                                style="width: 150px">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <select id="installation_list_payment_type" class="form-select">
                                                <option>Cash</option>
                                                <option>Card</option>
                                                <option>Cheque</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="installation_list_installed_by" class="form-select"
                                                style="width: 150px">
                                                <option>Emp 1</option>
                                                <option>Emp 2</option>
                                                <option>Emp 3</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($tableData as $key => $value)

                                        <tr>
                                            <td class="align-middle">{{ $value[0] }}</td>
                                            <td class="align-middle">{!!$value[20] !!}</td>
                                            <td class="align-middle">{{ $value[1] }}</td>
                                            <td class="align-middle">{{ $value[2] }}</td>
                                            <td class="align-middle">{{ $value[3] }}</td>
                                            <td class="align-middle">{{ $value[4] }}</td>
                                            <td class="align-middle">{{ $value[5] }}</td>
                                            <td class="align-middle">{{ $value[6] }}</td>
                                            <td class="align-middle">{{ $value[7] }}</td>
                                            <td class="align-middle">{{ $value[8] }}</td>
                                            <td class="align-middle">{{ $value[9] }}</td>
                                            <td class="align-middle">{{ $value[10] }}</td>
                                            <td class="align-middle">{{ $value[11] }}</td>
                                            <td class="align-middle">{{ $value[12] }}</td>
                                            <td class="align-middle">{{ $value[13] }}</td>
                                            <td class="align-middle">{{ $value[14] }}</td>
                                            <td class="align-middle">{{ $value[15] }}</td>
                                            <td class="align-middle">{{ $value[16] }}</td>
                                            <td class="align-middle">{{ $value[17] }}</td>
                                            <td class="align-middle">{{ $value[18] }}</td>
                                            <td class="align-middle">{{ $value[19] }}</td>
                                            <td class="align-middle">{!! $value[21] !!}</td>
                                        </tr>

                                    @endforeach

                                </tbody>

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
