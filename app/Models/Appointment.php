<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable=[
        'Apt_id',
        'Doctor_id',
        'Pat_id',
        'Date',
        'Time_start',
        'Time_end',
        'description',
        'created_at',
        'updated_at'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient','Apt_id','Pat_id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor','Doctor_id','Doctor_id');
    }
}
