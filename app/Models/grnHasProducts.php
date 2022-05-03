<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grnHasProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'grn_id', 
        'foreign_model_id', 
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

    public function getProduct()
    {
        return $this->hasOne(Products::class, 'id', 'product_id')->with('getMeasurement');
    }

    public function getMeasurement()
    {
        return $this->hasOne(Measurement::class, 'id', 'measurement_id');
    }

    public function getForeignModel()
    {
        return $this->hasOne(ProductModelForeign::class, 'id', 'foreign_model_id');
    }

    public function getVat()
    {
        return $this->hasOne(vat::class, 'id', 'vat_id');
    }
    
}
