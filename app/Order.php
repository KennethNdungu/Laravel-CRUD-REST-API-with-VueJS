<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class Order extends Model
{
    use HasApiTokens;

    protected $fillable=[
        'order_number',
        
    ];

    public function orderdetail()
    {
        return $this->hasMany('App\OrderDetail','order_id','id');
    }
}
