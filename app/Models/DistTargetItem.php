<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistTargetItem extends Model
{
    protected $table = "dist_target_item";
    protected $fillable = ['dist_code','period','item_code','amount_target','amount_real','created_by','updated_by'];

       
}
