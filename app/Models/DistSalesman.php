<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistSalesman extends Model
{
    protected $table = "dist_salesman";
    protected $fillable = ['sales_code','dist_code','sales_name','created_by','updated_by'];
    
    public function stt()
    {
        return $this->hasMany('\App\Models\DistStt', 'sales_code', 'sales_code');
    }

    public function stok()
    {
        return $this->hasMany('\App\Models\DistStok', 'sales_code', 'sales_code');
    }
}
