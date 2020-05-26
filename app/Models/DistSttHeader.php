<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistSttHeader extends Model
{
    protected $table = "dist_stt_header";
    protected $fillable = ['period','dist_code','trans_date','trans_no','cust_code','sales_code','created_by','updated_by'];

    public function details()
    {
        return $this->hasMany('\App\Models\DistSttDetail', 'id', 'header_id');
    }

   
}
