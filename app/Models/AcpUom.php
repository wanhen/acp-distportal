<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcpUom extends Model
{
    protected $table = "acp_uom";
    public $timestamps = false; // disable updated_at and created_at

    
    public function items()
    {
        return $this->hasMany('\App\Models\AcpItem','uom_code', 'uom_code');
    }
}

