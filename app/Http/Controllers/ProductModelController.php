<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ProductModel;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductModelController extends Controller
{
    public function index()
    {
        $brand = (new Brand)->getActiveAll();
        $productTypes = (new ProductType)->getActiveAll();
        return view('/back_end/product_model', compact('brand', 'productTypes'));
    }

    public function save(Request $request)
    {
        $model_name = $request->model_name;
        $product_type_id = $request->product_type_id;
        $brand_id = $request->brand_id;

        $validator = Validator::make($request->all(), [
            'model_name' => 'required',
            'product_type_id' => 'required|numeric|min:0',
            'brand_id' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $model_data = [
            'model_name' => $model_name,
            'product_type_id' => $product_type_id,
            'brand_id' => $brand_id,
            'status' => 1,
        ];

        $modelObj = (new ProductModel)->add($model_data);
        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => 'Successfully Insert a product model',
            'refresh_status' => 2,
            'feild_reset_status' => 2,
        ]);
    }

    public function modelList()
    {
        $tableData = [];
        $records = (new ProductModel)->getAllModels();

        foreach ($records as $key => $value) {

            $tableData[] = [
                ++$key,
                $value['model_name'],
                ProductType::find($value['product_type_id'])->product_type,
                Brand::find($value['brand_id'])->name,
                '-'
            ];
        }
        return $tableData;
    }

    public function getModelByBrandId(Request $request)
    {
        return (new ProductModel)->getModelByBrands($request->brand_id);
    }

    public function getModelByProductId(Request $request)
    {
        return (new ProductModel)->getModelByTypes($request->product_type_id);
    }
}
