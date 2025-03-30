<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type_id',
        'manufacturer_id',
        'name',
        'description',
        'price',
        'img1',
        'img2',
        'img3',
        'img4',
    ];


    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }


    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }
}
