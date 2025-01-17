<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','shop_id','price','quantity','image','description'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('quantity');
    }

    public function scopeSearchByName($query,$name)
    {
        return $query->where('name','like','%' . $name .'%');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_product');
    }
}
