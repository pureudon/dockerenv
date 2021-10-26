@extends('layouts.homemaster')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('css')
<link rel="stylesheet" href={{ asset('bootstrap-5.1.1-dist/css/bootstrap.min.css') }}>
<style>

</style>
@stop



@section('customjs')

@stop



@section('menu_action')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<br>
@stop



@section('content')

<a href="{{ route('datatypes.create') }}">Create</a>
<br>

<table class="table">
<thead>
<tr>
<th scope="col">id</th>
<th scope="col">varchartype</th>
<th scope="col">inttype</th>
<th scope="col">yeartype</th>
<th scope="col">datetype</th>
<th scope="col">datetimetype</th>
<th scope="col">action</th>
</tr>
</thead>
<tbody>
@foreach( $datatypes as $key=>$datatype )
<tr>
<th scope="row">{{ $datatype->id }}</th>
<td>{{ $datatype->varchartype }}</td>
<td>{{ $datatype->inttype }}</td>
<td>{{ $datatype->yeartype }}</td>
<td>{{ $datatype->datetype }}</td>
<td>{{ $datatype->datetimetype }}</td>
<td>
<a href="{{ route('datatypes.show', ['id'=> $datatype->id]) }}">View</a>
<a href="{{ route('datatypes.edit', ['id'=> $datatype->id]) }}">Edit</a>
</td>
</tr>
@endforeach
</tbody>
</table>
@stop



@push('scripts')
<script src="{{ asset('bootstrap-5.1.1-dist/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">

</script>

<script type="text/javascript">

</script>
@endpush