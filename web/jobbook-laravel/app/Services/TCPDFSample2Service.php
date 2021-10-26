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

class TCPDFSample2Service
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

        $totalamount = 99999;
        $totalamount = round(floatval($totalamount),2);
        $totalamount = number_format($totalamount,2,".","");
        
        $pdf_doc_title = 'DOCUMENT TITLE';
   
        $this->generatepdf_core('invoice',$job,$jobitems,$jobs,$client,$company,$letterhead=true,$location,$pdf_doc_title,$totalamount);
    }

    public function generatepdf_core($template='invoice',$job,$jobitems,$jobs,$client,$company,$letterhead=false,$location='I',$pdf_doc_title,$totalamount)
    {

        $pdf = new TCPDF();

        # header
        $logo = public_path('tcpdf/images/').'company_logo_small.png';
        $iso = public_path('tcpdf/images/').'ISO_FS680019_cut.png';
        $header_companynamezh = '小 紅 花 有 限 公 司';
        $style = 'color:rgb(222, 49, 99)';
        $header_companynameen1 = 'LITTLE RED FLOWER';
        $header_companynameen2 = ' LIMITED';

        # doc
        $docref = 'INV0001';
        $docdate = 'docdate';
        $companyname = 'companyname';
        $workstatus = 'workstatus';

        $quotno = 'workstatuquotnos';
        $po = 'po';
        $salesperson = 'salesperson';
        $attn = ' &nbsp;&nbsp;  A/C Dept. &nbsp;&nbsp; / &nbsp;&nbsp; 黃先生';
        $tel = '6998 8556';
        $fax = '2388 6830';
        $companyename = 'Little Red Flower Limited';
        $companycname = '小紅花有限公司';
        $companyaddr = '香港九龍新蒲崗爵祿街 33 號 Port33 20樓02室';

        # envelope
        $companyname1 = "Wing Hing Air Condition Co.";
        $companyname2 = "客戶有限公司";
        $companyaddr1 = "九龍 九龍灣常悅道19號福康工業大廈5樓6室";
        $companyaddr2 = "KLN";
        $label_attn = "ATTN:";
        // $attn = "A/C Dept. / 陳先生";
        $label_tel = "TEL:";
        $company_tel = "6998 8556";
        $label_fax = "FAX:";
        $company_fax = "2388 6830";

        # info
        $label_ref = "Invoice No.:";
        $docref = "INV-123456";
        $label_date = "Date:";
        $docdate = Carbon::today()->toDateString();




        # item frame
        $column1 = '#';
        $column2 = 'Description';
        $column3 = 'QTY';
        $column4 = 'Unit Price<br>HK$';
        $column5 = 'Period';
        $column6 = 'Amount<br>HK$';
        $label_totalamount = 'Total Amount';
        $label_amountdue = 'Total Amount this due';

        # items
        $items = collect();

        for($i=1;$i<100;$i++){
            $item = New Item;
            $item->description = 'Item'.$i;
            $item->unitprice = $i;
            $item->qty = $i;
            $item->subtotal = $i * $i;
            $item->period = 'period';
            $item->activity = $i;
            $items->push($item);
        }


        # terms
        $terms = [];
        $terms[] = "THIS INVOICE IS DUE FOR PAYMENT ON THE DATE LISTED ABOVE.";
        $terms[] = "A 5% overdue surcharge may be charged on client with outstanding payment after 90 days according to the issue date of this invoice.";
        $terms[] = "A 10% overdue surcharge may be charged after 120 days.";
        $terms[] = "Thereafter, a 20% overdue surcharge may be charged after 150 days. Then so on, a 30% overdue surcharge may be charged after 180 days.";
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
            $label_totalamount,
            $label_amountdue
        )  {

            if ($letterhead){
                $this->pdf_page_logo($pdf,$logo);
                $this->pdf_page_iso($pdf,$iso);
                $this->pdf_page_header($pdf,$header_companynamezh,$style,$header_companynameen1,$header_companynameen2);
            }

            $this->pdf_page_title($pdf,$pdf_doc_title);
            
            
            $this->pdf_info_frame($pdf);
            $this->pdf_info_content($pdf,$docref,$docdate,$quotno,$po,$salesperson,$attn,$tel,$fax,$companyename,$companycname,$companyaddr);

            // // $this->pdf_envelope_size($pdf);
            // // $this->pdf_envelope_window($pdf);
            // $this->pdf_envelope_content($pdf,$companyname1,$companyname2,$companyaddr1,$companyaddr2,$label_attn,$attn,$label_tel,$company_tel,$label_fax,$company_fax);
            // $this->pdf_info_right($pdf,$label_ref,$docref,$label_date,$docdate);
            
            $this->pdf_item_frame($pdf,$column1,$column2,$column3,$column4,$column5,$column6,$label_totalamount,$label_amountdue);
            // $this->pdf_remark_frame($pdf);
            // $this->pdf_signature_frame($pdf);
        });
            


        // Custom Footer ( on every page )
        $pdf::setFooterCallback(function($pdf) use ($template,$docref,$letterhead,$signaturepng,$footer_contact,$footer_addr,$terms,$sign_companyname,$sign_auth,$eoe) {

            // Absolute X Y Positon
            $pdf->SetY(-70);

            $debug_border_show = 0;

            $this->pdf_remarks($pdf,$terms);
            $this->pdf_signaturepng($pdf,$signaturepng);
            $this->pdf_signature_area($pdf,$sign_companyname,$sign_auth,$debug_border_show);
            $this->pdf_eoe($pdf,$eoe);
            $this->pdf_paymentmethod($pdf);
            if ($letterhead){
                $this->pdf_letter_footer_addr($pdf,$footer_addr);
                $this->pdf_letter_footer_contact($pdf,$footer_contact);
            }
            $this->pdf_letter_footer_pages($pdf,$docref,$debug_border_show);
        });

        // Page setting
        $this->pdf_page_setting($pdf,$docref);
        

        // Main Table
        $this->pdf_item_content($pdf,$items);

        
        // Last page
        // print totalamount on last page only
        $pdf::SetMargins(10,0,10); # PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
        $pdf::SetAutoPageBreak(false, 297-214); # PDF_MARGIN_BOTTOM 83
        $this->pdf_totalamount($pdf,$totalamount);
        

        # testing
        // $this->pdf_example_writehtml($pdf);
        // $this->pdf_example_writehtmlcell($pdf);
        // $this->pdf_example_cell($pdf);
        // $this->pdf_example_write($pdf);
        
           
        return $this->pdf_output($pdf,$docref,$docdate,$companyname,$workstatus,$letterhead,$location);
    }

    
    public function pdf_envelope_content($pdf,$companyname1,$companyname2,$companyaddr1,$companyaddr2,$label_attn,$attn,$label_tel,$company_tel,$label_fax,$company_fax)
    {
        $pdf->SetFont('droidsansfallbackhk', 'B', 10);

        // companynam1
        $pdf->writeHTMLCell($w=80,$h=5,$x=15,$y=50,$companyname1,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // companynam2
        $pdf->writeHTMLCell($w=80,$h=5,$x=15,$y=55,$companyname2,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // empty line
        $pdf->writeHTMLCell($w=80,$h=5,$x=15,$y=60,'',$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // addr1
        $pdf->writeHTMLCell($w=80,$h=5,$x=15,$y=65,$companyaddr1,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        
        // addr2
        $pdf->writeHTMLCell($w=80,$h=5,$x=15,$y=70,$companyaddr2,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // attn
        $pdf->writeHTMLCell($w=15,$h=5,$x=15,$y=75,$label_attn,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=65,$h=5,$x=30,$y=75,$attn,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // tel
        $pdf->writeHTMLCell($w=15,$h=5,$x=15,$y=80,$label_tel,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=25,$h=5,$x=30,$y=80,$company_tel,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // fax
        $pdf->writeHTMLCell($w=15,$h=5,$x=55,$y=80,$label_fax,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=25,$h=5,$x=70,$y=80,$company_fax,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
    }

    public function pdf_info_right($pdf,$label_ref,$docref,$label_date,$docdate)
    {
        // Rightside
        $debug_border=false;

        $info_x = 0;
        $info_y = 0;

        // ref no.
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+120,$y=$info_y+60,$label_ref,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=40,$h=5,$x=$info_x+150,$y=$info_y+60,$docref,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);

        // date
        $pdf->writeHTMLCell($w=30,$h=5,$x=$info_x+120,$y=$info_y+65,$label_date,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
        $pdf->writeHTMLCell($w=40,$h=5,$x=$info_x+150,$y=$info_y+65,$docdate,$border=0,$ln=0,$fill=0,$reseth=true,$align='L',$autopadding=false);
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
        $pdf::SetAutoPageBreak(true, 297-214); # PDF_MARGIN_BOTTOM 83

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
        $view = \View::make('tcpdf.sample2.item_content')
            ->with('items', $items);
        $html = $view->render();
        $pdf::SetFont('droidsansfallbackhk', '', 8);
        $pdf::writeHTML($html, $ln=false, $fill=false, $reseth=false, $cell=false, $align='');
        
    }

    public function pdf_totalamount($pdf,$totalamount,$debug_border_show=0)
    {
        // Absolute X Y Positon
        $pdf::SetY(215+3);
        $pdf::SetFont('droidsansfallbackhk', 'B', 12);
        // $pdf->Cell(62, 0, 'Page '.$pdf->PageNo().'/'.$pdf->getNumPages(), $debug_border_show, false, 'R', 0, '', 0, false, 'M', 'M');
        $pdf::Cell(0, 0, $totalamount, $debug_border_show, false, 'R', 0, '', 0, false, 'M', 'M');

        $pdf::SetY(215+3+6);
        $pdf::Cell(0, 0, $totalamount, $debug_border_show, false, 'R', 0, '', 0, false, 'M', 'M');
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

        $envw_x = 15-2;
        $envw_y = 50-1;
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

        // frame
        $pdf->writeHTMLCell($w=210, $h=100, $x=0, $y=0, $html='', $border=1, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);
        $pdf->writeHTMLCell($w=210, $h=100, $x=0, $y=100, $html='', $border=1, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);
        $pdf->writeHTMLCell($w=210, $h=100, $x=0, $y=200, $html='', $border=1, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);
    }

    public function pdf_paymentmethod($pdf)
    {
        // Absolute X Y Positon
        $x = 125;
        $y = 245;
        
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
        $pdf->writeHTMLCell($w+4, $h+2, $x-2, $y-1, '', 1, $ln, $fill, $reseth, $align, $autopadding);
    }

    public function pdf_page_header($pdf,$header_companynamezh,$style,$header_companynameen1,$header_companynameen2)
    {
        $debug_border_show = 0;

        // $pdf->SetY();

        // Example Cell
        //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

        // line1
        $pdf->SetFont('droidsansfallbackhk', 'B', 12);
        $pdf->Cell(3, 7, '', $debug_border_show, true, 'C', 0, '', 0, false, 'M', 'M');

        // line2
        $pdf->Cell(22, 7, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(0, 10, $header_companynamezh, $debug_border_show, true, 'L', 0, '', 0, false, 'T', 'M');

        // line3
        $pdf->Cell(22, 7, '', $debug_border_show, false, 'C', 0, '', 0, false, 'M', 'M');
        // $pdf->SetTextColor(66, 100, 244);
        // $pdf->Cell(0, 10, 'WELLTECH AERIAL ENGINEERING ', 1, true, 'L', 0, '', 0, false, 'M', 'M');
        // $pdf->SetTextColor(0, 0, 0);
        // $pdf->Cell(0, 10, 'COMPANY LIMITED', 1, true, 'L', 0, '', 0, false, 'M', 'M');

        // line4
        $html = '<span style="'.$style.'">'.$header_companynameen1.'</span>'.$header_companynameen2;
        // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
        $y = $pdf->getY();
        $pdf->writeHTMLCell(120, '', 32, 21, $html, 0, 0, 0, true, 'J', true);

    }

    public function pdf_page_title($pdf,$pdf_doc_title)
    {
        // title - absolute Y position
        $pdf->SetY(35);

        // maintitle
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Write(0, $pdf_doc_title, '', 0, 'C', true, 0, false, false, 0); 

        // subtitle
        $pdf->SetFont('droidsansfallbackhk', '', 8);
        // $pdf->Write(0, '( Scaffolds Leasing )', '', 0, 'C', true, 0, false, false, 0); 

        // spacing
        $pdf->SetFont('droidsansfallbackhk', '', 4);
        $pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0); 
    }

    public function pdf_item_frame($pdf,$column1,$column2,$column3,$column4,$column5,$column6,$label_totalamount,$label_amountdue)
    {
        // items table header
        $pdf->SetY(90);
        $x = $pdf->getX();
        $y = $pdf->getY();
        $view = \View::make('tcpdf.sample2.item_frame')
            ->with('column1',$column1)
            ->with('column2',$column2)
            ->with('column3',$column3)
            ->with('column4',$column4)
            ->with('column5',$column5)
            ->with('column6',$column6)
            ->with('label_totalamount',$label_totalamount)
            ->with('label_amountdue',$label_amountdue);
        $html = $view->render();
        $pdf->SetFont('droidsansfallbackhk', '', 8);
        $x = 10;
        $y = 90;
        $w = 0;
        $h = 10;
        $pdf->writeHTMLCell($w, $h, $x, $y, $html, 1, 1, 0, true, 'J', true);
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

    public function pdf_info_content($pdf,$docref,$docdate,$quotno,$po,$salesperson,$attn,$tel,$fax,$companyname,$companycname,$companyaddr)
    {
        $pdf->SetY(45);
        $view = \View::make('tcpdf.sample2.info_content')
            ->with('docref', $docref)
            ->with('docdate', $docdate)
            ->with('quotno', $quotno)
            ->with('po', $po)
            ->with('salesperson', $salesperson)
            ->with('attn', $attn)
            ->with('tel', $tel)
            ->with('fax', $fax)
            ->with('companyname', $companyname)
            ->with('companycname', $companycname)
            ->with('companyaddr', $companyaddr);
        $html = $view->render();
        $pdf->SetFont('droidsansfallbackhk', '', 8);
        $pdf->writeHTMLCell(0, 45, 10, 45, $html, 0, 0, 0, true, 'J', true);
        // $pdf->writeHTML($html, false, false, false, false, '');
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

    public function pdf_signature_area($pdf,$sign_companyname,$sign_auth,$debug_border_show)
    {
        // Absolute X Y Positon

        $pdf->SetY(-40);
        $pdf->SetFont('droidsansfallbackhk', 'B', 10);
        $pdf->Cell(62, 10, 'For and on behalf of', $debug_border_show, true, 'L', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(62, 10, $sign_companyname, $debug_border_show, false, 'L', 0, '', 0, false, 'M', 'M');

        $pdf->SetY(-18);
        $pdf->SetFont('droidsansfallbackhk', 'B', 12);
        //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
        $pdf->Cell(62, 0, $sign_auth, $debug_border_show, false, 'L', 0, '', 0, false, 'M', 'M');
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
        // $pdf->Cell(62, 0, 'Page '.$pdf->PageNo().'/'.$pdf->getNumPages(), $debug_border_show, false, 'R', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(0, 0, $docref.'   Page '.$pdf->PageNo().'/'.$pdf->getAliasNbPages(), $debug_border_show, false, 'R', 0, '', 0, false, 'M', 'M');

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