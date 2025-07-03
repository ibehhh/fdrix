<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
protected $fillable = ['order_id', 'phone_number'];
public function products()
{
    return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
}
}