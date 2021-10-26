<style>


.itemtable{
    /* border:1px solid black; */
    width:100%;
    padding:4px 4px 4px 4px;
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
.cell_border_bottom {
    border-bottom: 1px solid black;
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
.lineheight{
    line-height: 180%;
}
.font_bold{
    font-weight: bold;
}
.font_large{
    font-size:16px;
}
.whitefontblackbg{
    color: white;
    background-color: black;
}
.totalamountrow{
    color: black;
    background-color: LightGray;
}
</style>





<table class="itemtable">
<thead >
<tr class="lineheight">
<th class="itemtable_cell_1 cell_border_bottom text_center whitefontblackbg font_bold">{!! $column1 !!}</th>
<th class="itemtable_cell_2 cell_border_bottom text_left whitefontblackbg font_bold">{!! $column2 !!}</th>
<th class="itemtable_cell_3 cell_border_bottom text_center whitefontblackbg font_bold">{!! $column3 !!}</th>
<th class="itemtable_cell_4 cell_border_bottom text_center whitefontblackbg font_bold">{!! $column4 !!}</th>
<th class="itemtable_cell_5 cell_border_bottom text_center whitefontblackbg font_bold">{!! $column5 !!}</th>
</tr>
</thead>
<tbody>
@for($i=1;$i<=17;$i++)
<tr>
<td class="itemtable_cell_1 text_center"></td>
<td class="itemtable_cell_2 text_center"></td>
<td class="itemtable_cell_3 text_center"></td>
<td class="itemtable_cell_4 text_center"></td>
<td class="itemtable_cell_5 text_center"></td>
</tr>
@endfor
</tbody>
<tfoot>
<tr>
<td colspan="4" class="text_right ">SubTotal</td>
<td class=" text_center"></td>
</tr>
<tr>
<td colspan="4" class="text_right ">Discount</td>
<td class=" text_center"></td>
</tr>
<tr>
<td colspan="4" class="text_right totalamountrow font_bold">{{ $label_totalamount }}</td>
<td class="totalamountrow text_center"></td>
</tr>
</tfoot>
</table>



