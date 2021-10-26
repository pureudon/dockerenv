@extends('layouts.datatables-home-master')


@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop



@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/nav/home.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/nav/nav.css') }}" />


<!-- <link rel="stylesheet" href={{ asset('bootstrap-5.1.1-dist/css/bootstrap.min.css') }}> -->
<link rel="stylesheet" type="text/css" href="{{ asset('datatables/DataTables-1.11.3/css/jquery.dataTables.pureudon.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('datatables/media/css/jquery.dataTables.pureudon.css') }}"> -->

@if($datatables_colreorder===true)
<link rel="stylesheet" type="text/css" href="{{ asset('datatables/extension/ColReorder-1.5.4/css/colReorder.dataTables.min.css') }}">
@endif

@if($datatables_checkboxselect===true)
<link rel="stylesheet" type="text/css" href="{{ asset('datatables/extension/Select-1.3.3/css/select.dataTables.css') }}">
<link type="text/css" href="{{ asset('datatables/extension/jquery-datatables-checkboxes-1.2.9/css/dataTables.checkboxes.css') }}" rel="stylesheet" />
@endif

@if($datatables_colvisbutton===true)
<link type="text/css" href="{{ asset('datatables/extension/Buttons-2.0.1/css/buttons.dataTables.css') }}" rel="stylesheet" />
@endif

<link type="text/css" href="{{ asset('css/jobbook-fontcolor.css') }}" rel="stylesheet" />
<link type="text/css" href="{{ asset('css/jobbook-div.css') }}" rel="stylesheet" />
<style>

</style>

@stop



@section('customjs')
<script type="text/javascript" charset="utf-8" src="./jquery.js"></script>
<script type="text/javascript" language="javascript" src="./datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"></script>

@if($datatables_colreorder===true)
<script type="text/javascript" language="javascript" src="./datatables/extension/ColReorder-1.5.4/js/dataTables.colReorder.min.js"></script>
@endif

@if($datatables_checkboxselect===true)
<script type="text/javascript" language="javascript" src="./datatables/extension/Select-1.3.3/js/dataTables.select.js"></script>
<script type="text/javascript" src="./datatables/extension/jquery-datatables-checkboxes-1.2.9/js/dataTables.checkboxes.min.js"></script>
@endif

@if($datatables_colvisbutton===true)
    <script type="text/javascript" src="./datatables/extension/Buttons-2.0.1/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="./datatables/extension/Buttons-1.5.1/js/buttons.colVis.js"></script>
@endif

@stop

<?php include 'db_mapping.php'; ?>


@section('nav')

@stop


@section('menu_action')

<div>
    <a href="{{ route('company.create') }}" class="editor">New</a>
</div>

<br>
@stop

@section('content')
<!-- <div class="container"> -->


@if($datatables_checkboxselect===true)
<form id="checkboxselect" action="{{route('company.groupchangeform')}}" method="GET">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div>
<span><button name='groupchange' id='groupchange'>GroupChange</button></span>
</div>
@endif

<div class="div-text-align-center">
@if($datatables_inputsearch===true)
Name
<input type='text' name='name' id='name' size="20" autocomplete="off" value="">
@endif
</div>

<div class="div-text-align-center">
@if($datatables_selectsearch===true)

Category
<select id="category" name="category">
@foreach( $category_selectlist as $key => $category)
<option value="{{ $category }}" >{{ $key }}</option>
@endforeach
</select>

FontColor
<select id="fontcolor" name="fontcolor">
@foreach( $fontcolor_selectlist as $key => $fontcolor)
<option value="{{ $fontcolor }}" >{{ $key }}</option>
@endforeach
</select>
@endif
</div>

@if($datatables_clearfilter===true)
<div class="div-text-align-center">
<button id='clearfilter' name='clearfilter' onclick="return false;">Clear Filters</button>
</div>
@endif

    <table class="display table table-bordered" id="company-table" style="width:100%">
        <thead>
            <tr>
                @if($datatables_checkboxselect===true)
                <th>id</th>
                @endif

                @foreach( $columns as $column)
                <th>{{ $column->$db_column_display }}</th>
                @endforeach
            </tr>
        </thead>

    <tbody>
    </tbody>

