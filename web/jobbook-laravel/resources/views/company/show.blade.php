@extends('layouts.datatables-show-master')


@section('css')
<link rel="stylesheet" href={{ asset('bootstrap-5.1.1-dist/css/bootstrap.min.css') }}>
@stop


@section('jquery')

@stop

<?php include 'db_mapping.php'; ?>

@section('title')
    <h1>
        View >> Company # - {{ $company->$db_company_ref }}
    </h1>
@stop


@section('menu_action')
<div>
    <a href="{{ route('company.index') }}">Home</a>
</div>

<br>

<div>
<form method="POST" action="{{ route('company.destroy',$company->$db_company_id) }}" accept-charset="UTF-8">
<input name="_method" type="hidden" value="DELETE">
<input name="_token" type="hidden" value="{{ csrf_token() }}">
<input class="btn btn-primary col-sm-1" type="submit" value="Remove">
</form>
</div>
@stop


@section('content')

<hr>

@foreach( $company->toArray() as $key=>$elem )
  {{ $key }} : {{ $elem }} <br>
@endforeach

<hr>

@foreach( $columns->pluck($db_column_fieldname) as $key=>$elem )
  {{ $columns->get($key)->$db_column_display }} : {{ $company->$elem }} <br>
@endforeach

<hr>

@if( !empty($company) )
    {{ $company->$db_company_ref }} <br>
    {{ $company->$db_company_name }} <br>
    {{ $company->$db_company_ename }} <br>
    {{ $company->$db_company_cname }} <br>
@endif

@stop


@section('script')
<script src="{{ asset('bootstrap-5.1.1-dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">

</script>
@stop