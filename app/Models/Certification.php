<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

   protected $fillable=[
    'certi_id',
    'doctor_id',
    'name',
    'organization',
    'completion_date',
    'certi_description',
    "file_id"
   ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'Doctor_id');
    }
}
