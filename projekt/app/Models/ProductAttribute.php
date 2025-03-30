<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type_id',
        'name',
        'data_type',
    ];

    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class, 'attribute_id');
    }
}
