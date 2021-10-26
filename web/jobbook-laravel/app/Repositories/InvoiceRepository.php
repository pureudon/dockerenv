<?php

namespace App\Repositories;

// Facades
use Illuminate\Support\Collection;
use Carbon\Carbon;

// Models
use App\Models\Invoice;



class InvoiceRepository
{

    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }


    public function create()
    {
        include 'db_mapping.php';
        return New Invoice;
    }

    public function find_by_id($id)
    {
        include 'db_mapping.php';
        $invoice = $this->invoice
            ->where($db_invoice_id, '=', $id)
            ->orderBy($db_invoice_id,'desc')
            ->first();
        return $invoice;
    }

    public function find_by_ref($ref)
    {
        include 'db_mapping.php';
        $invoice = $this->invoice
            ->where($db_invoice_ref, '=', $ref)
            ->orderBy($db_invoice_ref,'desc')
            ->first();
        return $invoice;
    }

    public function find_by_refs($targetlist)
    {
        include 'db_mapping.php';
        $invoices = $this->invoice
            ->whereIn($db_invoice_ref, $targetlist)
            ->orderBy($db_invoice_ref,'asc')
            ->get();
        return $invoices;
    }

    public function get_next_ref($ref_prefix='CR', $year_format='yy', $order_format='dddd')
    {
        include 'db_mapping.php';

        $thisyear2d = date("y");
        $thisyear1d = substr(date("y"),1,1);
        // $keywords = "CR".$thisyear2d."____";

        #cr_next_code
        
        $cr_order_number = "";    // "-1"
        $crkeywords = $ref_prefix."______";
        
        $latest_invoice = Invoice::where($db_invoice_ref, 'LIKE', $crkeywords)->orderBy($db_invoice_ref, 'desc')->take(1)->get()->first();

        if ($latest_invoice) {
            $cr_lastest_number = substr($latest_invoice->$db_invoice_ref, 3, 6); // CRxxxxxx >>xxxxxx
        }
        else {
            $cr_lastest_number = "000000"; // init for new year
        }

        $cr_next_number = str_pad(intval($cr_lastest_number) + 1,6,'0',STR_PAD_LEFT);
        $cr_next_code = $ref_prefix.$cr_next_number.$cr_order_number;

        return $cr_next_code;
    }

    public function selectoptions_category($defaultvalue='first')
    {
        $categorylist = collect();
        if($defaultvalue=='any'){
            $categorylist->put('any','');
        }
        elseif($defaultvalue=='emptystring'){
            $categorylist->put('','');
        }
        elseif($defaultvalue=='first'){
            // no operation
        }
        $categorylist->put('Vendor','Vendor');
        $categorylist->put('Supplier','Supplier');
        $categorylist->put('Client','Client');
        $categorylist->put('Government','Government');
        $categorylist->put('Organization','Organization');
        $categorylist->put('Bank','Bank');
        $categorylist->put('School','School');
        $categorylist->put('Personal','Personal');

        return $categorylist;
    }

    public function selectoptions_fontcolor($defaultvalue='first')
    {
        $fontcolorlist = collect();
        if($defaultvalue=='any'){
            $fontcolorlist->put('any','');
        }
        elseif($defaultvalue=='emptystring'){
            $fontcolorlist->put('','');
        }
        elseif($defaultvalue=='first'){
            // no operation
        }
        $fontcolorlist->put('Red','Red');
        $fontcolorlist->put('LimeGreen','LimeGreen');
        $fontcolorlist->put('SpringGreen','SpringGreen');
        $fontcolorlist->put('DodgerBlue','DodgerBlue');
        $fontcolorlist->put('DeepSkyBlue','DeepSkyBlue');
        $fontcolorlist->put('RoyalBlue','RoyalBlue');
        $fontcolorlist->put('SlateBlue','SlateBlue');
        $fontcolorlist->put('LightBlue','LightBlue');
        $fontcolorlist->put('Aqua','Aqua');
        $fontcolorlist->put('DarkViolet','DarkViolet');
        
        return $fontcolorlist;
    }


    # Group change - fontcolor

    public function groupchangefontcolor_core($invoices,$db_invoice_fontcolor,$newfontcolor)
    {
        // return 'hi group change fontcolor';

        include "db_mapping.php";

        if (count($invoices) > 0){
            $groupchangetimestamp = Carbon::now()->toDateTimeString();
            $newfontcolor = $newfontcolor;
            foreach($invoices as $invoice){
                $invoice->$db_invoice_updated_at = $groupchangetimestamp;
                $invoice->$db_invoice_fontcolor = $newfontcolor;

                $invoice->timestamps = false;
                $invoice->save();
            }
        }

        return $invoices;
    }
}
