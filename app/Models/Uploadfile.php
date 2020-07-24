<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uploadfile extends Model
{
    protected $table = "upload_file";
    // protected $connection = 'sqlsrv';
    // protected $primaryKey = "DoctorId"; //custom PK
    // public $incrementing = false; //disable id
    // public $timestamps = false; // disable updated_at and created_at

    protected $fillable = ['filename','report_type','report_date','period','dist_code','status'];

    public function distributors()
    {
        return $this->belongsTo('\App\Models\AcpDistributor','dist_code', 'dist_code');
    }
    
}
