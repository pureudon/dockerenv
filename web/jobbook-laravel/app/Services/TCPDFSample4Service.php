<?php 

namespace App\Services;

// Facades
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;
use Carbon\Carbon;

// Repositories
// use App\Repositories\JobRepository;

// Models
use App\Models\Jobitem;
use App\Models\Client;
use App\Models\Company;
use App\Models\Item;

class TCPDFSample4Service
{
    // protected $jobRepository;
    // protected $myobService;
  
    public function __construct(
        // JobRepository $jobRepository,
        // MYOBService $myobService
    )
    {
        // $this->jobRepository = $jobRepository;
        // $this->myobService = $myobService;

    }



    public function generatejobpdf($id,$letterhead=false,$location='I')
    {
        $jobitems = collect();
        $jobitems->push(New Jobitem);
        $jobs = collect();
        $job = collect();

        $client = New CLient;

        $company = New Company;

        
   
        $this->generatepdf_core('invoice',$job,$jobitems,$jobs,$client,$company,$letterhead=true,$location);
    }

    public function generatepdf_core($template='invoice',$job,$jobitems,$jobs,$client,$company,$letterhead=false,$location='I')
    {

        $pdf = new TCPDF();

        // $pdf->SetFont('droidsansfallbackhk', 'B', 12); >>>>> bold font style not working
        // $pdf->SetFont('helvetica', 'B', 8); >>>>> bold font style working !!!!!

        $pdf_doc_title = 'INVOICE';

        # header
        $logo = public_path('tcpdf/images/').'company_logo_small.png';
        $iso = public_path('tcpdf/images/').'ISO_FS680019_cut.png';
        $header_companynamezh = '小 紅 花 有 限 公 司';
        $style = 'color:rgb(222, 49, 99)';
        $header_companynameen1 = 'LITTLE RED FLOWER';
        $header_companynameen2 = ' LIMITED';

        $header_contact = '電話 Tel   (852) 2388 8116      傳真 Fax   (852) 2388 6830      電郵 Email   info@welltechaerial.com';
        $header_company = 'Little Red Flower Ltd';
        $header_addr1 = 'Unit 2002, Port33, 33 Tseuk Luk Street';
        $header_addr2 = 'San Po Kong, Kowloon, Hong Kong';
        $header_email = 'info@littleredflower.com';
        $header_tel = '852 2352 7518';

        # doc
        $docref = 'INV0001';
        $docdate = 'docdate';
        $companyname = 'companyname';
        $workstatus = 'workstatus';

        $quotno = 'workstatuquotnos';
        $po = 'po';
        $salesperson = 'salesperson';
        $attn = ' &nbsp;&nbsp;  A/C Dept. &nbsp;&nbsp; / &nbsp;&nbsp; 先生';
        $tel = '6998 8556';
        $fax = '2388 6830';
        $companyename = 'Little Red Flower Limited';
        $companycname = '小紅花有限公司';
        $companyaddr = '香港九龍新蒲崗爵祿街 33 號 Port33 20樓02室';

        # envelope
        $companyname1 = "Client Company Name";
        $companyname2 = "客戶公司 中文";
        $companyaddr1 = "客戶地址 行一";
        $companyaddr2 = "客戶地址 行二";
        $label_attn = "ATTN";
        // $attn = "A/C Dept. / 陳先生";
        $label_tel = "TEL";
        $company_tel = "6998 8556";
        $label_fax = "";
        $company_fax = "";
        $label_email = "EMAIL";
        $company_email = "info@xxxxxxxx.com";

        # info
        $label_ref = "#";
        $docref = "INV-123456";
        $label_date = "Invoice Date:";
        $docdate = Carbon::today()->toDateString();

        $label_duedate = "Due Date:";
        $duedate = Carbon::today()->toDateString();

        # item frame
        $column1 = '#';
        $column2 = 'Description';
        $column3 = 'QTY';
        $column4 = 'UnitPrice';
        $column5 = 'Amount(HKD)';
        $column6 = 'Amount<br>HK$';
        $label_totalamount = 'Total';
        $label_amountdue = 'Total Amount this due';

        # items
        $items = collect();
            $item = New Item;
            $item->description = 'Site Maintenance ( 2021 Jan )'.'<br>';
            $item->description .= '- From 2021-01-01 To 2021-01-31'.'<br>';
            $item->description .= '- Domain Server, Mail Server, Web Server, Network Router Setting, Printer Setup';
            $item->unitprice = 4000;
            $item->qty = 1;
            $item->subtotal = 4000;
            $item->period = '';
            $item->activity = 1;
            $items->push($item);

            $item = New Item;
            $item->description = 'Jobbook System Maintenance ( 2021 Jan )'.'<br>';
            $item->description .= '- From 2020-01-01 To 2020-01-31'.'<br>';
            $item->description .= '- Source code update'.'<br>';
            $item->description .= '- Database regular backup'.'<br>';
            $item->unitprice = 3000;
            $item->qty = 1;
            $item->subtotal = 3000;
            $item->period = '';
            $item->activity = 2;
            $items->push($item);
        for($i=1;$i<=99;$i++){
            $item = New Item;
            $item->description = 'Item'.$i;
            $item->unitprice = $i;
            $item->qty = $i;
            $item->subtotal = $i * $i;
            $item->period = 'period';
            $item->activity = $i;
            $items->push($item);
        }

        // format
        foreach($items as $item){
            $item->unitprice = number_format($item->unitprice,2,".",",");
            $item->subtotal = number_format($item->subtotal,2,".",",");
        }

        $subtotalamount = 12345;
        $discountamount = -100;
        $totalamount = 99999;

        // format
        $subtotalamount = number_format($subtotalamount,2,".",",");
        $discountamount = number_format($discountamount,2,".",",");
        $totalamount = round(floatval($totalamount),2);
        $totalamount = number_format($totalamount,2,".",",");


        # terms
        $terms = array();
        // $terms[] = "";

        // $terms[] = "(Surcharge includes the cost and expense of engaging a debt recovery agent or instituting legal proceeding. Our company reserves the right of final decision on the interpretation.)";
        // $terms[] = "Please disregard the above if payment has been made. Please contact our Accounting Department at 2388 8116 for any query regarding to this invoice.";

        # signature
        $sign_companyname = 'Little Red Flower Ltd';
        $sign_auth = 'Authorized Signature';

        $eoe = 'E. & O.E.';

        # footer
        $signaturepng = public_path('tcpdf/images/').'invoice_signature.png';
        $footer_contact = '電話 Tel   (852) 2388 8116      傳真 Fax   (852) 2388 6830      電郵 Email   info@welltechaerial.com';
        $footer_addr = 'Unit 2002, Port33, 33 Tseuk Luk Street, San Po Kong, Kowloon, Hong Kong  香港九龍新蒲崗爵祿街 33 號 Port33 20樓02室';


        // Custom Header ( on every page )
        $pdf::setHeaderCallback(function($pdf) use (
            $template,
            $letterhead,
            $pdf_doc_title,
            $docref,
            $docdate,
            $quotno,
            $po,
            $salesperson,
            $attn,
            $tel,
            $fax,
            $companyename,
            $companycname,
            $companyaddr,
            $header_companynamezh,
            $style,
            $header_companynameen1,
            $header_companynameen2,
            $logo,
            $iso,
            $column1,
            $column2,
            $column3,
            $column4,
            $column5,
            $column6,
            $label_ref,
            $label_date,
            $companyname1,
            $companyname2,
            $companyaddr1,
            $companyaddr2,
            $label_attn,
            // $attn,
            $label_tel,
            $company_tel,
            $label_fax,
            $company_fax,
            $label_email,
            $company_email,
            $label_totalamount,
            $label_amountdue,
            $header_company,
            $header_addr1,
            $header_addr2,
            $header_tel,
            $header_email,
            $label_duedate,
            $duedate,
            $subtotalamount,
            $discountamount
        )  {

            if ($letterhead){
                // $this->pdf_page_logo($pdf,$logo);
                // $this->pdf_page_iso($pdf,$iso);
                // $this->pdf_barcode($pdf,$docref);
                $this->pdf_qrcode($pdf,$docref);
                
                $this->pdf_page_header($pdf,$header_companynamezh,$style,$header_companynameen1,$header_companynameen2);
                $this->pdf_header_right($pdf,$header_company,$header_addr1,$header_addr2,$header_tel,$header_email);
            }

            $this->pdf_page_title($pdf,$pdf_doc_title);
            
            
            // $this->pdf_info_frame($pdf);
           
            // $this->pdf_envelope_size($pdf);
            // $this->pdf_envelope_window($pdf);
            $this->pdf_envelope_content($pdf,$companyname1,$companyname2,$companyaddr1,$companyaddr2,$label_attn,$attn,$label_tel,$company_tel,$label_fax,$company_fax,$label_email,$company_email);
            $this->pdf_elem_docref($pdf,$label_ref,$docref,$label_date,$docdate);
            $this->pdf_info_left($pdf,$label_ref,$docref,$label_date,$docdate,$label_duedate,$duedate);
            // $this->pdf_info_right($pdf,$label_ref,$docref,$label_date,$docdate);
            
            $this->pdf_item_frame($pdf,$column1,$column2,$column3,$column4,$column5,$column6,$label_totalamount,$label_amountdue);
            // $this->pdf_remark_frame($pdf);
            // $this->pdf_signature_frame($pdf);
        });
            


        // Custom Footer ( on every page )
        $pdf::setFooterCallback(function($pdf) use ($template,$docref,$letterhead,$signaturepng,$footer_contact,$footer_addr,$terms,$sign_companyname,$sign_auth,$eoe,$subtotalamount,$discountamount) {

            // Absolute X Y Positon
            $pdf->SetY(-70);

            $debug_border_show = 0;

            // $this->pdf_remarks($pdf,$terms);
            // $this->pdf_signaturepng($pdf,$signaturepng);
            // $this->pdf_signature_area($pdf,$sign_companyname,$sign_auth,$debug_border_show);
            // $this->pdf_eoe($pdf,$eoe);
            $this->pdf_paymentmethod($pdf);
            if ($letterhead){
                // $this->pdf_letter_footer_addr($pdf,$footer_addr);
                // $this->pdf_letter_footer_contact($pdf,$footer_contact);
            }
            $this->pdf_letter_footer_pages($pdf,$docref,$debug_border_show);
        });

        // PDF Page setting
        $this->pdf_page_setting($pdf,$docref);
        

        // Main Table
        $this->pdf_item_content($pdf,$items,$subtotalamount,$discountamount);

        
        // Last page
        // print totalamount on last page only
        $pdf::SetMargins(10,0,10); # PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
        $pdf::SetAutoPageBreak(false, 297-214); # PDF_MARGIN_BOTTOM 83
        $this->pdf_totalamount($pdf,$totalamount,$subtotalamount,$discountamount);
        

        # testing
        // $this->pdf_example_writehtml($pdf);
        // $this->pdf_example_writehtmlcell($pdf);
        // $this->pdf_example_cell($pdf);
        // $this->pdf_example_write($pdf);
        
           
        return $this->pdf_output($pdf,$docref,$docdate,$companyname,$workstatus,$letterhead,$location);
    }

