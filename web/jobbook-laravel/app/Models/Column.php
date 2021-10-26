<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Column extends Model
{


    protected $table = 'columns';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [

    ];

}
