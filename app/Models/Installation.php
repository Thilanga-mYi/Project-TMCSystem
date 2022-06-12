<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'installation_type',
        'invoice_code',
        'annual_fee',
        'warranty_id',
        'payment_type_id',
        'installed_by_id',
        'hand_bill_number',
        'vehicle_plate_number',
        'vehicle_milage',
        'vehicle_modal',
        'engine_hours_h',
        'engine_hours_m',
        'sim_card_id',
        'product_id',
        'device_model_id',
        'remark',
        'admin_in_use',
        'admin_numbers',
        'job_referance',
        'status',
        'nic_front_img',
        'nic_back_img',
        'vehicle_img1',
        'vehicle_img2',
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

    public function getCustomer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function getSIM()
    {
        return $this->hasOne(stockHasProducts::class, 'id', 'sim_card_id')
            ->with('getProduct');
    }

    public function getDevice()
    {
        return $this->hasOne(stockHasProducts::class, 'id', 'product_id')
            ->with('getProduct');
    }

    public function getModel()
    {
        return $this->hasOne(ProductModel::class, 'id', 'device_model_id');
    }

    public function getWarranty()
    {
        return $this->hasOne(warranty::class, 'id', 'warranty_id');
    }

    public function getPaymentType()
    {
        return $this->hasOne(payment_methods::class, 'id', 'payment_type_id');
    }

    public function getInstalledEmp()
    {
        return $this->hasOne(Employee::class, 'id', 'installed_by_id');
    }

    public function getDeviceModel()
    {
        return $this->hasOne(ProductModel::class, 'id', 'device_model_id');
    }

    public function getallInstallations()
    {
        return $this::orderBy('created_at', 'DESC')
            ->with('getCustomer')
            ->with('getSIM')
            ->with('getDevice')
            ->with('getModel')
            ->with('getWarranty')
            ->with('getPaymentType')
            ->with('getInstalledEmp')
            ->get();
    }
}
