<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    public $table = 'subjects';

    protected $fillable =[
        'sub_name',
        'sub_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
