<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $primaryKey="ava_id";

    public $timestamps= false;

    protected $fillable = ['Doctor_id','day', 'start_time', 'end_time'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'Doctor_id', 'Doctor_id');
    }

    
}
