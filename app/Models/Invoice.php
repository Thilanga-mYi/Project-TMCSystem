<?php

namespace App\Models;

use App\Http\Controllers\StockHasProductsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_code', 'order_type_id', 'reference', 'administration_id', 'warehouse_id', 'total', 'discount', 'vat_id', 'net_total', 'remark', 'billing_to', 'billing_address', 'status'];

    public function getInvoiceCount()
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

    public function getProductQty($id)
    {
        return (new stockHasProducts)->getProductStocksForInvoice($id)->selectRaw("SUM(qty) as totqty")->first();
    }

    public function getAllInvoices()
    {
        return $this->get();
    }

    public function getAdministrationWiseInvoices($user_id)
    {
        return $this->where('administration_id',$user_id)->get();
    }

    public function getVat()
    {
        return $this->hasOne(vat::class, 'id', 'vat_id');
    }

    public function getwarehouse()
    {
        return $this->hasOne(warehouses::class, 'id', 'warehouse_id');
    }

    public function getproducts()
    {
        return $this->hasMany(InvoiceHasProducts::class,'invoice_id','id')->with('getshp');
    }

    public function viewInvoice($id)
    {
        return $this::where('id', $id)
            ->with('getVat')
            ->with('getwarehouse')
            ->with('getproducts')
            ->get();
    }

}
