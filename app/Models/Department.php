<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable=[
        'dept_id',
        'Name',
        'Description',
        'created_at',
        'updated_at'
    ];

    // public function doctors()
    // {
    //     return $this->hasMany(Doctor::class,'dept_id','dept_id');
    // }

    public function doctors()
{
    return $this->hasMany(Doctor::class, 'dept_id','dept_id');
}

}
