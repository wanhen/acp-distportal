<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcpPeriod extends Model
{
    protected $table = "acp_period";

    protected $fillable = ['period', 'is_active'];
    
   
}
