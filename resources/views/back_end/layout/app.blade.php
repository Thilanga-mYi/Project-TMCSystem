<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>TRACK MY CAR</title>

    <!-- CSS files -->
    <link href="{{ asset('assets_back_end/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_back_end/css/app.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets_back_end/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('assets_back_end/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link
        href="{{ asset('assets_back_end/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/select-picker/dist/picker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/summernote/dist/summernote-lite.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/blueimp-file-upload/css/jquery.fileupload.css') }}"
        rel="stylesheet" />

    <link href="{{ asset('assets_back_end/css/notiflix.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_back_end/css/custom.css') }}" rel="stylesheet" />

    <style>
        .ui_kit_checkbox.selectable-list {
            -webkit-columns: 2;
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

<body class="coverimg">
    <div>
        <main>
            <div id="app" class="app">

                <div id="header" class="app-header">

                    <div class="mobile-toggler">
                        <button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </button>
                    </div>

                    <div class="brand">
                        <div class="desktop-toggler">
                            <button type="button" class="menu-toggler" data-toggle="sidebar-minify">
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </button>
                        </div>
                        <a href="#" class="brand-logo pt-3 pb-3">
                            <img src="{{ asset('assets_back_end/img/tms_logo.png') }}" alt="logo-image"
                                class="img-fluid">
                        </a>
                    </div>

                    <div class="menu">
                        <form class="menu-search" method="POST" name="header_search_form">
                            <div class="menu-search-icon"><i class="fa fa-search"></i></div>
                            <div class="menu-search-input">
                                <input id="dashboardSeach" type="text" class="form-control"
                                    placeholder="Search menu..." />
                            </div>
                        </form>

                        <div class="menu-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
                                <div class="menu-img online">
                                    <img src="{{ asset('assets_back_end/img/user.png') }}" alt=""
                                        class="mw-100 mh-100 rounded-circle" />
                                </div>
                                <div class="menu-text">
                                    <span class="" data-cfemail="">{{ Auth::user()->name }}</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end me-lg-3">
                                <a class="dropdown-item d-flex align-items-center" href="/logout">Log Out
                                    <i class="fa fa-toggle-off fa-fw ms-auto text-gray-400 fs-16px"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="sidebar" class="app-sidebar bg-white">

                    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

                        <div class="menu">

                            @if (Auth::user()->email == 'thilanga96@gmail.com')
                                <div class="menu-header">Dashboard</div>
                                <div class="menu-item">
                                    <a href="/admin" class="menu-link">
                                        <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                                        <span class="menu-text">Dashboard</span>
                                    </a>
                                </div>

                                <div class="menu-divider"></div>

                                <div class="menu-header">Installation Management</div>

                                <div class="menu-item">
                                    <a href="/admin/new/installation" class="menu-link">
                                        <span class="menu-icon">
                                            <i class="fa fa-puzzle-piece pe-2"></i>
                                        </span>
                                        <span class="menu-text">New Installation</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <a href="/admin/installationList" class="menu-link">
                                        <span class="menu-icon">
                                            <i class="fa fa-database pe-2"></i>
                                        </span>
                                        <span class="menu-text">Installation List</span>
                                    </a>
                                </div>

                                <div class="menu-divider"></div>

                                <div class="menu-header">Category & Supplier Management</div>

                                <div class="menu-item">
                                    <a href="/admin/product/category" class="menu-link">
                                        <span class="menu-icon">
                                            <i class="fa fa-th-large pe-2"></i>
                                        </span>
                                        <span class="menu-text">Category Management</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <a href="/admin/supplier" class="menu-link">
                                        <span class="menu-icon">
                                            <i class="fa fa-handshake-o pe-2"></i>
                                        </span>
                                        <span class="menu-text">Supplier Registration</span>
                                    </a>
                                </div>

                                <div class="menu-divider"></div>

                                <div class="menu-header">Product Management</div>

                                <div class="menu-item">
                                    <a href="/admin/product" class="menu-link">
                                        <span class="menu-icon">
                                            <i class="fa fa-cube pe-2"></i>
                                        </span>
                                        <span class="menu-text">Product Registration</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <a href="/admin/product/models" class="menu-link">
                                        <span class="menu-icon">
                                            <i class="fa fa-cogs pe-2"></i>
                                        </span>
                                        <span class="menu-text">Product Model Management</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <a href="/admin/product_list" class="menu-link">
                                        <span class="menu-icon">
                                            <i class="fa fa-cubes pe-2"></i>
                                        </span>
                                        <span class="menu-text">Product Directory</span>
                                    </a>
                                </div>

                                <div class="menu-divider"></div>

                                <div class="menu-header">Purchases Management</div>

                                <div class="menu-item">
                                    <a href="/admin/grn" class="menu-link">
                                        <span class="menu-icon">
                                            <i class="fa fa-clipboard pe-2"></i>
                                        </span>
                                        <span class="menu-text">Add Purchase</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <a href="/admin/grn_list" class="menu-link">
                                        <span class="menu-icon">
                                            <i class="fa fa-database pe-2"></i>
                                        </span>
                                        <span class="menu-text">List Purchases</span>
                                    </a>
                                </div>
                            @endif

                            <div class="menu-header">Customer Registration & Management</div>

                            <div class="menu-item">
                                <a href="/admin/customer" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-user pe-2"></i>
                                    </span>
                                    <span class="menu-text">Customer Directory</span>
                                </a>
                            </div>

                            <div class="menu-header">Stock & Invoices Management</div>

                            <div class="menu-item">
                                <a href="/admin/stock" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-cubes pe-2"></i>
                                    </span>
                                    <span class="menu-text">Item Stock</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a href="/admin/invoice" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-barcode pe-2"></i>
                                    </span>
                                    <span class="menu-text">POS Invoice</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a href="/admin/invoice_list" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-book pe-2"></i>
                                    </span>
                                    <span class="menu-text">Invoice List</span>
                                </a>
                            </div>

                        </div>

                    </div>

                    <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
                </div>

                @yield('content')
                <a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>

            </div>
        </main>
    </div>

    <div class="modal fade" id="new_customer_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Customer</h5>
                    <button id="new_customer_modal_close_btn" type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" id="new_customer">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_customer_name">Customer Name <span
                                    class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="new_customer_name"
                                name="new_customer_name" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_customer_email">Email
                                <span class="text-danger">*</span></label>
                            </label>
                            <input type="email" class="form-control" id="new_customer_email"
                                name="new_customer_email" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_customer_nic">Customer NIC / Passport<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="new_customer_nic" name="new_customer_nic" />
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_customer_company_name">Company
                                        Name</label>
                                    <input type="text" class="form-control" id="new_customer_company_name"
                                        name="new_customer_company_name" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font"
                                        for="new_customer_registration_number">Registration
                                        Number</label>
                                    <input type="text" class="form-control" id="new_customer_registration_number"
                                        name="new_customer_registration_number" />
                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_customer_street_address">Street Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="new_customer_street_address"
                                name="new_customer_street_address" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_customer_city">City <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="new_customer_city"
                                name="new_customer_city" />
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_customer_tel1">Telephone (Primary)
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="new_customer_tel1"
                                        name="new_customer_tel1" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="new_customer_tel2">Telephone
                                        (Secondary)</label>
                                    <input type="text" class="form-control" id="new_customer_tel2"
                                        name="new_customer_tel2" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="new_customer_password_send" name="new_customer_password_send"
                                        checked="">
                                    <label class="form-check-label" for="new_customer_password_send">Password send by Email</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="d-flex flex-row-reverse">
                            <button id="new_customer_save_btn" class="btn btn-primary ">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Save
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update_customer_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Customer</h5>
                    <button id="new_customer_modal_close_btn" type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" id="update_customer_form">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label class="form-label" for="update_customer_name">Customer Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_customer_name"
                                name="update_customer_name" readonly />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="update_customer_nic">Customer NIC / Passport<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_customer_nic"
                                name="update_customer_nic" />
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="update_customer_company_name">Company
                                        Name</label>
                                    <input type="text" class="form-control" id="update_customer_company_name"
                                        name="update_customer_company_name" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label class="form-label"
                                        for="update_customer_registration_number">Registration
                                        Number</label>
                                    <input type="text" class="form-control" id="update_customer_registration_number"
                                        name="update_customer_registration_number" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="update_customer_street_address">Street Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_customer_street_address"
                                name="update_customer_street_address" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="update_customer_city">City <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_customer_city"
                                name="update_customer_city" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="update_customer_tel1">Telephone (Primary) <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_customer_tel1"
                                name="update_customer_tel1" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="update_customer_tel2">Telephone (Secondary)</label>
                            <input type="text" class="form-control" id="update_customer_tel2"
                                name="update_customer_tel2" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="update_customer_email">Email</label>
                            <input type="email" class="form-control" id="update_customer_email"
                                name="update_customer_email" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="update_customer_bank_details">Bank Details</label>
                            <textarea id="update_customer_bank_details" name="update_customer_bank_details" class="form-control"
                                rows="3"></textarea>
                        </div>


                    </div>

                    <div class="card-footer">
                        <div class="d-flex flex-row-reverse">
                            <button id="update_customer_save_btn" class="btn btn-primary ">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Update
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>
