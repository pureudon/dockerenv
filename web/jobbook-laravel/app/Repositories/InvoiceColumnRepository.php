<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Models\InvoiceColumn;

class InvoiceColumnRepository
{

    protected $column;

    public function __construct(InvoiceColumn $column)
    {
        $this->column = $column;
    }


    public function create()
    {
        include 'db_mapping.php';
        return New Company;
    }

    public function find_by_id($id)
    {
        include 'db_mapping.php';
        $column = $this->column
            ->where($db_column_id, '=', $id)
            ->orderBy($db_column_id,'desc')
            ->first();
        return $column;
    }

    public function find_by_ref($ref)
    {
        include 'db_mapping.php';
        $column = $this->column
            ->where($db_column_ref, '=', $ref)
            ->orderBy($db_column_ref,'desc')
            ->first();
        return $column;
    }

    public function reorder_position()
    {
        include 'db_mapping.php';

        $columns = $this->column
            ->where($db_column_visibility, true)
            ->orderBy($db_column_position,'asc')
            ->get();

        foreach($columns as $key=>$column){
            $column->$db_column_position = $key ;
            $column->save();
        }

        return $columns;
    }



}
