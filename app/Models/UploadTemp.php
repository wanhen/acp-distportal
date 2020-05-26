<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempUpload extends Model
{
    protected $table = "upload_temp";
    // protected $connection = 'sqlsrv';
    // protected $table = "Doctor";
    // protected $primaryKey = "DoctorId"; //custom PK
    // public $incrementing = false; //disable id
    // public $timestamps = false; // disable updated_at and created_at

    protected $fillable = ['date_report','item_code','subbrand','item_name','unit'];
    
}
