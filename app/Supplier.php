<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class Supplier extends Model
{
    use HasApiTokens;

    protected $fillable=[
        'name',
    ];
    
    public function supplierproduct()
    {
        return $this->hasMany('App\SupplierProduct','supply_id','id');
    }
}
