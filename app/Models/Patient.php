<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable=[
        'Pat_id',
        'Name',
        'Phone',
        'Age',
        "cnic",
        'Gender',
        'created_at',
        'updated_at'
    ];

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment','Pat_id','Pat_id');
    }

    
    
}
