<?php

namespace App\Transformers;

use Carbon\Carbon;
use DateTime;
use League\Fractal\TransformerAbstract;

use App\Models\Invoice;

class InvoiceTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Invoice $invoice)
    {
        include 'db_mapping.php';

        $now_timestamp_code = Carbon::now()->format('YmdHis');

        // action
        $view_html = '<a href="'.route('invoice.show', ['invoice' => $invoice]).'" >View' . '</a>';
        $edit_html = '<a href="'.route('invoice.edit', ['invoice' => $invoice]).'" >Edit' . '</a>';
        $duplicate_html = '<a href="'.route('invoice.duplicate', ['invoice' => $invoice]).'" >Duplicate' . '</a>';
        $pdf_html = '<a href="'.route('invoice.pdf', ['invoice' => $invoice]).'?timestamp='.$now_timestamp_code.'" >PDF' . '</a>';
        $pdf2_html = '<a href="'.route('invoice.pdf2', ['invoice' => $invoice]).'?timestamp='.$now_timestamp_code.'" >PDF2' . '</a>';
        $pdf3_html = '<a href="'.route('invoice.pdf3', ['invoice' => $invoice]).'?timestamp='.$now_timestamp_code.'" >PDF3' . '</a>';
        $pdf4_html = '<a href="'.route('invoice.pdf4', ['invoice' => $invoice]).'?timestamp='.$now_timestamp_code.'" >PDF4' . '</a>';
        $action_html = $view_html;
        $action_html .= ' '.$edit_html;
        $action_html .= ' '.$duplicate_html;
        $action_html .= ' '.$pdf_html;
        $action_html .= ' '.$pdf2_html;
        $action_html .= ' '.$pdf3_html;
        $action_html .= ' '.$pdf4_html;
        // $action_html = '';

        // invoice name
        if ($invoice->$db_invoice_fontcolor=='Red'){
            $name_css = 'RedColor';
        }
        elseif ($invoice->$db_invoice_fontcolor=='LimeGreen'){
            $name_css = 'LimeGreenColor';
        }
        elseif ($invoice->$db_invoice_fontcolor=='SpringGreen'){
            $name_css = 'SpringGreenColor';
        }
        elseif ($invoice->$db_invoice_fontcolor=='DodgerBlue'){
            $name_css = 'DodgerBlueColor';
        }
        elseif ($invoice->$db_invoice_fontcolor=='DeepSkyBlue'){
            $name_css = 'DeepSkyBlueColor';
        }
        elseif ($invoice->$db_invoice_fontcolor=='RoyalBlue'){
            $name_css = 'RoyalBlueColor';
        }
        elseif ($invoice->$db_invoice_fontcolor=='SlateBlue'){
            $name_css = 'SlateBlueColor';
        }
        elseif ($invoice->$db_invoice_fontcolor=='LightBlue'){
            $name_css = 'LightBlueColor';
        }
        elseif ($invoice->$db_invoice_fontcolor=='Aqua'){
            $name_css = 'AquaColor';
        }
        elseif ($invoice->$db_invoice_fontcolor=='DarkViolet'){
            $name_css = 'DarkVioletColor';
        }
        else{
            $name_css = '';
        }
        $ref_html = '<span class="'.$name_css.'">'.$invoice->$db_invoice_ref.'</span>';

        return [
            'action'       => (string) $action_html,
            $db_invoice_id => (string) $invoice->$db_invoice_id,
            $db_invoice_date => (string) $invoice->$db_invoice_date,
            $db_invoice_name => (string) $invoice->$db_invoice_name,
            $db_invoice_category => (string) $invoice->$db_invoice_category,
            $db_invoice_type => (string) $invoice->$db_invoice_type,
            $db_invoice_ref => (string) $ref_html,
            $db_invoice_fontcolor => (string) $invoice->$db_invoice_fontcolor,
            $db_invoice_companyid => (string) $invoice->$db_invoice_companyid,
            $db_invoice_companyname1 => (string) $invoice->$db_invoice_companyname1,
            $db_invoice_companyname2 => (string) $invoice->$db_invoice_companyname2,
            $db_invoice_clientid => (string) $invoice->$db_invoice_clientid,
            $db_invoice_clientname => (string) $invoice->$db_invoice_clientname,
            $db_invoice_siteid => (string) $invoice->$db_invoice_siteid,
            $db_invoice_sitename => (string) $invoice->$db_invoice_sitename,
            $db_invoice_addr1 => (string) $invoice->$db_invoice_addr1,
            $db_invoice_addr2 => (string) $invoice->$db_invoice_addr2,
            $db_invoice_addr3 => (string) $invoice->$db_invoice_addr3,
            $db_invoice_attn => (string) $invoice->$db_invoice_attn,
            $db_invoice_dept => (string) $invoice->$db_invoice_dept,
            $db_invoice_contactperson => (string) $invoice->$db_invoice_contactperson,
            $db_invoice_tel => (string) $invoice->$db_invoice_tel,
            $db_invoice_fax => (string) $invoice->$db_invoice_fax,
            $db_invoice_email => (string) $invoice->$db_invoice_email,
            $db_invoice_quot => (string) $invoice->$db_invoice_quot,
            $db_invoice_po => (string) $invoice->$db_invoice_po,
            $db_invoice_totalamount => (string) $invoice->$db_invoice_totalamount,
            $db_invoice_created_by => (string) $invoice->$db_invoice_created_by,
            $db_invoice_created_byname => (string) $invoice->$db_invoice_created_byname,
            $db_invoice_updated_by => (string) $invoice->$db_invoice_updated_by,
            $db_invoice_updated_byname => (string) $invoice->$db_invoice_updated_byname,
            $db_invoice_created_at => (string) $invoice->$db_invoice_created_at,
            $db_invoice_updated_at => (string) $invoice->$db_invoice_updated_at,

        ];
    }

}