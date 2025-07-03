<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $fillable = ['name', 'image', 'price', 'alt'];
public function orders()
{
    return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
}
}