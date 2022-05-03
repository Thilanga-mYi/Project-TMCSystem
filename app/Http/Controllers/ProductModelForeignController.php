<?php

namespace App\Http\Controllers;

use App\Models\ProductModelForeign;
use Illuminate\Http\Request;

class ProductModelForeignController extends Controller
{
    public function getForeignModelList()
    {
        return (new ProductModelForeign)->getActiveAll();
    }
}
