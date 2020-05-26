<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";

    protected $fillable = ['username','password','dist_code','userlevel','usergroup'];
    
    public function distributors()
    {
        return $this->belongsTo('\App\Models\AcpDistributor','dist_code','dist_code');
    }

    // public function employees()
    // {
    //     return $this->belongsTo('\App\Models\Employee','emp_id', 'emp_id');
    // }
}
