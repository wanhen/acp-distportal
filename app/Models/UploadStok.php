<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokUpload extends Model
{
    protected $table = "upload_stok";
    // protected $primaryKey = "DoctorId"; //custom PK
    // public $incrementing = false; //disable id
    // public $timestamps = false; // disable updated_at and created_at

    protected $fillable = ['dist_code','report_date','period','item_code','item_name','subbrand','unit','stok_ob','stok_in','stok_out','stok_bad','stok_below','stok_above'];
    
}
