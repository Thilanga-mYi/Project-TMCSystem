<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModelForeign extends Model
{
    use HasFactory;

    protected $fillable = ['foreign_model_name, status'];

    public function getActiveAll()
    {
        return $this->orderBy('id', 'ASC')
            ->where('status', 1)
            ->get();
    }
}
