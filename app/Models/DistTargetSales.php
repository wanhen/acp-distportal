<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistTargetSales extends Model
{
    protected $table = "dist_target_sales";
    protected $fillable = ['dist_code','period','amount_target','amount_real','created_by','updated_by'];


   
}
