<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallationHasFeatures extends Model
{
    use HasFactory;

    protected $fillable = [
        'installation_id',
        'feature_id',
        'amount',
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

    public function getFeature()
    {
        return $this->hasOne(ProductFeatures::class, 'id', 'feature_id');
    }
}
