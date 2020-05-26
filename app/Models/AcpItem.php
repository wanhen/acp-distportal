<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcpItem extends Model
{
    protected $table = "acp_item";
        
    public function uoms()
    {
        return $this->belongsTo('\App\Models\AcpUom','uom_code', 'uom_code');
    }

   
}
