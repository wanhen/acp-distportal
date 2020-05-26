<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistSttDetail extends Model
{
    protected $table = "dist_stt_detail";
    protected $fillable = ['header_id','item_code','sku_code','batch_no','expire_date','qty1','unit1','qty2','unit2','qty','unit','uom_code','discount','amount','created_by','updated_by'];

    public function headers()
    {
        return $this->belongTo('\App\Models\DistSttHeader', 'header_id', 'id');
    }

   
}
