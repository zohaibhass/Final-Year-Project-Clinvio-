<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'Doctor_id', // Add 'Doctor_id' to the fillable array
        'Name',
        'Phone',
        'Email',
        'password',
        'Gender',
        'Age',
        'city',
        'state',
        'country',
        'adress',
        'Profile_picture',
        'dept_id',
        'tags',
        'Description'
    ];

    // public function department()
    // {
    //     return $this->belongsTo(Department::class, 'dept_id', 'dept_id');
    // }

public function department()
{
    return $this->belongsTo(Department::class, 'dept_id', 'dept_id');
}


    public function certifications()
    {
        return $this->hasMany(Certification::class, 'Doctor_id', 'Doctor_id');
    }

    public function availability()
    {
        return $this->hasMany(Availability::class, 'Doctor_id', 'Doctor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'Doctor_id', 'Doctor_id');
    }

}
