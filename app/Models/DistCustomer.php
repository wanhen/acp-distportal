<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistCustomer extends Model
{
    protected $table = "dist_customer";    
    protected $fillable = ['cust_code','dist_code','cust_name','cust_type','address','city','postcode','longitude','latitude','created_by','updated_by'];

    public function stt()
    {
        return $this->hasMany('\App\Models\DistStt', 'cust_code', 'cust_code');
    }

    public function stok()
    {
        return $this->hasMany('\App\Models\DistStok', 'cust_code', 'cust_code');
    }

   
}