@if($datatables_columnsearch===true)
        <tfoot>
            <tr>
                @if($datatables_checkboxselect===true)
                <th>id</th>
                @endif

                @foreach( $columns as $column)
                <th>{{ $column->$db_column_display }}</th>
                @endforeach
            </tr>
        </tfoot>
@endif

    </table>

<!-- </div> -->

@if($datatables_checkboxselect===true)
</form>
@endif

@stop


@push('scripts')
<script src="{{ asset('bootstrap-5.1.1-dist/js/bootstrap.min.js') }}"></script>

    <script>

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

@if($datatables_columnsearch===true)
            $('#company-table tfoot th').each( function () {
                var title = $('#company-table thead th').eq( $(this).index() ).text();

                @if($datatables_checkboxselect===true)
                    if ( $(this).index()==0 ) {
                        $(this).html( '' );
                    }
                    else{
                        $(this).html( '<input type="search" aria-controls="example" size="8"/>' );
                    }
                @else
                    $(this).html( '<input type="search" aria-controls="example" size="8"/>' );
                @endif

            } );
@endif
            var oTable = $('#company-table').DataTable( {
                processing: true,

                serverSide: true,

                ajax: {
                    "url": '{{ $ajaxsource }}',
                    "type": "POST"
                },

                columns: [
                    @if($datatables_checkboxselect===true)
                    { data: '{{ $db_company_id }}', name: '{{ $db_company_id }}', searchable: false, orderable: false },
                    @endif 

                    @foreach( $columns as $column)
                    { data: '{{ $column->$db_column_fieldname }}', name: '{{ $column->$db_column_fieldname }}'{{ ($column->$db_column_searchable===0) ? ', searchable: false' : '' }}{{ ($column->$db_column_orderable===0) ? ', orderable: false' : '' }} },
                    @endforeach
                ],
@if($datatables_colreorder===true)
                colReorder: true,
@endif
                bAutoWidth: true,

                oLanguage: {
                    sSearch: "Search all columns:"
                },

                order: [[ 1, "desc" ]],

                sPaginationType: "full_numbers",
                "sDom": '<"top"Bilp>rt<"clear"lp>',        // search results on top
@if($datatables_colvisbutton===true)
                buttons: [ 
                    {
                        extend: 'colvisGroup',
                        text: 'Show All',
                        show: ':hidden',
                        hide: []
                    },

                    {
                        extend: 'colvisGroup',
                        text: 'HD-1280',
                        show: [
@foreach( $columns as $column)
@if( $column->$db_column_view1visibility === 1 )
@if($datatables_checkboxselect==true)
{{ $column->$db_column_position +1 }},
@else
{{ $column->$db_column_position }},
@endif
@endif
@endforeach
                        ],
                        hide: [
@foreach( $columns as $column)
@if( $column->$db_column_view1visibility === 0 )
@if($datatables_checkboxselect==true)
{{ $column->$db_column_position +1 }},
@else
{{ $column->$db_column_position }},
@endif
@endif
@endforeach
                        ]
                    },

                    {
                        extend: 'colvisGroup',
                        text: 'HD-1920',
                        show: [
@foreach( $columns as $column)
@if( $column->$db_column_view2visibility === 1 )
@if($datatables_checkboxselect==true)
{{ $column->$db_column_position +1 }},
@else
{{ $column->$db_column_position }},
@endif
@endif
@endforeach
                        ],
                        hide: [
                            @foreach( $columns as $column)
@if( $column->$db_column_view2visibility === 0 )
@if($datatables_checkboxselect==true)
{{ $column->$db_column_position +1 }},
@else
{{ $column->$db_column_position }},
@endif
@endif
@endforeach
// {{ $column->where($db_column_view2visibility,0)->pluck($db_column_position)->implode(',') }},
                        ]
                    },

                    {
                        extend: 'colvis',
                        text: 'Custom',
                        collectionLayout: 'fixed two-column',
                        postfixButtons: [ 'colvisRestore' ],
                        columnText: function ( dt, idx, title ) {
                        return (idx+1)+': '+title;
                        }
                    },
                ],
@endif

@if($datatables_checkboxselect===true)
                        // select: true,
                        columnDefs: [ {
                            orderable: false,
                            // className: 'select-checkbox',
                            'checkboxes': {
                                'selectRow': true
                            },
                            targets:   0
                        } ],
                        select: {
                            style:    'multi',
                            selector: 'td:first-child'
                        },
@endif

                oLanguage: {
                    "sLengthMenu": "_MENU_"
                },

                lengthMenu: [
                    [5, 10, 15, 20, 25, 30, 35, 45, 50, 100, 200, 500, 1000, -1],
                    ["5 最快速", 10, 15, 20, 25, 30, 35, 45, 50, "100 不建議使用", "200 不建議使用", "500 不建議使用", "1000 不建議使用", "All 不建議使用"]
                ],

                stateSave: true,

                stateDuration: 60 * 60 * 24 * 30,

                initComplete: function ()
                {
                    var r = $('#company-table tfoot tr');
                    r.find('th').each(function(){
                        $(this).css('padding', 8);
                    });
                    $('#company-table thead').append(r);
                    $('#search_0').css('text-align', 'center');
                },

                language: {
                    "decimal": ".",
                    "thousands": ","
                },

                searchDelay: 1350,

                iDisplayLength : 10
            });

