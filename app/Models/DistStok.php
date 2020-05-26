<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistStok extends Model
{
    protected $table = "dist_stok";
    protected $fillable = ['period','dist_code','item_code','batch_no','expire_date','uom_code','qty1','unit1','qty2','unit2','qty','unit','created_by','updated_by'];

    // public function users()
    // {
    //     return $this->hasMany('\App\Models\User', 'cust_id', 'cust_id');
    // }

   
}
