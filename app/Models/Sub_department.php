<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_department extends Model
{
    use HasFactory;
    protected $fillable=[
        'sub_dept_id',
        'Name',
        'Description',
        'parent_id',
        'created_at',
        'updated_at'
    ];
}