@if($datatables_columnsearch===true)
            //Method 1 ( official )
            // Apply the search
            oTable.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    that
                        .search( this.value )
                        .draw();
                } );
                $( 'input', this.footer() ).on( 'change', function () {
                    that
                        .search( this.value )
                        .draw();
                } );
                $( 'input', this.footer() ).on( 'search', function () {
                    that
                        .search( this.value )
                        .draw();
                } );

            } );

            // Restore state ( text input )
            var state = oTable.state.loaded();
            if ( state ) {
                oTable.columns().eq( 0 ).each( function ( colIdx ) {
                    var colSearch = state.columns[colIdx].search;
                    if ( colSearch.search ) {
                        $( 'input', oTable.column( colIdx ).footer() ).val( colSearch.search );
                    }
                } );
                oTable.draw();
            }
@endif

@if($datatables_checkboxselect===true)
            // Handle form submission event
            $('#checkboxselect').on('submit', function(e){
                var form = this;
                var rows_selected = oTable.column(0).checkboxes.selected();

                // Iterate over all selected checkboxes
                $.each(rows_selected, function(index, rowId){
                    // Create a hidden element 
                    $(form).append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'id[]')
                            .val(rowId)
                    );
                });
               
            }); 

            oTable.columns().checkboxes.deselectAll()
@endif

@if($datatables_inputsearch===true)
            // name 
            var state = oTable.state.loaded();
            @if($datatables_checkboxselect==true)
            var colnameposition = {{ $columns->where($db_column_fieldname,$db_company_name)->first()->$db_column_position + 1 }};
            @else
            var colnameposition = {{ $columns->where($db_column_fieldname,$db_company_name)->first()->$db_column_position }};
            @endif

            if ( state ) {
                var colSearch = state.columns[ colnameposition ].search;
                if ( colSearch.search ) {
                    $('#name').val( colSearch.search);
                }
            oTable.draw();
            }

            $('#name').on( 'keyup click', function () {
                @if($datatables_columnsearch==true)
                $( 'input', oTable.column( colnameposition ).footer() ).val( $('#name').val() );
                @endif
                $('#company-table').DataTable().column( colnameposition ).search(
                $('#name').val().trim().replaceAll(" ", "|"),true,false,true).draw();
            } );
@endif

