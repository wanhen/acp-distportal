<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadStt extends Model
{
    protected $table = "upload_stt";
    // protected $connection = 'sqlsrv';    
    // protected $primaryKey = "CustomId"; //custom PK
    // public $incrementing = false; //disable id
    // public $timestamps = false; // disable updated_at and created_at

    protected $fillable = ['dist_code','report_date','period','tanggal','no_faktur','code_salesman','nama_salesman','code_customer','nama_customer','alamat','kota','channel','type_outlet','brand','code_item','nama_item','code_item_acp','harga','qty1','unit1','qty2','unit2','qty','unit','diskon','revenue'];
    
}
