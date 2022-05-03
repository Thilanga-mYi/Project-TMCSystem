<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Measurement;
use App\Models\Media;
use App\Models\ProductCategory;
use App\Models\ProductHasMedia;
use App\Models\ProductHasPrices;
use App\Models\ProductModel;
use App\Models\Products;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        $measurement = (new Measurement)->getActiveAll();
        $brand = (new Brand)->getActiveAll();
        $category = (new ProductCategory)->getActiveAll();
        $productType = (new ProductType)->getActiveAll();

        return view('/back_end/products', compact('measurement', 'brand', 'category', 'productType'));
    }

    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'new_product_select_product_type' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $product_type_id = $request->new_product_select_product_type;
        $product_name_1 = $request->new_product_name_lang1;
        $product_name_2 = $request->new_product_name_lang2;
        $cost_price = $request->new_product_cost_price;
        $default_price = $request->new_product_default_price;
        $product_des = $request->new_product_des;
        $product_select_category = $request->new_product_select_category;
        $product_select_mes = $request->new_product_select_mes;
        $product_lsaq = $request->new_product_lsaq;
        $product_select_brand = $request->new_product_select_brand;
        $product_select_model = $request->new_product_select_model;
        $product_select_product_type = $request->new_product_select_product_type;

        $filestorelocation = public_path('/' . env('PRODUCT_FILE_PATH'));

        $isSIM = false;
        $img1Has = false;
        $img2Has = false;

        if ($product_type_id == 2) {
            $isSIM = true;
        }

        if ($isSIM) {
            $validator = Validator::make($request->all(), [
                'new_product_select_product_type' => 'required|numeric|min:1',
                'new_product_select_model' => 'required|numeric|min:1',
                'new_product_name_lang1' => 'required',
                'new_product_default_price' => 'required|numeric|min:1',
                'new_product_cost_price' => 'required|numeric|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $productData = [
                'code' => $request->new_product_sku,
                'lang1_name' =>  $product_name_1,
                'lang2_name' =>  null,
                'default_price' =>  $default_price,
                'description' =>  $product_des,
                'low_stock_alert_qty' =>  0,
                'product_category_id' =>  1,
                'measurement_id' =>  $product_select_mes,
                'brand_id' =>  null,
                'model_id' =>  $product_select_model,
                'product_type_id' => $product_select_product_type,
                'status' => 1,
            ];

            $product = (new Products)->add($productData);
            $productPrice = (new ProductHasPrices)->add([
                'product_id' => $product->id,
                'price' => $default_price,
                'cost_price' => $cost_price,
                'status' => 1
            ]);

            return response()->json([
                'code' => null,
                'type' => 'success',
                'des' => 'Successfully Saved SIM',
                'refresh_status' => 2,
                'feild_reset_status' => 2,
            ]);
        } else {

            $validator = Validator::make($request->all(), [
                'new_product_select_product_type' => 'required|numeric|min:1',
                'new_product_select_model' => 'required|numeric|min:1',
                'new_product_name_lang1' => 'required',
                'new_product_default_price' => 'required|numeric|min:1',
                'new_product_cost_price' => 'required|numeric|min:1',
                'new_product_lsaq' => 'required|numeric|min:1',
                'new_product_select_category' => 'required',
                'new_product_select_mes' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $product_data = [
                'code' => $request->new_product_sku,
                'lang1_name' => $product_name_1,
                'lang2_name' => $product_name_2,
                'default_price' => $default_price,
                'description' => $product_des,
                'low_stock_alert_qty' => $product_lsaq,
                'product_category_id' => $product_select_category,
                'measurement_id' => $product_select_mes,
                'brand_id' => $product_select_brand,
                'model_id' => $product_select_model,
                'product_type_id' => $product_select_product_type,
                'status' => 1,
            ];

            $product = (new Products)->add($product_data);
            $productPrice = (new ProductHasPrices)->add([
                'product_id' => $product->id,
                'price' => $default_price,
                'cost_price' => $cost_price,
                'status' => 1
            ]);

            if ($request->hasFile('product_image1_upload')) {

                $validator = Validator::make($request->all(), [
                    'product_image1_upload' => 'required|mimes:jpeg,png,jpg|max:5000'
                ]);

                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()->all()]);
                }

                if ($request->file('product_image1_upload')->getSize() / 1024 > 750) {
                    return response()->json([
                        'code' => 1,
                        'type' => 'error',
                        'des' => 'File Size Should be less than 750kb',
                        'refresh_status' => 1,
                        'feild_reset_status' => 1,
                    ]);
                } else {
                    $product_image1_url = $request->file('product_image1_upload');
                    $filename = time() . $product_image1_url->getClientOriginalName();
                    $product_image1_url->move($filestorelocation, $filename);

                    $imageData = [
                        'name' => $filename,
                        'alt' => $product_image1_url->getClientOriginalName(),
                        'type' => $product_image1_url->getClientOriginalExtension(),
                    ];

                    $img1_data = (new Media)->add($imageData);
                    $img1Has = true;
                }
            }

            if ($request->hasFile('product_image2_upload')) {

                $validator = Validator::make($request->all(), [
                    'product_image2_upload' => 'required|mimes:jpeg,png,jpg|max:5000'
                ]);

                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()->all()]);
                }

                if ($request->file('product_image2_upload')->getSize() / 1024 > 750) {
                    return response()->json([
                        'code' => 1,
                        'type' => 'error',
                        'des' => 'File Size Should be less than 750kb',
                        'refresh_status' => 1,
                        'feild_reset_status' => 1,
                    ]);
                } else {
                    $product_image1_url = $request->file('product_image2_upload');
                    $filename = time() . $product_image1_url->getClientOriginalName();
                    $product_image1_url->move($filestorelocation, $filename);

                    $imageData = [
                        'name' => $filename,
                        'alt' => $product_image1_url->getClientOriginalName(),
                        'type' => $product_image1_url->getClientOriginalExtension(),
                    ];

                    $img2_data = (new Media)->add($imageData);
                    $img2Has = true;
                }
            }

            if ($img1Has) {
                (new ProductHasMedia)->add([
                    'product_id' => $product->id,
                    'media_id' => $img1_data->id,
                ]);
            }

            if ($img2Has) {
                (new ProductHasMedia)->add([
                    'product_id' => $product->id,
                    'media_id' => $img2_data->id,
                ]);
            }

            return response()->json([
                'code' => null,
                'type' => 'success',
                'des' => 'Successfully Saved Product',
                'refresh_status' => 2,
                'feild_reset_status' => 2,
            ]);
        }
    }

    public function getAllProducts()
    {
        return (new Products)->getAllProducts();
    }

    public function productList_backend()
    {
        $allproducts = $this->getAllProducts();
        return view('/back_end/product_list', compact('allproducts'));
    }

    public function changeStatus(Request $request)
    {

        (new Products)->edit('id', $request->id, ['status' => $request->status]);

        (($request->status == 1) ? $response_description = 'Product Enabled Successfully' : $response_description = 'Product Disabled Successfully');

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => $response_description,
            'refresh_status' => 2,
            'feild_reset_status' => 2,
        ]);
    }

    public function productSuggestions(Request $request)
    {
        $data = array();

        foreach ((new Products)->suggetions($request->all()) as $product) {
            $data[] = [
                'id' => $product->id,
                'name' => $product->lang1_name . ' ' . '(' . ProductModel::find($product->model_id)->model_name . ')',
            ];
        }

        return response()->json($data, 200);
    }

    public function productQuickView(Request $request)
    {
        $product = (new Products)->getProductById($request->id);
        Session::put('selected_product', $product);
        return $product;
    }

    public function productDescriptionEdit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'update_product_des' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $product_obj = Session::get('selected_product')->id;
        $update_data = ['description' => $request->update_product_des];
        (new Products)->edit('id', $product_obj, $update_data);
        Session::forget('selected_product');
        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => 'Successfully Update the Product Description',
            'refresh_status' => 2,
            'feild_reset_status' => 2,
        ]);
    }

    public function productDefaultPriceEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $update_data = ['default_price' => $request->price];
        (new Products)->edit('id', $request->id, $update_data);

        $previousPhpData = (new ProductHasPrices)->getProductHasPriceById($request->id);

        $productHasPrice = [
            'product_id' => $request->id,
            'price' => $request->price,
            'status' => 1,
        ];

        foreach ($previousPhpData as $key => $php) {
            (new ProductHasPrices)->edit('product_id', $php->product_id, ['status' => 2]);
        }

        (new ProductHasPrices)->add($productHasPrice);

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => 'Successfully Update the Product Default Price',
            'refresh_status' => 2,
            'feild_reset_status' => 2,
        ]);
    }

    public function updateCategoryForview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        Session::put('selected_product_id_for_edit_category', $request->id);
        $product = Products::find($request->id);
        return [(new ProductCategory)->getCategoryList(), $product->lang1_name, $product->product_category_id];
    }

    public function updateCategory(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if (Session::has('selected_product_id_for_edit_category')) {
            (new Products)->edit('id', Session::get('selected_product_id_for_edit_category'), ['product_category_id' => $request->category_id]);
            Session::forget('selected_product_id_for_edit_category');
            return response()->json([
                'code' => 1,
                'type' => 'success',
                'des' => 'Successfully Update the Product Category',
                'refresh_status' => 2,
                'feild_reset_status' => 2,
            ]);
        } else {
            return response()->json([
                'code' => 1,
                'type' => 'error',
                'des' => 'Unable to update',
                'refresh_status' => 2,
                'feild_reset_status' => 2,
            ]);
        }
    }

    public function getProductPrice(Request $request)
    {
        return (new Products)->getProductById($request->id)->default_price;
    }

    public function advanceEditView(Request $request)
    {
        $product_id = $request->product_id;
        $productObj = (new Products)->getProductById($product_id);

        $measurement = (new Measurement)->getActiveAll();
        $brand = (new Brand)->getActiveAll();
        $category = (new ProductCategory)->getActiveAll();
        $productType = (new ProductType)->getActiveAll();
        $productModel = (new ProductModel)->getModelByTypes($productObj->product_category_id);
        $productPrices = (new ProductHasPrices)->getProductHasActivePriceById($product_id);

        return view('/back_end/products_edit', compact('measurement', 'brand', 'category', 'productType', 'productObj', 'productModel', 'productPrices'));
    }

    public function advanceEditSave(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'edit_product_id' => 'required|numeric|min:0',
            'edit_product_select_product_type' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $edit_product_id = $request->edit_product_id;
        $product_type_id = $request->edit_product_select_product_type;
        $product_name_1 = $request->edit_product_name_lang1;
        $product_name_2 = $request->edit_product_name_lang2;
        $cost_price = $request->edit_product_cost_price;
        $default_price = $request->edit_product_default_price;
        $product_des = $request->edit_product_des;
        $product_select_category = $request->edit_product_select_category;
        $product_select_mes = $request->edit_product_select_mes;
        $product_lsaq = $request->edit_product_lsaq;
        $product_select_brand = $request->edit_product_select_brand;
        $product_select_model = $request->edit_product_select_model;
        $product_select_product_type = $request->edit_product_select_product_type;

        $filestorelocation = public_path('/' . env('PRODUCT_FILE_PATH'));

        $isSIM = false;

        if ($product_type_id == 2) {
            $isSIM = true;
        }

        if ($isSIM) {
            $validator = Validator::make($request->all(), [
                'edit_product_id' => 'required|numeric|min:1',
                'edit_product_select_product_type' => 'required|numeric|min:1',
                'edit_product_select_model' => 'required|numeric|min:1',
                'edit_product_name_lang1' => 'required',
                'edit_product_default_price' => 'required|numeric|min:1',
                'edit_product_cost_price' => 'required|numeric|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $product_data = [
                'code' => $request->edit_product_sku,
                'lang1_name' =>  $product_name_1,
                'lang2_name' =>  null,
                'default_price' =>  $default_price,
                'description' =>  $product_des,
                'low_stock_alert_qty' =>  0,
                'product_category_id' =>  1,
                'measurement_id' =>  $product_select_mes,
                'brand_id' =>  null,
                'model_id' =>  $product_select_model,
                'product_type_id' => $product_select_product_type,
                'status' => 1,
            ];

            // SIM SAVE
            (new Products)->edit('id', $edit_product_id, $product_data);
            $productHasPricesArray = (new ProductHasPrices)->getProductHasPriceById($edit_product_id);

            foreach ($productHasPricesArray as $key => $item) {
                (new ProductHasPrices)->edit('id', $item->id, ['status' => 2]);
            }

            (new ProductHasPrices)->add([
                'product_id' => $edit_product_id,
                'price' => $default_price,
                'cost_price' => $cost_price,
                'status' => 1
            ]);
        } else {

            $validator = Validator::make($request->all(), [
                'edit_product_select_product_type' => 'required|numeric|min:1',
                'edit_product_select_model' => 'required|numeric|min:1',
                'edit_product_name_lang1' => 'required',
                'edit_product_default_price' => 'required|numeric|min:1',
                'edit_product_cost_price' => 'required|numeric|min:1',
                'edit_product_lsaq' => 'required|numeric|min:1',
                'edit_product_select_category' => 'required',
                'edit_product_select_mes' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $product_data = [
                'code' => $request->new_product_sku,
                'lang1_name' => $product_name_1,
                'lang2_name' => $product_name_2,
                'default_price' => $default_price,
                'description' => $product_des,
                'low_stock_alert_qty' => $product_lsaq,
                'product_category_id' => $product_select_category,
                'measurement_id' => $product_select_mes,
                'brand_id' => $product_select_brand,
                'model_id' => $product_select_model,
                'product_type_id' => $product_select_product_type,
                'status' => 1,
            ];

            // PRODUCT SAVE
            (new Products)->edit('id', $edit_product_id, $product_data);
            $productHasPricesArray = (new ProductHasPrices)->getProductHasPriceById($edit_product_id);

            foreach ($productHasPricesArray as $key => $item) {
                (new ProductHasPrices)->edit('id', $item->id, ['status' => 2]);
            }

            (new ProductHasPrices)->add([
                'product_id' => $edit_product_id,
                'price' => $default_price,
                'cost_price' => $cost_price,
                'status' => 1
            ]);
        }

        $img1_edited = 0;
        $img2_edited = 0;
        $filestorelocation = public_path('/' . env('PRODUCT_FILE_PATH'));

        // IMAGE 01 UPLOAD
        if ($request->hasFile('product_image1_upload')) {

            $product_image1_url = $request->file('product_image1_upload');
            $filename = time() . $product_image1_url->getClientOriginalName();
            $product_image1_url->move($filestorelocation, $filename);

            $data1 = [
                'name' => $filename,
                'alt' => $product_image1_url->getClientOriginalName(),
                'type' => $product_image1_url->getClientOriginalExtension(),
            ];

            $img1_data = (new Media)->add($data1);
            $img1_edited = 1;
        }

        // IMAGE 02 UPLOAD
        if ($request->hasFile('product_image2_upload')) {
            $product_image2_url = $request->file('product_image2_upload');
            $filename = time() . $product_image2_url->getClientOriginalName();
            $product_image2_url->move($filestorelocation, $filename);

            $data2 = [
                'name' => $filename,
                'alt' => $product_image2_url->getClientOriginalName(),
                'type' => $product_image2_url->getClientOriginalExtension(),
            ];

            $img2_data = (new Media)->add($data2);
            $img2_edited = 1;
        }

        if ($img1_edited == 1 || $img2_edited == 1) {
            $productHasMediaObjArray = (new ProductHasMedia)->getRecordsByProductId($edit_product_id);

            if ($img1_edited) {
                if (count($productHasMediaObjArray) == 0) {
                    (new ProductHasMedia)->add([
                        'product_id' => $edit_product_id,
                        'media_id' => $img1_data->id,
                    ]);
                } else {
                    (new ProductHasMedia)->edit('id', $productHasMediaObjArray[0]->id, ['media_id' => $img1_data->id]);
                }
            }

            if ($img2_edited) {
                if (count($productHasMediaObjArray) >= 2) {
                    (new ProductHasMedia)->edit('id', $productHasMediaObjArray[1]->id, ['media_id' => $img2_data->id]);
                } else {
                    (new ProductHasMedia)->add([
                        'product_id' => $edit_product_id,
                        'media_id' => $img2_data->id,
                    ]);
                }
            }
        }

        return response()->json([
            'code' => '1',
            'type' => 'success',
            'des' => 'Successfully Edited Product',
            'refresh_status' => 2,
            'feild_reset_status' => 2,
        ]);
    }
}
