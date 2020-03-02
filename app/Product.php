<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class Product extends Model
{
    use HasApiTokens;
    protected $fillable=[
        'name',
        'description',
        'quantity',
    ];

    public function orderdetail()
    {
        return $this->hasMany('App\OrderDetail','product_id','id');
    }

    public function supplierproduct()
    {
        return $this->hasMany('App\SupplierProduct','product_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
