<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $data = [
            'name' => $request->brand_name
        ];

        return (new Brand)->add($data);
    }

    public function getALl()
    {
        return (new Brand)->getActiveAll();
    }

}
