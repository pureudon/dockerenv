@extends('layouts.showmaster')


@section('css')

@stop


@section('jquery')

@stop



@section('title')
    <h1>
        View >> Datatype # - {{ $datatype->id }}
    </h1>
@stop


@section('menu_action')
<div>
    <a href="{{ route('datatypes.index') }}">Home</a>
</div>

<br>

<div>
<form method="POST" action="{{ route('datatypes.destroy',$datatype->id) }}" accept-charset="UTF-8">
<input name="_method" type="hidden" value="DELETE">
<input name="_token" type="hidden" value="{{ csrf_token() }}">
<input class="btn btn-primary col-sm-3" type="submit" value="Remove">
</form>

</div>
@stop


@section('content')

<hr>

@foreach( $datatype->toArray() as $key=>$elem )
    {{ $key }} : {{ $elem }} <br>
@endforeach

<hr>


@if( !empty($datatype) )
    {{ $datatype->varchartype }} <br>
    {{ $datatype->inttype }} <br>
    {{ $datatype->datetype }} <br>
    {{ $datatype->datetimetype }} <br>
@endif

@stop


@section('script')
<script type="text/javascript">

</script>
@stop