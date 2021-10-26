<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class InvoiceColumn extends Model
{


    protected $table = 'invoicecolumns';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [

    ];

}
