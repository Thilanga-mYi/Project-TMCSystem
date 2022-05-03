<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockHasProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'stock_id',
        'product_id',
        'imei',
        'unit_price',
        'status'
    ];

    public function add($data)
    {
        return $this->create($data);
    }

    public function edit($key, $term, $data)
    {
        return $this->where($key, $term)->update($data);
    }

    public function getStock()
    {
        return $this->hasOne(stock::class, 'id', 'stock_id')
            ->with('getWarehouse');
    }

    public function getProduct()
    {
        return $this->hasOne(Products::class, 'id', 'product_id')
            ->with('getProductModel')
            ->with('getMeasurement');
    }

    public function getAllStock()
    {
        return $this->with('getStock')
            ->with('getProduct')
            ->get();
    }

    public function getProductStocksForInvoice($product_id)
    {
        $binIds = [];
        return $this->where('product_id', $product_id)->where('status', 1);
    }

    public function getSimilarImei($imei)
    {
        return $this->where('imei', $imei)->first();
    }

    public function getProductSuggetions($input)
    {
        return $this::where([
            ['status', '=', 1],
            ["imei", "LIKE", "%{$input['query']}%"],
        ])->get();
    }
}
