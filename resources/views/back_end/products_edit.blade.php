@extends('back_end.layout.app')

@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"
                            class="small_font font-weight-400  theme_font_color">Dashboard </a></li>
                    <li class="breadcrumb-item active small_font font-weight-400">Product Edit</li>
                </ul>
            </div>
        </div>

        <style>
            .product_card_div {
                border-right: 1px solid #eee;
            }

        </style>
        <form method="POST" id="edit_product_form" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-12 px-0">
                    <div class="card shadow-none border-0 rounded-0">
                        <div class="card-header d-flex align-items-center rounded-0">
                            <span class="flex-grow-1 font-weight-600"><i class="fa fa-folder-open pe-2"
                                    aria-hidden="true"></i>Advance Product Edit</span>
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

                <div class="col-lg-3 col-md-6" style="padding: 0px">

                    <div class="card border-0 shadow-sm rounded-0 h-100">

                        <div class="card-header d-flex align-items-center rounded-0"
                            style="border-bottom: 3px solid #4caf50; background-color: #c5e1a5">
                            <span class="flex-grow-1 font-weight-600">PRIMARY DETAILS</span>
                        </div>

                        <div class="card-body">

                            <div class="col-12 d-none">
                                <div class="form-group mb-3 d-none">
                                    <label class="form-label small_font" for="edit_product_id">Product ID
                                        <span class="text-danger">*</span></label>
                                    <input id="edit_product_id" name="edit_product_id" type="text" class="form-control"
                                        value="{{ $productObj['id'] }}" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="edit_product_select_product_type">Select
                                        Product Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="edit_product_select_product_type" name="edit_product_select_product_type"
                                        class="form-select">
                                        @foreach ($productType as $key => $productType)
                                            @if ($productObj['product_type_id'] == $productType->id)
                                                <option value="{{ $productType->id }}" selected>
                                                    {{ $productType->product_type }}</option>
                                            @else
                                                <option value="{{ $productType->id }}">
                                                    {{ $productType->product_type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3 d-none">
                                    <label class="form-label small_font" for="edit_product_sku">Product IMEI / ID / SIM
                                        Number
                                        <span class="text-danger">*</span></label>
                                    <input id="edit_product_sku" name="edit_product_sku" type="text"
                                        class="form-control" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="edit_product_name_lang1">Product Name
                                    </label>
                                    <input id="edit_product_name_lang1" name="edit_product_name_lang1" type="text"
                                        class="form-control" value="{{ $productObj->lang1_name }}" />
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="edit_product_select_category">Select Product
                                        Category
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="edit_product_select_category" name="edit_product_select_category"
                                        class="form-select">
                                        @foreach ($category as $key => $category)
                                            @if ($category->id == $productObj->product_category_id)
                                                <option value="{{ $category->id }}" selected>
                                                    {{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="edit_product_select_model">Select Product
                                        Model
                                    </label>

                                    <div class="d-flex d-flex-row">
                                        <select id="edit_product_select_model" name="edit_product_select_model"
                                            class="form-select me-2">

                                            @foreach ($productModel as $model)
                                                @if ($model->id == $productObj['model_id'])
                                                    <option value="{{ $model->id }}" selected>
                                                        {{ $model->model_name }}</option>
                                                @else
                                                    <option value="{{ $model->id }}">
                                                        {{ $model->model_name }}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6" style="padding: 0px">

                    <div class="card border-0 shadow-sm rounded-0 h-100">

                        <div class="card-header d-flex align-items-center rounded-0"
                            style="border-bottom: 3px solid #4caf50; background-color: #c5e1a5">
                            <span class="flex-grow-1 font-weight-600">SPECIFICATION DETAILS</span>
                        </div>

                        <div class="card-body">

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="edit_product_des">Product
                                        Description</label>
                                    <textarea id="edit_product_des" name="edit_product_des" class="summernote"
                                        title="Contents">{{ $productObj['description'] }}</textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6" style="padding: 0px">

                    <div class="card border-0 shadow-sm rounded-0 h-100">

                        <div class="card-header d-flex align-items-center rounded-0"
                            style="border-bottom: 3px solid #4caf50; background-color: #c5e1a5">
                            <span class="flex-grow-1 font-weight-600">INVENTORY DETAILS</span>
                        </div>

                        <div class="card-body">

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="edit_product_select_mes">Select Product
                                        Measurement
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="edit_product_select_mes" name="edit_product_select_mes"
                                        class="form-select">
                                        @foreach ($measurement as $key => $measurement)
                                            @if ($productObj['measurement_id'] == $measurement->id)
                                                <option value="{{ $measurement->id }}" selected>
                                                    {{ $measurement->symbol }}</option>
                                            @else
                                                <option value="{{ $measurement->id }}">
                                                    {{ $measurement->symbol }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="edit_product_lsaq">Low Stock Alert
                                        Quantity
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="edit_product_lsaq" name="edit_product_lsaq" type="number"
                                        class="form-control" value="{{ $productObj['low_stock_alert_qty'] }}" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="edit_product_cost_price">
                                        Cost Price
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="edit_product_cost_price" name="edit_product_cost_price" type="number"
                                        class="form-control" value="{{ $productPrices->cost_price }}" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label small_font" for="edit_product_default_price">
                                        Selling Price
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="edit_product_default_price" name="edit_product_default_price" type="number"
                                        class="form-control" value="{{ $productObj['default_price'] }}" />
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6" style="padding: 0px">

                    <div class="card border-0 shadow-sm rounded-0 h-100">

                        <div class="card-header d-flex align-items-center rounded-0"
                            style="border-bottom: 3px solid #4caf50; background-color: #c5e1a5">
                            <span class="flex-grow-1 font-weight-600">MEDIA DETAILS</span>
                        </div>

                        <div class="card-body">

                            <div class="d-flex d-flex-row">
                                <div class="custom-file">
                                    <div class="text-center">

                                        @if (!empty($productObj['getProductImage'][0]))
                                            <img id="product_image1_upload_preview"
                                                src="{{ asset('assets_front_end/image/products/' . $productObj['getProductImage'][0]['getMedia']['name'] . '') }}"
                                                alt="" class="mb-2" style="width: 100px ; height: 100px">
                                            <label class="btn btn-sm btn-default w-75" for="product_image1_upload">Add
                                                Image</label>
                                            <input type="file" id="product_image1_upload" name="product_image1_upload">
                                        @else
                                            <img id="product_image1_upload_preview"
                                                src="{{ asset('assets_back_end/img/image_upload_icon.svg') }}" alt=""
                                                class="mb-2" style="width: 100px ; height: 100px">
                                            <label class="btn btn-sm btn-default w-75" for="product_image1_upload">Add
                                                Image</label>
                                            <input type="file" id="product_image1_upload" name="product_image1_upload">
                                        @endif

                                    </div>
                                </div>

                                <div class="custom-file">
                                    <div class="text-center">

                                        @if (!empty($productObj['getProductImage'][1]))
                                            <img id="product_image2_upload_preview"
                                                src="{{ asset('assets_front_end/image/products/' . $productObj['getProductImage'][1]['getMedia']['name'] . '') }}"
                                                alt="" class="mb-2" style="width: 100px ; height: 100px">
                                            <label class="btn btn-sm btn-default w-75" for="product_image2_upload">Add
                                                Image</label>
                                            <input type="file" id="product_image2_upload" name="product_image2_upload">
                                        @else
                                            <img id="product_image2_upload_preview"
                                                src="{{ asset('assets_back_end/img/image_upload_icon.svg') }}" alt=""
                                                class="mb-2" style="width: 100px ; height: 100px">
                                            <label class="btn btn-sm btn-default w-75" for="product_image2_upload">Add
                                                Image</label>
                                            <input type="file" id="product_image2_upload" name="product_image2_upload">
                                        @endif

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12 px-0">
                    <div class="card shadow-sm border-0 rounded-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3">
                                    <div class="d-flex d-flex-row justify-content-center">
                                        <div class="me-2 w-100">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fa fa-fw fa-upload"></i>
                                                Edit
                                            </button>
                                        </div>

                                        <div class="me-2 w-100">
                                            <button id="product_insert_form_reset" class="btn btn-default w-100">
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

    @include('back_end.layout.script')

@endsection
