@extends('layouts.datatables-edit-master')


@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('jquery')
<script type="text/javascript" charset="utf-8" src="{{ asset('/jquery.js') }}"></script>
@stop

@section('css')
<link rel="stylesheet" href={{ asset('bootstrap-5.1.1-dist/css/bootstrap.min.css') }}>
@stop

@section('js')

    <script type="text/javascript">
    
    // prevent multiple submissions
    $(document).on('submit', 'form', function() {
        useranswer = confirm("Do you really want to submit the form?");
        if (useranswer==true){
            groupstringvalue = document.querySelector('#groupstring').value;
            newstatusvalue = document.querySelector('#newstatus').value;

            $("#submitbutton").attr("disabled", 'disabled');
            $("#submitbutton").val("Waiting")
            return true;
        }
        return useranswer;
    });

    </script>
@stop

<?php include 'db_mapping.php'; ?>


@section('menu_action')
<form id="groupchangeform" action="{{route('company.groupchangefontcolor')}}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

@stop

@section('content')
<h1 align="center" class="big_title">{{ empty($pagetitle) ? "Empty Title" : $pagetitle }}</h1>
<div style="padding:0px 0px 15px 0px ;text-align: center;margin: auto;">


</div>

<div>
<a href="{{ route('company.index') }}">主頁</a>
</div>

<div>

</div>

<h2>按編號 群組更新</h2>
<div class="sumtable">

<fieldset>
<legend>篩選:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">編號:</label>
        </div>
        <div class="form-group col-sm-6">
            <input class="form-control" id="groupstring" autocomplete="off" size="120" required="" name="groupstring" type="text" value="{{ $groupstring }}">
            <br>
            (多張 以空格分隔)
            <br>
        </div>
    </div>
</fieldset>


<fieldset>
<legend>更新內容:</legend>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            <label for="title" class="form-label">FontColor:</label>
        </div>
        <div class="form-group col-sm-6">
            <select id="{{ $db_company_fontcolor }}" name="{{ $db_company_fontcolor }}">
            @foreach( $fontcolor_selectlist as $fontcolor)
            <option value="{{ $fontcolor }}" >{{ $fontcolor }}</option>
            @endforeach
            </select>
            <br>
        </div>
    </div>
</fieldset>

<div class="row">
    <div class="form-group col-sm-6">
    <input class="btn btn-primary col-sm-3" type="submit" value="Update">
    </div>
</div>

</div>
@stop

</form>
            

@push('scripts')
<script src="{{ asset('bootstrap-5.1.1-dist/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">

</script>
@endpush