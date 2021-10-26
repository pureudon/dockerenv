<style>

.itemtable{
    /* border:1px solid black; */
    width:100%;
    padding:6px 4px 4px 6px;
    /* padding:4px 4px 4px 4px; */
    font-size:12px;

}
.cell_border { 
    border: 1px solid black;
}
.cell_border_left {
    border-left: 1px solid black;
}
.cell_border_top {
    border-top: 1px solid black;
}
.text_center {
    text-align:center; 
    vertical-align:middle;
}
.text_left {
    text-align:left; 
    vertical-align:middle;
}
.text_right {
    text-align:right; 
    vertical-align:middle;
}

.itemtable_cell_1{ width:5%; }
.itemtable_cell_2{ width:60%; }
.itemtable_cell_3{ width:5%; }
.itemtable_cell_4{ width:15%; }
.itemtable_cell_5{ width:15%; }

</style>





<table class="itemtable">

@if($items)
    @foreach($items as $item)
        <tr>
        <td class="itemtable_cell_1 text_center">{{ $item->activity }}</td>
        <td class="itemtable_cell_2 text_left">{!! $item->description !!}</td>
        <td class="itemtable_cell_3 text_center">{{ $item->qty }}</td>
        <td class="itemtable_cell_4 text_right">{{ $item->unitprice }}</td>
        <td class="itemtable_cell_5 text_right">{{ $item->subtotal }}</td>

        <!-- <td class="itemtable_cell_5 cell_border_left text_center">{{ $item->period }}</td> -->
        <!-- <td class="itemtable_cell_6 cell_border_left text_right">{{ $item->subtotal }}</td> -->
        </tr>
    @endforeach
@endif

</table>









