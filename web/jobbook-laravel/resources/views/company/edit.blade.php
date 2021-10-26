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
            Create >> Company # - New
        @else
            Edit >> Company # - {{ $company->$db_company_ref }}
        @endif
        
    </h1>
@stop


@section('menu_action')
    <div>
        <a href="{{ route('company.index') }}">Home</a>

    </div>
    <br>
@stop


@section('content')

@if($action=='create' or $action=='duplicate' or $action=='extend')
<form method="POST" action="{{ route('company.store') }}" accept-charset="UTF-8">
<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
@elseif($action=='edit' or $action=='clear')
<form method="POST" action="{{ route('company.update',$company->$db_company_id) }}" accept-charset="UTF-8">
<input name="_method" type="hidden" value="PATCH">
<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
@endif

<fieldset>
<legend>基本資料:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">CR:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_ref }}" type="hidden" value="{{ $company->$db_company_ref }}">
            {{ $company->$db_company_ref }}
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_category)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <select id="{{ $db_company_category }}" name="{{ $db_company_category }}">
            @foreach( $category_selectlist as $category)
            <option value="{{ $category }}" {{ ($category === $company->$db_company_category) ? "selected" : "" }}>{{ $category }}</option>
            @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_name)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_name }}" type="text" required value="{{ $company->$db_company_name }}">
        </div>
    </div>
</fieldset>

<fieldset>
<legend>顯示方式:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_fontcolor)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <select id="{{ $db_company_fontcolor }}" name="{{ $db_company_fontcolor }}">
            @foreach( $fontcolor_selectlist as $fontcolor)
            <option value="{{ $fontcolor }}" {{ ($fontcolor === $company->$db_company_fontcolor) ? "selected" : "" }}>{{ $fontcolor }}</option>
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
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_printcode)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_printcode }}" type="text" value="{{ $company->$db_company_printcode }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_website)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_website }}" type="text" value="{{ $company->$db_company_website }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_br)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_br }}" type="text" value="{{ $company->$db_company_br }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_ci)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_ci }}" type="text" value="{{ $company->$db_company_ci }}">
        </div>
    </div>
</fieldset>

<fieldset>
<legend>名稱:</legend>
    @if( $columns->where($db_column_fieldname,$db_company_myobname)->first()->$db_column_editable === 1 )
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_myobname)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_myobname }}" type="text" value="{{ $company->$db_company_myobname }}">
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_ename)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_ename }}" type="text" value="{{ $company->$db_company_ename }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_cname)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_cname }}" type="text" value="{{ $company->$db_company_cname }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_shortname)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_shortname }}" type="text" value="{{ $company->$db_company_shortname }}">
        </div>
    </div>
</fieldset>

<fieldset>
<legend>地址:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_address)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_address }}" type="text" value="{{ $company->$db_company_address }}">
        </div>
    </div>

    @if( $columns->where($db_column_fieldname,$db_company_address2)->first()->$db_column_editable === 1 )
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_address2)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_address2 }}" type="text" value="{{ $company->$db_company_address2 }}">
        </div>
    </div>
    @endif
</fieldset>

<fieldset>
<legend>聯絡:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
        <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_contact)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_contact }}" type="text" value="{{ $company->$db_company_contact }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
        <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_contact_tel)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_contact_tel }}" type="text" value="{{ $company->$db_company_contact_tel }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_contact_tel2)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_contact_tel2 }}" type="text" value="{{ $company->$db_company_contact_tel2 }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
        <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_contact_fax)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_contact_fax }}" type="text" value="{{ $company->$db_company_contact_fax }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_contact_email)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="{{ $db_company_contact_email }}" type="text" value="{{ $company->$db_company_contact_email }}">
        </div>
    </div>
</fieldset>

<fieldset>
<legend>Remark:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">{{ $columns->where($db_column_fieldname,$db_company_remark)->first()->$db_column_display }}:</label>
        </div>
        <div class="form-group col-sm-6">
            <textarea class="form-control" rows="10" cols="50" name="{{ $db_company_remark }}">{{ $company->$db_company_remark }}</textarea>
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