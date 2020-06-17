<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadStd extends Model
{
    protected $table = "upload_std";
    // protected $connection = 'sqlsrv';
    // protected $table = "Doctor";
    // protected $primaryKey = "DoctorId"; //custom PK
    // public $incrementing = false; //disable id
    // public $timestamps = false; // disable updated_at and created_at

    protected $fillable = ['period',
                'week',
                'date',
                'item_code',
                'cust_id',
                'trans_type',
                'qty',
                'unit',
                'item_name_old',
                'cust_name',
                'cust_category',
                'brand',
                'subbrand',
                'salesperson',
                'item_name',
                'amount',
                'amount_gross',
                'discount',
                'address',
                'cust_type',
                'document_number',
                'kota',
                'provinsi',
                'nama_toko_pusat',
                'nama_pasar',
                'cust_category_sub',
                'regional',
                'area'];
    
}
