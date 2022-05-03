<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatures extends Model
{
    use HasFactory;

    public function getAllActiveFEatures()
    {
        return $this->where('status',1)->get();
    }

}
