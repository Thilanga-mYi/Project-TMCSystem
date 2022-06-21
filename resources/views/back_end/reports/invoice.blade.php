<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <link rel="stylesheet" href="{{ asset('assets_back_end/css/vendor.min.css') }}">
    <link href="{{ asset('assets_back_end/css/app.min.css') }}" rel="stylesheet" />

    <style>
        @page {
            size: A4;
            margin-top: 10;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
                padding-left: 10px;
                padding-right: 20px;
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }

        .font {
            font-family: 'Segoe UI';
        }

        .tborderth {
            border-top: 1px solid #212121;
            padding: 5px;
            margin: 0px;
        }

        .tbleft {
            padding-left: 10px;
            border-left: 1px solid #212121
        }

        .tbright {
            padding-right: 10px;
            border-right: 1px solid #212121
        }

        .tborder {
            border-bottom: 1px solid #212121;
            padding-top: 10px;
            padding-bottom: 10px;
            margin: 0px;

        }

        .alright {
            text-align: right
        }

        .smargin {
            padding: 5px;
        }

        .bold-100 {
            font-weight: 500;
        }

        .trcolor {
            background-color: rgb(238, 238, 238);
            -webkit-print-color-adjust: exact;
        }

        .text-align-right {
            margin-left: auto;
            margin-right: 0px;
        }
    </style>

    <style>
        .ui_kit_checkbox.selectable-list {
            -webkit-columns: 3;
        }

        ul,
        ol {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .custom-control {
            position: relative;
            display: block;
            min-height: 1.5rem;
            padding-left: 1.5rem;
        }
    </style>

</head>

<body class="bg-white">

    <div class="container">

        <div class="d-flex justify-content-center mb-5">
            <div class="text-center">
                <div class="mt-3">
                    <h3>TRACK MY CAR</h3>
                    <span>
                        NO. 29/B Athurugiriya road, Kottawa, Sri Lanka.
                    </span>
                    <br>
                    <span>0777 544 858</span>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">

                <tr>
                    <td colspan="4" class="text-center">
                        <b>NEW INSTALLATION</b>
                        {{-- <b>RE INSTALLATION</b> --}}
                    </td>
                </tr>

                {{-- CUSTOMER DETAILS 1 --}}
                <tr>
                    <td style="width: 15%">Name</td>
                    <td>{{ $installation_data['getCustomer']['name'] }}</td>
                    <td style="width: 15%">Date</td>
                    <td>{{ $installation_data['created_at'] }}</td>
                </tr>
                {{-- CUSTOMER DETAILS 2 --}}
                <tr>
                    <td style="width: 15%">Contact</td>
                    <td>{{ $installation_data['getCustomer']['tel1'] }}</td>
                    <td style="width: 15%">Address</td>
                    <td>{{ $installation_data['getCustomer']['street_address'] }}
                    </td>
                </tr>

                {{-- CUSTOMER ADDRESS DETAILS --}}
                <tr>
                    <td style="width: 15%">Location</td>
                    <td>{{ $installation_data['getCustomer']['city'] }}</td>
                    <td style="width: 15%">NIC / P.N</td>
                    <td>{{ $installation_data['getCustomer']['nic_or_passport'] }}</td>
                </tr>

                {{-- VEHICLE AND DEVICE DETAILS --}}

                @if ($installation_data['installation_type'] == 1)
                    <tr>
                        <td colspan="4"><b>VEHICLE DETAILS</b></td>
                    </tr>
                    <tr>
                        <td style="width:15%">Plate Number</td>
                        <td>{{ $installation_data['vehicle_plate_number'] }}</td>
                        <td style="width:15%">Mileage (Km)</td>
                        <td>{{ $installation_data['vehicle_milage'] }}</td>
                    </tr>
                    <tr>
                        <td style="width: 15%">Model</td>
                        <td>{{ $installation_data['vehicle_milage'] }}</td>
                        <td style="width: 15%">Engine Hours</td>
                        <td>H : {{ $installation_data['engine_hours_h'] }} M :
                            {{ $installation_data['engine_hours_m'] }}</td>
                    </tr>
                @endif

                {{-- SIM / DEVICE DETAILS --}}
                <tr>
                    <td colspan="4"><b>DEVICE DETAILS</b></td>
                </tr>
                <tr>
                    <td style="width: 15%">SIM Number</td>
                    <td colspan="3">
                        @if ($installation_data['sim_card_id'] != 0)
                            {{ $installation_data['getSIM']['imei'] }}
                        @else
                            -
                        @endif

                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">IMEI or ID</td>
                    <td>{{ $installation_data['getDevice']['imei'] }}</td>
                    <td style="width: 15%">Device Model</td>
                    <td>{{ $installation_data['getDevice']['getProduct']['getProductModel']['model_name'] }}</td>
                </tr>

                {{-- FUNCTIONS --}}
                <tr>
                    <td style="width: 15%">Functions</td>
                    <td colspan="3">
                        <ul class="ui_kit_checkbox selectable-list">

                            @foreach ($features_data as $feature)
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" value="{{ $feature['getFeature']['id'] }}"
                                            class="custom-control-input me-2" name="funtion_checkbox" checked>
                                        <label class="custom-control-label" for="customCheck1">
                                            {{ $feature['getFeature']['name'] }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </td>
                </tr>

                <tr>

                </tr>

                <tr>
                    <td colspan="4">
                        <b>ADMIN NUMBER</b>
                    </td>
                </tr>

                <tr>
                    <td style="width: 15%">In Use Status</td>
                    <td>
                        <div class="d-flex justify-content-between">

                            @if ($installation_data['admin_in_use'] == 'yes')
                                <div>
                                    <input type="checkbox" value="1" class="custom-control-input me-2"
                                        name="funtion_checkbox" checked>
                                    <label class="custom-control-label" for="customCheck1">
                                        Yes
                                    </label>
                                </div>

                                <div>
                                    <input type="checkbox" value="1" class="custom-control-input me-2"
                                        name="funtion_checkbox">
                                    <label class="custom-control-label" for="customCheck1">
                                        No
                                    </label>
                                </div>
                            @else
                                <div>
                                    <input type="checkbox" value="1" class="custom-control-input me-2"
                                        name="funtion_checkbox" checked>
                                    <label class="custom-control-label" for="customCheck1">
                                        Yes
                                    </label>
                                </div>


                                <div>
                                    <input type="checkbox" value="1" class="custom-control-input me-2"
                                        name="funtion_checkbox">
                                    <label class="custom-control-label" for="customCheck1" checked>
                                        No
                                    </label>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td style="width: 15%">Admin Number</td>
                    <td>{{ $installation_data['admin_numbers'] }}</td>
                </tr>

                <tr>
                    <td colspan="4"><b>PAYMENT DETAILS</b></td>
                </tr>

                <tr>
                    <td style="width: 15%">Invoice No</td>
                    <td>{{ $invoice_data['invoice_code'] }}</td>
                    <td style="width: 15%">Payment Method</td>
                    <td>{{ $installation_data['getPaymentType']['method'] }}</td>
                </tr>

                <tr>
                    <td style="width: 15%">Travelling Fee (LKR)</td>
                    <td class="text-left">{{ $installation_data['travelling_fee'] }}</td>
                    <td style="width: 15%">Annual Fee (LKR)</td>
                    <td class="">{{ $installation_data['annual_fee'] }}</td>
                </tr>

                <tr>
                    <td style="width: 15%">Warrenty Period</td>
                    <td class="text-left">{{ $installation_data['getWarranty']['title'] }}</td>
                    <td style="width: 15%">Invoice Amount (LKR)</td>
                    <td class="pull-right">{{ $invoice_data['total'] }}</td>
                </tr>

                <tr>
                    <td colspan="4"><b>OTHER DETAILS</b></td>
                </tr>

                <tr>
                    <td colspan="4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                    name="funtion_checkbox">
                                <label class="custom-control-label" for="customCheck1">
                                    FB
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                    name="funtion_checkbox">
                                <label class="custom-control-label" for="customCheck1">
                                    Ikman.lk
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                    name="funtion_checkbox">
                                <label class="custom-control-label" for="customCheck1">
                                    Recommendation
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                    name="funtion_checkbox">
                                <label class="custom-control-label" for="customCheck1">
                                    Old Customer
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                    name="funtion_checkbox">
                                <label class="custom-control-label" for="customCheck1">
                                    Goolge
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" value="1" class="custom-control-input me-2"
                                    name="funtion_checkbox">
                                <label class="custom-control-label" for="customCheck1">
                                    Shop Board
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 15%">Remark</td>
                    <td colspan="3">{!! $invoice_data['remark'] !!}</td>
                </tr>

                <tr>
                    <td style="width: 15%">Installed By</td>
                    <td colspan="3">{{ $emp }}</td>
                </tr>



            </table>
        </div>

    </div>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>
