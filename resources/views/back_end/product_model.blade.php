@extends('back_end.layout.app')

@section('content')

    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"
                            class="small_font font-weight-400  theme_font_color">Dashboard </a></li>
                    <li class="breadcrumb-item active small_font font-weight-400">Product Model Management</li>
                </ul>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-6">

                <div class="card mb-3 rounded-0">

                    <div class="card-header d-flex align-items-center rounded-0">
                        <span class="flex-grow-1 font-weight-600">
                            <i class="fa fa-folder-open pe-2" aria-hidden="true"></i>
                            Register Product Models</span>
                        <a href="#" class="text-muted text-decoration-none fs-12px">
                            <i class="fa fa-fw fa-redo"></i>
                        </a>
                    </div>

                    <div class="row">
                        <div class="card-plain">
                            <div class="card-body">
                                <div class="col-12">

                                    <label class="form-label small_font" for="new_product_function_name">
                                        Product Model Name
                                    </label>


                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group mb-3 w-100">
                                                <input id="new_product_model_name" name="new_product_model_name" type="text"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label small_font" for="new_product_select_product_type">Select /
                                                    Add Product
                                                    Type
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <div class="d-flex d-flex-row">
                                                    <select id="new_product_select_product_type"
                                                        name="new_product_select_product_type" class="form-select me-2">
                                                        @foreach ($productTypes as $key => $productType)
                                                            <option value="{{ $productType->id }}">
                                                                {{ $productType->product_type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label small_font" for="new_product_select_brand">Select /
                                                    Add Product
                                                    Brand
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <div class="d-flex d-flex-row">
                                                    <select id="new_product_select_brand" name="new_product_select_brand"
                                                        class="form-select me-2">
                                                        @foreach ($brand as $key => $brand)
                                                            <option value="{{ $brand->id }}">
                                                                {{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <a class="btn btn-default" data-bs-toggle="modal"
                                                        data-bs-target="#add_brand_modal">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <button id="product_model_save_btn" class="btn btn-primary">
                                                <i class="fa fa-fw fa-upload"></i> Save
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-group list-group-flush p-3">

                        <table id="model_list" class="table text-nowrap w-100">
                            <thead class="display-heading">
                                <tr>
                                    <th>#</th>
                                    <th>Model Name</th>
                                    <th>Product Type</th>
                                    <th>Brand</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>

        </div>

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

@endsection
