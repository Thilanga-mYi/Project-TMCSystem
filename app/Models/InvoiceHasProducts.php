<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHasProducts extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'unit_price', 'qty', 'total', 'discount', 'vat_id', 'vat_value', 'net_total', 'shp_id', 'chp_id', 'status'];

    public function add($data)
    {
        return $this->create($data);
    }

    public function edit($key, $term, $data)
    {
        return $this->where($key, $term)->update($data);
    }

    public function getshp()
    {
        return $this->hasOne(stockHasProducts::class,'id','id')->with('getproduct');
    }

}
