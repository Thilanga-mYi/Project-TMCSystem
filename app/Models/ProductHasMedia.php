<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHasMedia extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'media_id', 'status'];

    public function add($data)
    {
        return $this->create($data);
    }

    public function edit($key, $term, $data)
    {
        return $this->where($key, $term)->update($data);
    }

    public function getMedia()
    {
        return $this->hasOne(Media::class, 'id', 'media_id');
    }

    public function getRecordsByProductId($id)
    {
        return $this->where('product_id', $id)->get();
    }
}
