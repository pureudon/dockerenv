<style>

    .Quotation_table {

        margin:0px;
        padding:2px;
        width:100%;
        border:1px solid #000000;

    }

    .Quotation_table table{

        border-spacing: 2;
        width:100%;
        margin:0px;padding:0px;
    }

    .Quotation_table td{
        vertical-align:middle;

    /*     border:0px solid #000000; */
    /*     border-width:0px 0px 0px 0px; */
        text-align:left;
    /*     padding:5px; */
        font-size:10px;
        font-family:Arial;
        font-weight:normal;

    }

    .Quotation_table2 {
        margin:0px;
        padding:1px 2px 1px 3px;
        width:100%;
        border:1px solid #000000;
    }

    #table_work_description {
        border: 1px solid black;
    }

</style>

<table class="Quotation_table">

    <tr>
        <td style="text-align:left; width:80px">{{ $label_client }}</td>
        <td style="text-align:left; width:400px; border-left: 1px solid black;font-size:120%;">
            {{ $client_ename }} {{ $client_cname }}
        </td>
        <td style="text-align:center; width:100px; border-left: 1px solid black;">
            {{ $label_date }}
        </td>
        <td style="text-align:center; width:90px; border-left: 1px solid black;">
            {{ $docdate }}
        </td>
    </tr>

    <tr>
        <td style="text-align:left; width:80px; border-top: 1px solid black;">{{ $label_addr }}</td>
        <td style="text-align:left; width:400px; border-left: 1px solid black; border-top: 1px solid black; border-top: 1px soli black;">
            {{ $client_address }}
        </td>
        <td style="text-align:center; width:100px; border-left: 1px solid black; border-top: 1px solid black;">
            {{ $label_ref }}
        </td>
        <td style="text-align:center; width:90px; border-left: 1px solid black; border-top: 1px solid black;">
            {{ $docref }}
        </td>
    </tr>
</table>
&nbsp;<br/>
<table class="Quotation_table">
    <tr>
        <td colspan="2" style="text-align:left; width:120">{{ $label_billcontact }}</td>
        <td style="text-align:center; width:160; border-left: 1px solid black;">
            {{ $client_contact_name }}
        </td>
        <td style="text-align:center; width:45; border-left: 1px solid black;">
            {{ $label_client_fax }}
        </td>
        <td style="text-align:center; width:195; border-left: 1px solid black;">
            {{ $client_contact_fax }}
        </td>
        <td style="text-align:center; width:40; border-left: 1px solid black;">
            {{ $label_client_tel }}
        </td>
        <td style="text-align:center; width:110; border-left: 1px solid black;">
            @if ( !empty($client_contact_tel) and !empty($client_contact_mobile) )
                {{$client_contact_tel}} <br>  {{$client_contact_mobile}}
            @elseif ( !empty($client_contact_tel) and empty($client_contact_mobile) )
                {{$client_contact_tel}}
            @elseif ( empty($client_contact_tel) and !empty($client_contact_mobile) )
                {{$client_contact_mobile}}
            @endif
        </td>
    </tr>

    <tr>
        <td colspan="2" style="text-align:left; width:120; border-top: 1px solid black;">{{ $label_deliverycontact }}</td>
        <td style="text-align:center; width:160; border-left: 1px solid black; border-top: 1px solid black;">
            {{ $site_contact_name }}
        </td>
        <td style="text-align:center; width:45; border-left: 1px solid black; border-top: 1px solid black;">
            {{ $label_client_email }}
        </td>
        <td style="text-align:center; width:195; border-left: 1px solid black; border-top: 1px solid black;">
            {{$client_contact_email}} 
            {!! ($site_contact_email != null) ? '<br>'.$site_contact_email:'' !!}
        </td>
        <td style="text-align:center; width:40; border-left: 1px solid black; border-top: 1px solid black;">
            {{ $label_site_tel }}
        </td>
        <td style="text-align:center; width:110; border-left: 1px solid black; border-top: 1px solid black;">
            @if ( !empty($site_contact_tel) and !empty($site_contact_mobile) )
                {{$site_contact_tel}} <br> {{$site_contact_mobile}}
            @elseif ( !empty($site_contact_tel) and empty($site_contact_mobile) )
                {{$site_contact_tel}}
            @elseif ( empty($site_contact_tel) and !empty($site_contact_mobile) )
                {{$site_contact_mobile}}
            @endif
        </td>
    </tr>

</table>
