<style>

.table_style {
    /* margin:100px; no use for TCPDF */
    /* padding:2px 2px 2px 2px; top bottom right is working in TCPDF  */
    /* width:100%; */
    border:1px solid #000000;
    padding:10px 2px 10px 10px;
}




.itemtable{
    border:1px solid black;
    width:100%;
    /* padding:4px 1px 4px 1px; */
    padding:4px 4px 4px 4px;
    font-size:12px;
    font-family:Arial;
    font-weight:normal;
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
/* .itemtable_cell_1{ width:12.5%; }
.itemtable_cell_2{ width:55%; }
.itemtable_cell_3{ width:7.5%; }
.itemtable_cell_4{ width:12.5%; }
.itemtable_cell_5{ width:12.5%; } */

.itemtable_cell_1{ width:5%; }
.itemtable_cell_2{ width:75%; }
.itemtable_cell_3{ width:20%; }
/* .itemtable_cell_4{ width:12.5%; } */
/* .itemtable_cell_5{ width:10%; } */
/* .itemtable_cell_6{ width:12.5%; } */
.textbold{
    font-weight:bold;
}
.largefont{
    font-size:16px;
}
</style>





<table class="itemtable">

<tr>
<td class="itemtable_cell_1 cell_border_bottom text_center textbold">{!! $column1 !!}</td>
<td class="itemtable_cell_2 cell_border_bottom text_left textbold">{!! $column2 !!}</td>
<td class="itemtable_cell_3 cell_border_bottom text_center textbold">{!! $column3 !!}</td>
</tr>

@for($i=1;$i<=19;$i++)
<tr>
<td class="itemtable_cell_1 text_center"></td>
<td class="itemtable_cell_2 text_center"></td>
<td class="itemtable_cell_3 text_center"></td>
</tr>
@endfor

<tr>
<td colspan="2" class="text_right textbold largefont">{{ $label_totalamount }}</td>
<td class="text_center"></td>
</tr>

</table>



