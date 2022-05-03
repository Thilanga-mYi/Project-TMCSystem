<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grn extends Model
{
    use HasFactory;

    protected $fillable = [
        'grn_code',
        'user_id',
        'supplier_id',
        'grn_type_id',
        'warehouse_id',
        'po_ref',
        'logistic_name',
        'logistic_amount',
        'logistic_ref',
        'logistic_paid_date',
        'vat_id',
        'total',
        'vat_value',
        'net_grn_total',
        'net_grn_total_with_logistic_amount',
        'tot_paid',
        'tot_balance',
        'remark',
        'status',
    ];

    public function getGrnCount()
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

    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function getPurchases()
    {
        return $this->hasMany(grn_has_payment_methods::class, 'grn_id', 'id')->with('getPaymentMethod');
    }

    public function getAllGRN()
    {
        return $this
            ->with('getSupplier')
            ->with('getPurchases')
            ->get();
    }

    public function viewPurchase($id)
    {
        return $this::where('id', $id)
            ->with('getVat')
            ->with('getSupplier')
            ->with('getwarehouse')
            ->with('getGRNProducts')
            ->with('getGrnType')
            ->with('getPurchases')
            ->get();
    }

    public function getVat()
    {
        return $this->hasOne(vat::class, 'id', 'vat_id');
    }

    public function getGrnType()
    {
        return $this->hasOne(grnType::class, 'id', 'grn_type_id');
    }

    public function getwarehouse()
    {
        return $this->hasOne(warehouses::class, 'id', 'warehouse_id');
    }

    public function getGRNProducts()
    {
        return $this->hasMany(grnHasProducts::class, 'grn_id', 'id')
            ->with('getForeignModel')
            ->with('getProduct');
    }
}
