<style>

.table_outer{
    /* border:1px solid black; */
    width:100%;
    padding:10px 0px 10px 0px;
}
.table_inner{
    /* border:1px solid black; */
    width:100%;
    padding:4px 0px 0px 20px;
    font-size:12px;
}
.table_cell_1{ width:52%; }
.table_cell_2{ width:22%; }
.table_cell_3{ width:26%; }

</style>


<table class="table_outer">
<tr>
<td>
<table class="table_inner" >

<tr>
<td class="table_cell_1">{{ $companyname }}</td>
<td class="table_cell_2">Ref No.:</td>
<td class="table_cell_3">{{ $docref }}</td>
</tr>

<tr>
<td class="table_cell_1">{{ $companycname }}</td>
<td class="table_cell_2">Date:</td>
<td class="table_cell_3">{{ $docdate }}</td>
</tr>

<tr>
<td class="table_cell_1"></td>
<td class="table_cell_2">Our Quotation No.:</td>
<td class="table_cell_3">{{ $quotno }}</td>
</tr>

<tr>
<td class="table_cell_1">{{ $companyaddr }}</td>
<td class="table_cell_2">Your PO No.:</td>
<td class="table_cell_3">{{ $po }}</td>
</tr>

<tr>
<td class="table_cell_1"></td>
<td class="table_cell_2">Salesperson:</td>
<td class="table_cell_3">{{ $salesperson }}</td>
</tr>

<tr>
<td class="table_cell_1">ATTN: {!! $attn !!}</td>
<td class="table_cell_2"></td>
<td class="table_cell_3"></td>
</tr>

<tr>
<td class="table_cell_1">TEL: &nbsp;  &nbsp; {{ $tel }} &nbsp;&nbsp;&nbsp; FAX: &nbsp; {{ $fax }}</td>
<td class="table_cell_2"></td>
<td class="table_cell_3"></td>
</tr>

</table>
</td>
</tr>
</table>