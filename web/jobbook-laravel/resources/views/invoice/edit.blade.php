@extends('layouts.datatables-edit-master')

@section('css')
<link rel="stylesheet" href={{ asset('bootstrap-5.1.1-dist/css/bootstrap.min.css') }}>
@stop

@section('jquery')
<script type="text/javascript" charset="utf-8" src="{{ url('/') }}/jquery.js"></script> 
@stop


<?php include 'db_mapping.php'; ?>

@section('title')
    <h1>
        @if( $action=='create' or $action=='duplicate' or $action=='extend' )
            Create >> Invoice # - New
        @else
            Edit >> Invoice # - {{ $invoice->$db_invoice_ref }}
        @endif
        
    </h1>
@stop


@section('menu_action')
    <div>
        <a href="{{ route('invoice.index') }}">Home</a>

    </div>
    <br>
@stop


@section('content')

@if($action=='create' or $action=='duplicate' or $action=='extend')
<form method="POST" action="{{ route('invoice.store') }}" accept-charset="UTF-8">
<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
@elseif($action=='edit' or $action=='clear')
<form method="POST" action="{{ route('invoice.update',$invoice) }}" accept-charset="UTF-8">
<input name="_method" type="hidden" value="PATCH">
<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
@endif

<fieldset>
<legend>基本資料:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_ref)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_ref }}" type="hidden" value="{{ $invoice->$db_invoice_ref }}">
            {{ $invoice->$db_invoice_ref }}
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_category)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <select id="{{ $db_invoice_category }}" name="{{ $db_invoice_category }}">
            @foreach( $category_selectlist as $category)
            <option value="{{ $category }}" {{ ($category === $invoice->$db_invoice_category) ? "selected" : "" }}>{{ $category }}</option>
            @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_type)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_type }}" type="text" required value="{{ $invoice->$db_invoice_type }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_name)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_name }}" type="text" required value="{{ $invoice->$db_invoice_name }}">
        </div>
    </div>
</fieldset>

<fieldset>
<legend>顯示方式:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_fontcolor)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <select id="{{ $db_invoice_fontcolor }}" name="{{ $db_invoice_fontcolor }}">
            @foreach( $fontcolor_selectlist as $fontcolor)
            <option value="{{ $fontcolor }}" {{ ($fontcolor === $invoice->$db_invoice_fontcolor) ? "selected" : "" }}>{{ $fontcolor }}</option>
            @endforeach
            </select>
        </div>
    </div>
</fieldset>

<fieldset>
<legend>公司資料:</legend>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_companyname1)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_companyname1 }}" type="text" required value="{{ $invoice->$db_invoice_companyname1 }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_companyname2)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_companyname2 }}" type="text" required value="{{ $invoice->$db_invoice_companyname2 }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_clientname)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_clientname }}" type="text" required value="{{ $invoice->$db_invoice_clientname }}">
        </div>
    </div>




</fieldset>

<fieldset>
<legend>地址:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_addr1)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_addr1 }}" type="text" required value="{{ $invoice->$db_invoice_addr1 }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_addr2)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_addr2 }}" type="text" required value="{{ $invoice->$db_invoice_addr2 }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_addr3)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_addr3 }}" type="text" required value="{{ $invoice->$db_invoice_addr3 }}">
        </div>
    </div>
</fieldset>

<fieldset>
<legend>聯絡:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_attn)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_attn }}" type="text" required value="{{ $invoice->$db_invoice_attn }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_tel)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_tel }}" type="text" required value="{{ $invoice->$db_invoice_tel }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_fax)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_fax }}" type="text" required value="{{ $invoice->$db_invoice_fax }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_email)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_email }}" type="text" required value="{{ $invoice->$db_invoice_email }}">
        </div>
    </div>

</fieldset>

<fieldset>
<legend>Remark:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_invoice_totalamount)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_invoice_totalamount }}" type="text" required value="{{ $invoice->$db_invoice_totalamount }}">
        </div>
    </div>
</fieldset>

<div class="row">
    <div class="form-group col-sm-6">
    <input class="btn btn-primary col-sm-3" type="submit" value="Confirm">
    </div>
</div>


</form>
@stop


@section('script')
<script type="text/javascript">
    // prevent multiple submissions
    $(document).on('submit', 'form', function() {
        $(this).find('button:submit, input:submit').attr('disabled', 'disabled');
    });
</script>

<script src="{{ asset('bootstrap-5.1.1-dist/js/bootstrap.min.js') }}"></script>
@stop