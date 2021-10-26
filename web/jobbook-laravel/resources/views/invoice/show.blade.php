@extends('layouts.datatables-show-master')


@section('css')
<link rel="stylesheet" href={{ asset('bootstrap-5.1.1-dist/css/bootstrap.min.css') }}>
@stop


@section('jquery')

@stop

<?php include 'db_mapping.php'; ?>

@section('title')
    <h1>
        View >> Company # - {{ $invoice->$db_invoice_ref }}
    </h1>
@stop


@section('menu_action')
<div>
    <a href="{{ route('invoice.index') }}">Home</a>
</div>

<br>

<div>
<form method="POST" action="{{ route('invoice.destroy',$invoice) }}" accept-charset="UTF-8">
<input name="_method" type="hidden" value="DELETE">
<input name="_token" type="hidden" value="{{ csrf_token() }}">
<input class="btn btn-primary col-sm-1" type="submit" value="Remove">
</form>
</div>
@stop


@section('content')

<hr>

@foreach( $invoice->toArray() as $key=>$elem )
  {{ $key }} : {{ $elem }} <br>
@endforeach

<hr>

@foreach( $columns->pluck($db_column_fieldname) as $key=>$elem )
  {{ $columns->get($key)->$db_column_display }} : {{ $invoice->$elem }} <br>
@endforeach

<hr>

@if( !empty($invoice) )
    {{ $invoice->$db_invoice_ref }} <br>
    {{ $invoice->$db_invoice_name }} <br>
@endif

@stop


@section('script')
<script src="{{ asset('bootstrap-5.1.1-dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">

</script>
@stop