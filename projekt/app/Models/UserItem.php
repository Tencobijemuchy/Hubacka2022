<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserItem extends Model
{
    use HasFactory;

    protected $table = 'user_items';

    protected $fillable = [
        'user_id',
        'product_id',
        'customizations',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