@if($datatables_selectsearch===true)
            // category 
            var state = oTable.state.loaded();
            @if($datatables_checkboxselect==true)
            var columncategoryposition = {{ $columns->where($db_column_fieldname,$db_company_category)->first()->$db_column_position + 1 }};
            @else
            var columncategoryposition = {{ $columns->where($db_column_fieldname,$db_company_category)->first()->$db_column_position }};
            @endif

            if ( state ) {
                var colSearch = state.columns[ columncategoryposition ].search;
                if ( colSearch.search ) {
                    $('#category').val( colSearch.search);
                }
            }
            oTable.draw();

            $('#category').on( 'change', function () {
                @if($datatables_columnsearch==true)
                $( 'input', oTable.column( columncategoryposition ).footer() ).val( $('#category').val() );
                @endif
                if ( $('#category').val()=='any' ) {
                    $('#company-table').DataTable().column( columncategoryposition ).search('',true,false,true).draw();
                }
                else{
                    $('#company-table').DataTable().column( columncategoryposition ).search($('#category').val().trim().replaceAll(" ", "|"),true,false,true).draw();
                }
            } );


            // fontcolor 
            var state = oTable.state.loaded();
            @if($datatables_checkboxselect==true)
            var columnfontcolorposition = {{ $columns->where($db_column_fieldname,$db_company_fontcolor)->first()->$db_column_position + 1 }};
            @else
            var columnfontcolorposition = {{ $columns->where($db_column_fieldname,$db_company_fontcolor)->first()->$db_column_position }};
            @endif

            if ( state ) {
                var colSearch = state.columns[ columnfontcolorposition ].search;
                if ( colSearch.search ) {
                    $('#fontcolor').val( colSearch.search);
                }
            }
            oTable.draw();

            $('#fontcolor').on( 'change', function () {
                @if($datatables_columnsearch==true)
                $( 'input', oTable.column( columnfontcolorposition ).footer() ).val( $('#fontcolor').val() );
                @endif
                if ( $('#fontcolor').val()=='any' ) {
                    $('#company-table').DataTable().column( columnfontcolorposition ).search('',true,false,true).draw();
                }
                else{
                    $('#company-table').DataTable().column( columnfontcolorposition ).search($('#fontcolor').val().trim().replaceAll(" ", "|"),true,false,true).draw();
                }
            } );
@endif


@if($datatables_clearfilter===true)
            $('#clearfilter').on( 'click', function () {

                // clear all columns filter
                $('#company-table').DataTable().columns('').search('');
                // oTable.draw();

                // name (reset to deafult value)
                $('#name').val('');
                @if($datatables_checkboxselect==true)
                var colnameposition = {{ $columns->where($db_column_fieldname,$db_company_name)->first()->$db_column_position + 1 }};
                @else
                var colnameposition = {{ $columns->where($db_column_fieldname,$db_company_name)->first()->$db_column_position }};
                @endif
                $('#company-table').DataTable().column( colnameposition ).search($('#name').val(),true,false,true);

                // category (reset to deafult value)
                $('#category').val('');
                @if($datatables_checkboxselect==true)
                var colnameposition = {{ $columns->where($db_column_fieldname,$db_company_category)->first()->$db_column_position + 1 }};
                @else
                var colnameposition = {{ $columns->where($db_column_fieldname,$db_company_category)->first()->$db_column_position }};
                @endif
                $('#company-table').DataTable().column( colnameposition ).search($('#category').val(),true,false,true);

                // fontcolor (reset to deafult value)
                $('#fontcolor').val('');
                @if($datatables_checkboxselect==true)
                var columnfontcolorposition = {{ $columns->where($db_column_fieldname,$db_company_fontcolor)->first()->$db_column_position + 1 }};
                @else
                var columnfontcolorposition = {{ $columns->where($db_column_fieldname,$db_company_fontcolor)->first()->$db_column_position }};
                @endif
                $('#company-table').DataTable().column( columnfontcolorposition ).search('',true,false,true);


                oTable.state.save(); // save state

                oTable.draw();
            } );
@endif


        });


    </script>


    <script type="text/javascript">

    </script>

@endpush