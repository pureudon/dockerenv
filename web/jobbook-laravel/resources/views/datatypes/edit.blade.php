@extends('layouts.formmaster')

@section('css')
<link rel="stylesheet" href={{ asset('bootstrap-5.1.1-dist/css/bootstrap.min.css') }}>
@stop

@section('jquery')

@stop


@section('title')
    <h1>
        @if( $action=='create' or $action=='duplicate' or $action=='extend' )
            Create >> Datatype # - New
        @else
            Edit >> Datatype # - {{ $datatype->id }}
        @endif
        
    </h1>
@stop


@section('menu_action')
    <div>
        <a href="{{ route('datatypes.index') }}">Home</a>
    </div>
    <br>
@stop


@section('content')

@if($action=='create' or $action=='duplicate')
<form method="POST" action="{{ route('datatypes.store') }}" accept-charset="UTF-8">
<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
@elseif($action=='edit')
<form method="POST" action="{{ route('datatypes.update',$datatype->id) }}" accept-charset="UTF-8">
<input name="_method" type="hidden" value="PATCH">
<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
@endif

<fieldset>
<legend>Basic:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">varchartype:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="varchartype" type="text" value="{{ $datatype->varchartype }}">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">inttype:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="inttype" type="text" pattern="[0-9]+" value="{{ $datatype->inttype }}">
        </div>
    </div>
</fieldset>

<fieldset>
<legend>Date:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">yeartype:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="yeartype" pattern="[0-9][0-9][0-9][0-9]" type="text" value="{{ $datatype->yeartype }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">datetype:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="datetype" type="text" pattern="(?:19|20)(?:(?:[13579][26]|[02468][048])-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))|(?:[0-9]{2}-(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:29|30))|(?:(?:0[13578]|1[02])-31)))" value="{{ $datatype->datetype }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">datetimetype:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control form-control-sm" autocomplete="off" size="20" name="datetimetype" type="text" pattern="[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9] [0-9][0-9]:[0-9][0-9]:[0-9][0-9]" value="{{ $datatype->datetimetype }}">
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
<script src="{{ asset('bootstrap-5.1.1-dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">

</script>
@stop