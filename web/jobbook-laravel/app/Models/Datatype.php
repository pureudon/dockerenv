<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datatype extends Model
{
    use HasFactory;

    protected $table = 'datatypes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [

    ];
}
