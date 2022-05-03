<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductModel extends Model
{
    use HasFactory;

    protected $fillable = ['model_name', 'product_type_id', 'brand_id', 'status'];

    public function getProductCount()
    {
        return $this::count();
    }

    public function add($data)
    {
        return $this->create($data);
    }

    public function edit($key, $term, $data)
    {
        return $this->where($key, $term)->update($data);
    }

    public function getAllModels()
    {
        return $this->orderBy('model_name', 'ASC')->get();
    }

    public function getAllActiveModels()
    {
        return $this->where('status', 1)
            ->orderBy('model_name', 'ASC')
            ->get();
    }

    public function getModelByBrands($brand_id)
    {
        return $this::where('brand_id', $brand_id)->get();
    }

    public function getModelByTypes($product_type_id)
    {
        return $this::where('product_type_id', $product_type_id)->get();
    }
}
