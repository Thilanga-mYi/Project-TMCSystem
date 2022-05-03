<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'img_url', 'status'];

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

    public function getActiveAll()
    {
        return $this::where('status', 1)->get();
    }
}