    public function pdf_qrcode($pdf,$docref)
    {
        $style = array(
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
        
        // QRCODE,L : QR-CODE Low error correction
        $link = 'http://gridviz.com/'.'watch';
        $pdf->write2DBarcode($code=$link, $type='QRCODE,L', $x=180, $y=270, $w=20, $h=20, $style=$style, $align='N', $distort=false);
    }

    public function pdf_barcode($pdf,$docref)
    {
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => false,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
        
        // PRINT VARIOUS 1D BARCODES
        
        // CODE 39 + CHECKSUM
        $pdf->write1DBarcode($code='INV-123456', $type='C39+', $x='100', $y='', $w='', $h=10, $xres=0.4, $style=$style, $align='N');
    }

    
    public function pdf_envelope_content($pdf,$companyname1,$companyname2,$companyaddr1,$companyaddr2,$label_attn,$attn,$label_tel,$company_tel,$label_fax,$company_fax,$label_email,$company_email)
    {
        $pdf->SetFont('droidsansfallbackhk', '', 10);

        $env_x = 10;
        $env_y = 40;
        $line_y = 5;

        // companynam1
        $pdf->writeHTMLCell($w=80,$h=5,$x=$env_x,$y=$env_y+0,$companyname1,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // companynam2
        $pdf->writeHTMLCell($w=80,$h=5,$x=$env_x,$y=$env_y+($line_y*1),$companyname2,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // addr
        $pdf->writeHTMLCell($w=80,$h=5,$x=$env_x,$y=$env_y+($line_y*2),$companyaddr1,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // addr2
        $pdf->writeHTMLCell($w=80,$h=5,$x=$env_x,$y=$env_y+($line_y*3),$companyaddr2,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        
        // emptyline
        $pdf->writeHTMLCell($w=80,$h=5,$x=$env_x,$y=$env_y+($line_y*4),'',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // attn
        $pdf->writeHTMLCell($w=15,$h=5,$x=$env_x,$y=$env_y+($line_y*5),$label_attn,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=65,$h=5,$x=$env_x+15,$y=$env_y+($line_y*5),$attn,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // tel
        $pdf->writeHTMLCell($w=15,$h=5,$x=$env_x,$y=$env_y+($line_y*6),$label_tel,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=25,$h=5,$x=$env_x+15,$y=$env_y+($line_y*6),$company_tel,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // fax
        $pdf->writeHTMLCell($w=15,$h=5,$x=$env_x+40,$y=$env_y+($line_y*6),$label_fax,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=25,$h=5,$x=$env_x+45,$y=$env_y+($line_y*6),$company_fax,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // email
        $pdf->writeHTMLCell($w=15,$h=5,$x=$env_x,$y=$env_y+($line_y*7),$label_email,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=65,$h=5,$x=$env_x+15,$y=$env_y+($line_y*7),$company_email,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
    }

    public function pdf_elem_docref($pdf,$label_ref,$docref,$label_date,$docdate)
    {
        $info_x = 170;
        $info_y = 15+12;

        // ref no.
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+0,$label_ref.' '.$docref,$border=0,$ln=0,$fill=0,$reseth=true,$align='R',$autopadding=false);
    }

    public function pdf_info_left($pdf,$label_ref,$docref,$label_date,$docdate,$label_duedate,$duedate)
    {
        // Leftside
        $debug_border=false;

        $info_x = 10;
        $info_y = 83.5;

        // date
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+0,$label_date,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=60,$h=5,$x=$info_x+30,$y=$info_y+0,$docdate,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
    }

    public function pdf_info_right($pdf,$label_ref,$docref,$label_date,$docdate)
    {
        // Rightside
        $debug_border=false;

        $info_x = 110;
        $info_y = 40;

        // ref no.
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+0,$label_ref,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=60,$h=5,$x=$info_x+30,$y=$info_y+0,$docref,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // date
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+5,$label_date,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=60,$h=5,$x=$info_x+30,$y=$info_y+5,$docdate,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // quotation
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+10,'',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=60,$h=5,$x=$info_x+30,$y=$info_y+10,'',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // salesperson
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+15,'Salesperson:',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=60,$h=5,$x=$info_x+30,$y=$info_y+15,'xxxxxxxx',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // tel
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+20,'Tel',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=60,$h=5,$x=$info_x+30,$y=$info_y+20,'xxxx xxxx',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // email
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+25,'Email',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=60,$h=5,$x=$info_x+30,$y=$info_y+25,'info@littleredflower.com',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // po
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+30,'',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=60,$h=5,$x=$info_x+30,$y=$info_y+30,'',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // remark
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+0,$y=$info_y+35,'',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=60,$h=5,$x=$info_x+30,$y=$info_y+35,'',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
    }

    public function pdf_remark_frame($pdf)
    {
        // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
        $pdf->Cell(0, 25, '', 1, true, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function pdf_signature_frame($pdf)
    {
        // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
        $pdf->Cell(0, 30, '', 1, true, 'C', 0, '', 0, false, 'T', 'M');
    }



    public function pdf_page_setting($pdf,$docref)
    {
        // set header and footer fonts
        $pdf::setHeaderFont(Array('helvetica', '', 10)); # PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN
        $pdf::setFooterFont(Array('helvetica', '', 8)); # PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA

        // set margins
        $pdf::SetMargins(10,100,10); # PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
        $pdf::SetHeaderMargin(5); # PDF_MARGIN_HEADER
        $pdf::SetFooterMargin(15); # PDF_MARGIN_FOOTER

        // set auto page breaks
        $pdf::SetAutoPageBreak(true, 297-210); # PDF_MARGIN_BOTTOM 83

        // set image scale factor
        $pdf::setImageScale(1.25); # PDF_IMAGE_SCALE_RATIO

        $pdf::AddPage();
        
        $pdf::SetTitle($docref);

    }

    public function pdf_item_content($pdf,$items)
    {
        // $x = $pdf->getX();
        // $y = $pdf->getY();
        $pdf::SetX(10);
        $pdf::SetY(100);

        // // items table body
        $view = \View::make('tcpdf.sample4.item_content')
            ->with('items', $items);
        $html = $view->render();
        $pdf::SetFont('droidsansfallbackhk', '', 12);
        $pdf::writeHTML($html, $ln=false, $fill=false, $reseth=false, $cell=false, $align='');
        
    }

    
    public function pdf_totalamount($pdf,$totalamount,$subtotalamount,$discountamount)
    {
        // Absolute X Y Positon
        $pdf::SetFont('droidsansfallbackhk', '', 10);
        $info_x = 170;
        $info_y = 209.5; // depends on table spacing and fontsize
        $line_y = 6.5;
        $pdf::writeHTMLCell($w=30,$h=5,$x=$info_x,$y=$info_y+0,$html=$subtotalamount,$border=0,$ln=0,$fill=0,$reseth=true,$align='R',$autopadding=false);
        $pdf::writeHTMLCell($w=30,$h=5,$x=$info_x,$y=$info_y+($line_y*1),$html=$discountamount,$border=0,$ln=0,$fill=0,$reseth=true,$align='R',$autopadding=false);
        $pdf::writeHTMLCell($w=30,$h=5,$x=$info_x,$y=$info_y+($line_y*2),$html=$totalamount,$border=0,$ln=0,$fill=0,$reseth=true,$align='R',$autopadding=false);
    }


    public function pdf_output($pdf,$docref,$docdate,$companyname,$workstatus,$letterhead,$location)
    {

        // pdf name

        $pdf_filename = $docref;
        $pdf_filename .= '-'.$docdate;
        if ( !empty($companyname) ) {
            if ($this->is_english($companyname)) {
                $companyname = str_replace(' ','',$companyname);
                $companyname = str_replace('.','',$companyname);
                $companyname = str_replace('&','',$companyname);
                $companyname = str_replace(',','',$companyname);
                $companyname = str_replace('(','',$companyname);
                $companyname = str_replace(')','',$companyname);
                $companyname = str_replace('/','',$companyname);
                if (preg_match('/^[A-Za-z0-9]+/', $companyname))
                    $pdf_filename .= '-'.$companyname;
            }
        }
        $pdf_filename .= '-'.$workstatus;
        $pdf_filename .= ($letterhead==true) ? '-LetterHead' : '-Print';
        $pdf_filename .= '.pdf';


        if($location=='I'){
            $pdf::Output($pdf_filename,'I');
        }
        else{
            if( $letterhead==true )
                $project_public_root = "C:/xampp/htdocs/welltech/admin/pdf/invoice/PDFL";
            else
                $project_public_root = "C:/xampp/htdocs/welltech/admin/pdf/invoice/Print";
            // $project_public_root = "C:/xampp/htdocs/welltech/jobbook/pdf/invoice";
    
            // F : file
            // I : inline
            // D : download
            // FD
            // Open
            $pdf::Output($project_public_root."/".$pdf_filename,'F');
            $pdf::reset();
            return $project_public_root."/".$pdf_filename;
        }
    }

    public function pdf_example_writehtml($pdf)
    {
        // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
      
        // absolute Y Position, relative X Position start from left 
        $pdf->SetY(220);

        $html ="whitehtml";
        $html .="<br>";
        $html .="line2";
        $html .="<br>";
        $html .="line3";

        $pdf->SetFont('droidsansfallbackhk', '', 8);
        $pdf->writeHTML($html, true, false, false, false, 'L');
    }

    public function pdf_example_writehtmlcell($pdf)
    {
        // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
       
        // Absolute X Y Positon
        $x = 125;
        $y = 252;
        
        $w = 70;
        $h = 20;

        $border = 0;
        $ln = 0;
        $fill = 0;
        $reseth = true;
        $align = 'L';
        $autopadding = false;

        $html = "";
        $html .= "writehtmlcell";
        $pdf->SetFont('droidsansfallbackhk', 'B', 12);

        $pdf->writeHTMLCell($w, $h, $x, $y, $html, $border, $ln, $fill, $reseth, $align, $autopadding);
    }

    public function pdf_example_cell($pdf)
    {
        //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

        // absolute Y Position, relative X Position start from left 

        $pdf->SetY(30);

        $pdf->SetFont('droidsansfallbackhk', 'B', 12);

        $pdf->SetY(-40);
        $pdf->SetFont('droidsansfallbackhk', 'B', 10);
        // $pdf->Cell(62, 10, 'For and on behalf of', 1, true, 'L', 0, '', 0, false, 'M', 'M');
        // $pdf->Cell(62, 10, 'Welltech Aerial Engineering Co., Ltd', 1, false, 'L', 0, '', 0, false, 'M', 'M');
   
        $string = '';
        $pdf->Cell(100, 10, $string, 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $string = 'Cell1';
        $pdf->Cell(50, 10, $string, 0, true, 'L', 0, '', 0, false, 'M', 'M');


        $string = '';
        $pdf->Cell(100, 10, $string, 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $string = 'Cell2';
        $pdf->Cell(50, 10, $string, 0, true, 'L', 0, '', 0, false, 'M', 'M');
    }

    public function pdf_example_write($pdf)
    {


        $pdf->Write(0, 'example_write', 0, 'C', true, 0, false, false, 0); 
    }

    public function pdf_page_logo($pdf,$logo)
    {
        // Absolute X Y Positon
        $x = 10;
        $y = 10;
        $image_file = $logo;
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
        $pdf->Image($image_file, $x, $y, '', 15, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    public function pdf_page_iso($pdf,$iso)
    {
        // Absolute X Y Positon
        $x = 170;
        $y = 10;
        $image_file = $iso;
        $pdf->Image($image_file, $x, $y, '', 15, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    public function pdf_envelope_window($pdf)
    {
        // Absolute X Y Positon

        $envw_x = 15-2 -5;
        $envw_y = 50-1 -10;
        $envw_w = 80+4;
        $envw_h = 35+2;

        // frame
        $pdf->writeHTMLCell($w=$envw_w, $h=$envw_h, $x=$envw_x, $y=$envw_y, $html='', $border=1, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);
    }

    public function pdf_envelope_size($pdf)
    {
        // Absolute X Y Positon

        // A4 Size = w210 h297
        // A4 三摺 Envelope Size = w220 h110 

        // frame h/3
        $pdf->writeHTMLCell($w=210, $h=99, $x=0, $y=0, $html='', $border=1, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);
        $pdf->writeHTMLCell($w=210, $h=99, $x=0, $y=99, $html='', $border=1, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);
        $pdf->writeHTMLCell($w=210, $h=99, $x=0, $y=198, $html='', $border=1, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);

        // frame w/2
        $pdf->writeHTMLCell($w=105, $h=297, $x=0, $y=0, $html='', $border=1, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);
    }


    public function pdf_paymentmethod($pdf)
    {
        // Absolute X Y Positon
        $x = 10;
        $y = 235;
        
        $w = 75;
        $h = 30;

        $border = 0;
        $ln = 0;
        $fill = 0;
        $reseth = true;
        $align = 'L';
        $autopadding = false;

        $html = "";
        $html .= "<u>付款方法</u>";
        $html .= "<br>";
        $html .= "支票 或 銀行入帳";
        $html .= "<br>";
        $html .= "抬頭: LITTLE RED FLOWER LIMITED";
        $html .= "<br>";
        $html .= "銀行資料: HSBC Hong Kong (004)";
        $html .= "<br>";
        $html .= "銀行戶口: 642 069272 838";
        $html .= "<br>";
        $html .= "付款後請將收據 Email 或 WhatsApp 我們以確認";

        // $html .= "<br>";
        // $html .= "Standard Chartered: xxx-x-xxxxxx-x";
        // $html .= "<br>";
        // $html .= "Hang Seng: xxx-xxxxxx-xxx";
        // $html .= "<br>";
        // $html .= "DBS: xxxxxxxxx";
        // $html .= "<br>";
        // $html .= "Please email or whatsapp (6998 8556) the <br>bank-in slip to us after payment.";

        $pdf->SetFont('droidsansfallbackhk', 'B', 10);

        // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
        $pdf->writeHTMLCell($w, $h, $x, $y, $html, $border, $ln, $fill, $reseth, $align, $autopadding);

        // frame
        // $pdf->writeHTMLCell($w+4, $h+2, $x-2, $y-1, '', 1, $ln, $fill, $reseth, $align, $autopadding);
    }

    public function pdf_page_header($pdf,$header_companynamezh,$style,$header_companynameen1,$header_companynameen2)
    {
        // Absolute X Y position
        $header_x = 10;
        $header_y = 15;

        // line1
        $pdf->SetFont('droidsansfallbackhk', 'B', 16);
        $pdf->writeHTMLCell($w=100, $h=0, $x=$header_x, $y=$header_y, $html=$header_companynamezh, $border=0, $ln=0, $fill=false, $reseth=true, $align='L', $autopadding=true);

        // line2
        $html = '<span style="'.$style.'">'.$header_companynameen1.'</span>'.$header_companynameen2;
        $pdf->writeHTMLCell($w=100, $h=0, $x=$header_x, $y=$header_y+6, $html=$html, $border=0, $ln=0, $fill=false, $reseth=true, $align='L', $autopadding=true);

    }

    public function pdf_header_right($pdf,$header_company,$header_addr1,$header_addr2,$header_tel,$header_email)
    {
        $info_x = 120;
        $info_y = 40;

        $pdf->SetFont('droidsansfallbackhk', 'B', 10);

        // company
        $pdf->writeHTMLCell($w=80,$h=5,$x=$info_x+0,$y=$info_y+0,$header_company,$border=0,$ln=0,$fill=0,$reseth=true,$align='R',$autopadding=false);

        // addr1
        $pdf->writeHTMLCell($w=80,$h=5,$x=$info_x+0,$y=$info_y+5,$header_addr1,$border=0,$ln=0,$fill=0,$reseth=true,$align='R',$autopadding=false);

        // addr2
        $pdf->writeHTMLCell($w=80,$h=5,$x=$info_x+0,$y=$info_y+10,$header_addr2,$border=0,$ln=0,$fill=0,$reseth=true,$align='R',$autopadding=false);

        // email
        $pdf->writeHTMLCell($w=80,$h=5,$x=$info_x+0,$y=$info_y+15,$header_email,$border=0,$ln=0,$fill=0,$reseth=true,$align='R',$autopadding=false);

        // tel
        $pdf->writeHTMLCell($w=80,$h=5,$x=$info_x+0,$y=$info_y+20,$header_tel,$border=0,$ln=0,$fill=0,$reseth=true,$align='R',$autopadding=false);

    }

    public function pdf_page_title($pdf,$pdf_doc_title)
    {
        // Absolute X Y position
        $doctitle_x = 130;
        $doctitle_y = 15;

        $pdf->SetFont('helvetica', 'B', 28);
        $pdf->writeHTMLCell($w=70, $h=12, $x=$doctitle_x, $y=$doctitle_y, $html=$pdf_doc_title, $border=0, $ln=0, $fill=false, $reseth=true, $align='R', $autopadding=true);
    }

    public function pdf_item_frame($pdf,$column1,$column2,$column3,$column4,$column5,$column6,$label_totalamount,$label_amountdue)
    {
        // items table header
        $pdf->SetY(90);
        $x = $pdf->getX();
        $y = $pdf->getY();
        $view = \View::make('tcpdf.sample4.item_frame')
        // $view = \View::make('tcpdf.sample4.example48')
            ->with('column1',$column1)
            ->with('column2',$column2)
            ->with('column3',$column3)
            ->with('column4',$column4)
            ->with('column5',$column5)
            ->with('column6',$column6)
            ->with('label_totalamount',$label_totalamount)
            ->with('label_amountdue',$label_amountdue);
        $html = $view->render();
        $pdf->SetFont('helvetica', '', 8);
        $x = 10;
        $y = 90;
        $w = 0;
        $h = 10;
        $pdf->writeHTMLCell($w, $h, $x, $y, $html, $border=0, $ln=0, $fill=false, $reseth=true, $align='J', $autopadding=true);
        // $pdf->writeHTMLCell($w, $h, $x, $y, $html, 1, 1, 0, true, 'J', true);
    }


    public function pdf_info_frame($pdf)
    {
        $pdf->SetY(45);

        $html = '';
        $pdf->SetFont('droidsansfallbackhk', '', 8);
        $x = 10;
        $y = 45;
        $w = 0;
        $h = 45;
        $pdf->writeHTMLCell($w, $h, $x, $y, $html, 1, 0, 0, true, 'J', true);
    }

    public function pdf_remarks($pdf,$terms)
    {
        $html = '';
        $html .= '<table>';
        // $html .= '<tr><td style="width:150">Remarks:</td><td colspan="6" style="width:520"></td></tr>';
        foreach($terms as $key=>$term){
            $html .= '<tr><td style="width:15">'.($key+1).'.</td><td colspan="6" style="width:650">'.$term.'</td></tr>';
        }
        $html .= '<tr><td style="width:15"></td><td colspan="6" style="width:650"></td></tr>';
        $html .= '</table>';


        $pdf->SetFont('droidsansfallbackhk', '', 8);
        $pdf->WriteHTML($html);
    }

    public function pdf_signature_area($pdf,$sign_companyname,$sign_auth,$debug_border_show=1)
    {
        // Absolute X Y Positon
        $sign_y = -50;

        $pdf->SetY($sign_y);
        $pdf->SetFont('droidsansfallbackhk', 'B', 10);
        $pdf->Cell($w=62, $h=10, $txt='For and on behalf of', $border=0, $ln=true, $align='L', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='M', $valign='M');
        $pdf->Cell($w=62, $h=10, $txt=$sign_companyname, $border=0, $ln=true, $align='L', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='M', $valign='M');

        $pdf->SetY($sign_y+25);
        $pdf->SetFont('droidsansfallbackhk', 'B', 12);
        $pdf->Cell($w=62, $h=10, $txt=$sign_auth, $border=0, $ln=true, $align='L', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='M', $valign='M');

        // hr line
        $style2 = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf->Line($x1=10, $y1=297+$sign_y+21, $x2=70, $y2=297+$sign_y+21, $style=$style2);
    }

    public function pdf_eoe($pdf,$eoe)
    {
        // Absolute X Y Positon
        $pdf->SetY(-18);
        $pdf->SetFont('droidsansfallbackhk', 'B', 12);
        $w = 0; // whole line
        $h = 0; // auto height
        $pdf->Cell($w, $h, $eoe, false, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function pdf_signaturepng($pdf,$signaturepng)
    {
        // Absolute X Y Positon
        $x = 10;
        $y = 260;

        // signature
        $image_file = $signaturepng;

        // $pdf->Image($image_file, 10, 255, 60, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false); // Ricky
        $pdf->Image($image_file, $x, $y, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false); // Chi
    }

    public function pdf_letter_footer_addr($pdf,$footer_addr)
    {
        // Absolute X Y Positon
        $pdf->SetY(-13);
        $pdf->SetFont('droidsansfallbackhk', 'B', 7);
        $pdf->Cell(0, 0, $footer_addr, false, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function pdf_letter_footer_contact($pdf,$footer_addr)
    {
        // Absolute X Y Positon
        $pdf->SetY(-9);
        $pdf->SetFont('droidsansfallbackhk', 'B', 7);
        $pdf->Cell(0, 0, $footer_addr, 0, false, 'C', 0, '', 0, false, 'M', 'M');

    }


    public function pdf_letter_footer_pages($pdf,$docref,$debug_border_show)
    {
        // Absolute X Y Positon
        $pdf->SetY(-5);
        $pdf->SetFont('droidsansfallbackhk', 'B', 8);
        $pdf->Cell($w=0, $h=0, $txt=$pdf->PageNo().'/'.$pdf->getAliasNbPages(), $border=0, $ln=0, $align='C', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='M', $valign='M');
    }



    public function is_english($str)
    {
        if (strlen($str) != strlen(utf8_decode($str))) {
            return false;
        } else {
            return true;
        }
    }

    public function simple_pdf()
    {
        $html = '<h1>ABCDE</h1>';
        PDF::SetTitle('hihi');
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output('hello_world.pdf');
    }

    public function generatepdf($id)
    {
        $html = '<h1>Hello world</h1>';
        $pdf = new TCPDF();
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('hello_world.pdf');
    }

}