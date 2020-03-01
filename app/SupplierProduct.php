<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class SupplierProduct extends Model
{
    use HasApiTokens;

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }
}
