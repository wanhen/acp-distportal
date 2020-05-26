<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistStt extends Model
{
    protected $table = "dist_stt";
    protected $fillable = ['period','dist_code','trans_date','trans_no','cust_code','sales_code','item_code','sku_code','batch_no','expire_date','qty1','unit1','qty2','unit2','qty','unit','uom_code','discount','amount','created_by','updated_by'];

    // public function users()
    // {
    //     return $this->hasMany('\App\Models\User', 'cust_id', 'cust_id');
    // }

   
}
