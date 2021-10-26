<?php 

namespace App\Services;

// Facades
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;

// Models
use App\Models\Item;

class TCPDFSample1Service
{

    // private $tcpdf;

    // public function __construct(TCPDF $tcpdf)
    // {
    //     $this->tcpdf = $tcpdf;
    // }




    /**
     * @param id $db_quot_id in quot table
     * @param letterhead true for showing companylogo.png
     * @param signature true for showing signature.png
     * @param letterfooter true for showing company addr at footer
     */
    public function generate_sample1_pdf($letterhead, $signature, $letterfooter)
    {
        # doc
        $docref = 'INV00001';
        $doctitle = 'DOCUMENT TITLE';
        $docsubtitle = '( Subtitle )';
        $docdate = '2021-10-13';


        # header
        $logo = public_path('tcpdf/images/').'company_logo_small.png';
        $iso = public_path('tcpdf/images/').'ISO_FS680019_cut.png';
        $companynamezh = '小 紅 花 有 限 公 司';
        $style = 'color:rgb(222, 49, 99)';
        $companynameen1 = 'LITTLE RED FLOWER';
        $companynameen2 = ' COMPANY LIMITED';
        

        # footer
        $sign_left_en = 'Little Red Flower Ltd.';
        $sign_left_zh = '小紅花有限公司';
        $signaturepng = public_path('tcpdf/images/').'signature_trans_cut.png';

        $sign_right_en = 'Authorized Signature & Company Chop';
        $sign_right_zh = '客戶授權代表簽名及公司印章';

        $footer_addr = 'Unit 2002, Port33, 33 Tseuk Luk Street, San Po Kong, Kowloon, Hong Kong  香港九龍新蒲崗爵祿街 33 號 Port33 20樓02室';
        $tel = '(852) 6998 8556';
        $fax = '(852) 2388 6830';
        $email = 'info@littleredflower.com';
        $footer_contact = '電話 Tel   '.$tel.'      傳真 Fax   '.$fax.'      電郵 Email   '.$email;


        # client
        $label_client = '客戶';
        $label_addr = '公司地址';
        $label_date = 'Date:';
        $label_ref = 'Ref.:';
        $label_billcontact = '帳單聯絡人';
        $label_deliverycontact = '送貨聯絡人';
        $label_client_fax = 'Fax.';
        $label_client_tel = 'Tel.';
        $label_client_email = 'Email.';
        $label_site_tel = 'Tel.';
        
        $client_ename = 'clientename';
        $client_cname = 'clientcname';
        $client_address = 'clientaddress';
        $client_contact_name = 'client_contact_name';
        $client_contact_fax = 'client_contact_fax';
        $client_contact_tel = 'client_contact_tel';
        $client_contact_mobile = 'client_contact_mobile';
        $client_contact_email = 'client_contact_email';

        #site
        $site_contact_name = 'site_contact_name';
        $site_contact_email = 'site_contact_email';
        $site_contact_tel = 'site_contact_tel';
        $site_contact_mobile = 'site_contact_mobile';

        # contact
        $contact_name = 'Little Red Flower';
        $contact_phone_display = '6998 8556';

        # content title
        $tabletitle = 'WORK DESCRIPTION';
        $column1 = 'Description';
        $column2 = 'Unit Price(HK$)';
        $column3 = 'QTY';
        $column4 = 'Sub Total(HK$)';
        $label_totalamount = 'Total Amount (HK$):';

        # content table
        $items = collect();

        for($i=1;$i<100;$i++){
            $item = New Item;
            $item->description = 'Item'.$i;
            $item->unitprice = $i;
            $item->qty = $i;
            $item->subtotal = number_format($i * $i,2,".","") ;
            $item->descriptioncomment = '';
            $item->subtotalcomment = '';
            $items->push($item);
        }

        $site_addr = 'siteaddr';
        $contractamount = '9999999.99';
        $startday = 'startday';
        $endday = 'endday';

        # terms
        $terms = [];
        $terms[] = "Payment Terms: 30 days against invoice.";


        PDF::setHeaderCallback(
            function($pdf) use ($letterhead,$companynamezh,$companynameen1,$companynameen2,$style,$logo,$iso)  {
                $this->pdf_page_header($pdf, $letterhead,$companynamezh,$companynameen1,$companynameen2,$style,$logo,$iso);
            }
        );

        PDF::setFooterCallback(
            function($pdf) use ($docref,$signature,$letterfooter,$sign_left_en,$sign_left_zh,$sign_right_en,$sign_right_zh,$footer_addr,$footer_contact,$signaturepng)  {
                $this->pdf_page_footer($pdf,$docref,$signature,$letterfooter,$sign_left_en,$sign_left_zh,$sign_right_en,$sign_right_zh,$footer_addr,$footer_contact,$signaturepng);
            }
        );


        $this->pdf_page_setting($docref);

        $this->pdf_page_title($doctitle,$docsubtitle);

        $this->pdf_info_table(
            $docdate,
            $docref,
            $label_client,
            $label_addr,
            $label_date,
            $label_ref,
            $label_billcontact,
            $label_deliverycontact,
            $label_client_fax,
            $label_client_tel,
            $label_client_email,
            $label_site_tel,
            $client_ename,
            $client_cname,
            $client_address,
            $client_contact_name,
            $client_contact_fax,
            $client_contact_tel,
            $client_contact_mobile,
            $client_contact_email,
            $site_contact_name,
            $site_contact_tel,
            $site_contact_mobile,
            $site_contact_email
        );

        $this->pdf_content_title($tabletitle);

        $this->pdf_content_table(
            $items,
            $docref,
            $site_addr,
            $contractamount,
            $startday,
            $endday,
            $column1,
            $column2,
            $column3,
            $column4,
            $label_totalamount
        );
        
        $this->pdf_remarks($terms);

        $this->pdf_contactus($contact_name,$contact_phone_display);

        $this->pdf_output($docref);

     }


    public function pdf_page_setting($docref)
    {
        // set header and footer fonts
        PDF::setHeaderFont(Array('helvetica', '', 10)); # PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN
        PDF::setFooterFont(Array('helvetica', '', 8)); # PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA
        // set margins
        PDF::SetMargins(10,30,10); # PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
        PDF::SetHeaderMargin(5); # PDF_MARGIN_HEADER
        PDF::SetFooterMargin(15); # PDF_MARGIN_FOOTER
        // set auto page breaks
        PDF::SetAutoPageBreak(true, 297-247); # PDF_MARGIN_BOTTOM 50
        // set image scale factor
        PDF::setImageScale(1.25); # PDF_IMAGE_SCALE_RATIO

        PDF::AddPage();

        PDF::SetTitle($docref);

        // PDF::SetX(10);
        // PDF::SetY(10);

    }


    public function pdf_page_header($pdf, $letterhead,$companynamezh,$companynameen1,$companynameen2,$style,$logo,$iso)
    {
        // letter head
        if($letterhead){
            $image_file = $logo;
            // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
            $pdf->Image($image_file, 10, 10, '', 15, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            $image_file = $iso;
            $pdf->Image($image_file, 170, 10, '', 15, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            // $pdf->SetY();
            $pdf->SetFont('droidsansfallbackhk', 'B', 12);
            $pdf->Cell(3, 7, '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
            // line2
            $pdf->Cell(22, 7, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $pdf->Cell(0, 10, $companynamezh, 0, true, 'L', 0, '', 0, false, 'T', 'M');
            // line3
            $pdf->Cell(22, 7, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $html = '<span style="'.$style.'">'.$companynameen1.'</span>'.$companynameen2;
            // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

            $y = $pdf->getY();
            $pdf->writeHTMLCell(120, '', 32, 21, $html, 0, 0, 0, true, 'J', true);
        }
    }


    public function pdf_page_footer($pdf,$docref,$signature,$letterfooter,$sign_left_en,$sign_left_zh,$sign_right_en,$sign_right_zh,$footer_addr,$footer_contact,$signaturepng)
    {
        $debug_border_show = 0;
        $footer_start = -70;

        $pdf->SetY($footer_start);

        if ($signature)
        {
            // signature
            $image_file = $signaturepng;
            // var_dump($image_file);
            // die();

            $pdf->Image($image_file, 30, 240, '', 50, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        }

        $pdf->SetY(-45);

        $htmlcontent= '';
        $htmlcontent .= '<table>';
        $htmlcontent .= '<tr><td colspan="2">Offered By: </td><td></td><td colspan="2">Accept on behalf of:</td></tr>';
        // $htmlcontent .= '<tr><td colspan="2" height="100"></td><td></td><td colspan="2"></td></tr>';
        $htmlcontent .= '<tr><td colspan="2"></td><td></td><td colspan="2"></td></tr>';
        $htmlcontent .= '<tr><td colspan="2"></td><td></td><td colspan="2"></td></tr>';
        $htmlcontent .= '<tr><td colspan="2"></td><td></td><td colspan="2"></td></tr>';
        $htmlcontent .= '<tr><td colspan="2" style="border-bottom: 1px solid black;"></td><td></td><td colspan="2" style="border-bottom: 1px solid black;"></td></tr>';
        $htmlcontent .= '<tr><td colspan="2">'.$sign_left_en.'</td><td></td><td colspan="2">'.$sign_right_en.'</td></tr>';
        $htmlcontent .= '<tr><td colspan="2">'.$sign_left_zh.'</td><td></td><td colspan="2">'.$sign_right_zh.'</td></tr>';
        $htmlcontent .= '</table>';

        $pdf->SetFont('droidsansfallbackhk', '', 8);
        // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
        $pdf->writeHTML($htmlcontent, $ln=false, $fill=false, $reseth=false, $cell=false, $algin='');

        // letter footer
        $pdf->SetY(-13);
        if($letterfooter){
            // addr
            $pdf->SetFont('droidsansfallbackhk', 'B', 7);
            $pdf->Cell(0, 0, $footer_addr, 0, false, 'C', 0, '', 0, false, 'M', 'M');

            // contact
            $pdf->SetY(-9);
            $pdf->SetFont('droidsansfallbackhk', 'B', 7);
            $pdf->Cell(0, 0, $footer_contact, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        }


        // pages
        $pdf->SetY(-5);
        $pdf->SetFont('droidsansfallbackhk', 'B', 8);
        // $pdf->Cell(62, 0, 'Page '.$pdf->PageNo().'/'.$pdf->getNumPages(), $debug_border_show, false, 'R', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(0, 0, $docref.'   Page '.$pdf->PageNo().'/'.$pdf->getAliasNbPages(), $debug_border_show, false, 'R', 0, '', 0, false, 'M', 'M');

    }


    public function pdf_page_title($title,$subtitle)
    {
        // title
        // $x=0;
        // $y=0;

        // $y=$y+35;
        // PDF::SetY($y);
        PDF::SetFont('helvetica', 'B', 18);
        PDF::Write(0, $title, '', 0, 'C', true, 0, false, false, 0);
        PDF::SetFont('droidsansfallbackhk', '', 8);
        PDF::Write(0, $subtitle, '', 0, 'C', true, 0, false, false, 0);
        PDF::SetFont('droidsansfallbackhk', '', 1);
        PDF::Write(0, '', '', 0, 'C', true, 0, false, false, 0);

    }


    public function pdf_info_table(
        $docdate,
        $docref,
        $label_client,
        $label_addr,
        $label_date,
        $label_ref,
        $label_billcontact,
        $label_deliverycontact,
        $label_client_fax,
        $label_client_tel,
        $label_client_email,
        $label_site_tel,
        $client_ename,
        $client_cname,
        $client_address,
        $client_contact_name,
        $client_contact_fax,
        $client_contact_tel,
        $client_contact_mobile,
        $client_contact_email,
        $site_contact_name,
        $site_contact_tel,
        $site_contact_mobile,
        $site_contact_email

        )
    {
        // items table header

        // $y=35;
        // $y=$y+15;
        // PDF::SetY($y);
        // $x = PDF::getX();
        // $y = PDF::getY();

        $view = \View::make('tcpdf.sample1.info_content')
            ->with('docdate', $docdate)
            ->with('docref', $docref)
            ->with('label_client', $label_client)
            ->with('label_addr', $label_addr)
            ->with('label_date', $label_date)
            ->with('label_ref', $label_ref)
            ->with('label_billcontact', $label_billcontact)
            ->with('label_deliverycontact', $label_deliverycontact)
            ->with('label_client_fax', $label_client_fax)
            ->with('label_client_tel', $label_client_tel)
            ->with('label_client_email', $label_client_email)
            ->with('label_site_tel', $label_site_tel)
            ->with('client_ename', $client_ename)
            ->with('client_cname', $client_cname)
            ->with('client_address', $client_address)
            ->with('client_contact_name', $client_contact_name)
            ->with('client_contact_fax', $client_contact_fax)
            ->with('client_contact_tel', $client_contact_tel)
            ->with('client_contact_mobile', $client_contact_mobile)
            ->with('client_contact_email', $client_contact_email)
            ->with('site_contact_name', $site_contact_name)
            ->with('site_contact_email', $site_contact_email)
            ->with('site_contact_tel', $site_contact_tel)
            ->with('site_contact_mobile', $site_contact_mobile);

            $html = $view->render();
            PDF::SetFont('droidsansfallbackhk', '', 8);
            // PDF::writeHTMLCell(0, 10, 10, $y, $html, 0, 1, 0, true, 'J', true);
            PDF::writeHTML($html, false, false, false, false, '');
    }

    public function pdf_content_title($title)
    {
        PDF::SetFont('droidsansfallbackhk', '', 12);
        PDF::Write(0, $title, '', 0, 'C', true, 0, false, false, 0);
    }


    public function pdf_content_table(
            $items,
            $docref,
            $site_addr,
            $contractamount,
            $startday,
            $endday,
            $column1,
            $column2,
            $column3,
            $column4,
            $label_totalamount
            )
    {


        // get all information from db
        
        // $item = New Item;
        // $item->description = '';
        // $item->unitprice = '';
        // $item->qty = '';
        // $item->subtotal = '';
        // $item->descriptioncomment = '';
        // $item->subtotalcomment = '';


        // set default items

        $stemp="";
        $stemp .= $this->pdf_table_start();

        $stemp .= $this->pdf_table_header($column1,$column2,$column3,$column4);
        $stemp .= $this->pdf_empty_row();

        $stemp .= $this->pdf_value_row('Site:',$site_addr,$color="Red",$fontweight="bold");
        $stemp .= $this->pdf_value_row('Period:',$this->get_period_string($startday,$endday));
        $stemp .= $this->pdf_empty_row();

        foreach($items as $item){
            $stemp .=  $this->pdf_item_row($item);
        }

        // $description = 'Discount';
        // $stemp .= $this->pdf_item_row($quotitem,$columnview="discountview");

        $stemp .= $this->pdf_empty_row();

        $stemp .= $this->pdf_totalamount_row($label_totalamount,$contractamount);

        $stemp .= $this->pdf_table_end();

        PDF::SetFont('droidsansfallbackhk', '', 8);
        PDF::WriteHTML($stemp);

    }

    public function pdf_table_start(){
        $html = '';
        $html .= '<table style="margin:0px; padding:0px 2px 1px 3px; width:100%; border:1px solid #000000;">';
        return $html;
    }

    public function pdf_table_end(){
        $html = '';
        $html .= '</table>';
        return $html;
    }

    public function pdf_table_header($column1,$column2,$column3,$column4){
        $html = '';
        $html .= '<tr>';
        $html .= '<td colspan="2" style="text-align:center; border-left: 1px solid black; border-bottom: 1px solid black; width:400px">'.$column1.'</td>';
        $html .= '<td style="text-align:center; width:80; border-left: 1px solid black;border-bottom: 1px solid black;">'.$column2.'</td>';
        $html .= '<td style="text-align:center; width:100; border-left: 1px solid black;border-bottom: 1px solid black;">'.$column3.'</td>';
        $html .= '<td style="text-align:center; width:90px; border-left: 1px solid black;border-bottom: 1px solid black;">'.$column4.'</td>';
        $html .= '</tr>';
        return $html;
    }


    public function pdf_item_row($item,$columnview='all'){

        $html='';

        if ($item->comment !== null or $item->unitprice !== null or $item->subtotal != 0)
        {
            $description_display = '';
            $description_display = $item->description;

            $description_comment_display = '';
            $description_comment_display = $item->descriptioncomment;
            $description_comment_display = ( !empty($description_comment_display) ) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$description_comment_display.'<br>' : $description_comment_display ;

            $unitprice_display = '';
            $unitprice_display = $item->unitprice;
            $unitprice_display = sprintf('%.2f',$unitprice_display);

            $qty_display = '';
            $qty_display = $item->qty;

            $subtotal_display = '';
            $subtotal_display = $item->subtotal;
            // $subtotal_display = sprintf('%.2f',$subtotal_display);
            $subtotal_display = number_format($subtotal_display, 2, '.', ',');
            $subtotal_display = ( floatval($subtotal_display) < 0 ) ? '('.abs($subtotal_display).')' : $subtotal_display ;
            
            $subtotal_comment_display = '';
            $subtotal_comment_display = $item->subtotalcomment;

            if ($columnview == 'all'){
                $html = '';
                $html .= '<tr>';
                $html .= '<td colspan="3" style="text-align:left; width:400px; border-left: 1px solid black;">'.$description_display.'<br>'.$description_comment_display.'</td>';
                $html .= '<td style="text-align:right; width:80; border-left: 1px solid black;">'.$unitprice_display.'</td>';
                $html .= '<td style="text-align:center; width:100; border-left: 1px solid black;">'.$qty_display.'</td>';
                $html .= '<td style="text-align:right; width:90px; border-left: 1px solid black;">'.$subtotal_display.'<br>'.$subtotal_comment_display.'</td>';
                $html .= '</tr>';
            }
            if ($columnview == 'discountview'){
                $html = '';
                $html .= '<tr>';
                $html .= '<td colspan="3" style="text-align:left; width:400px; border-left: 1px solid black;">'.$description_display.'<br>'.$description_comment_display.'</td>';
                $html .= '<td style="text-align:right; width:80; border-left: 1px solid black;">'.'</td>';
                $html .= '<td style="text-align:center; width:100; border-left: 1px solid black;">'.'</td>';
                $html .= '<td style="text-align:right; width:90px; border-left: 1px solid black;">'.$subtotal_display.'<br>'.$subtotal_comment_display.'</td>';
                $html .= '</tr>';
            }

        }
        return $html;
    }
    
    public function get_period_string($startday,$endday)
    {
        $period = '';
        $period = $startday;
        $period = ( !empty($endday) ) ? $period.' to '.$endday : $period ;
        return $period;
    }

    public function pdf_value_row($description,$value,$color=null,$fontweight=null)
    {
        $description_display = $description;
        $value_display = $value;

        $value_color = ( empty($color) ) ? "" : " color:".$color.";" ;
        $value_fontweight = ( empty($fontweight) ) ? "" : " font-weight:".$fontweight.";" ;
        $value_css = $value_fontweight.$value_color;


        $html = '';
        if ( !empty($value_display) )
        {
            $html .= '<tr style="line-height: 100%;">';
            $html .= '<td style="text-align:left; width:80px; border-left: 1px solid black;">'.$description_display.'</td>';
            $html .= '<td style="text-align:left; width:320px;'.$value_css.'">'.$value_display.'</td>';
            $html .= '<td style="text-align:left; width:80; border-left: 1px solid black;">'.'</td>';
            $html .= '<td style="text-align:left; width:100; border-left: 1px solid black;">'.'</td>';
            $html .= '<td style="text-align:left; width:90px; border-left: 1px solid black;">'.'</td>';
            $html .= '</tr>';
        }

        return $html;
    }

    public function pdf_empty_row()
    {
        $html = '';
        $html .= '<tr>';
        $html .= '<td style="text-align:left; width:140px; border-left: 1px solid black;"></td>';
        $html .= '<td style="text-align:left; width:260px;"></td>';
        $html .= '<td style="text-align:right; width:80; border-left: 1px solid black;"></td>';
        $html .= '<td style="text-align:left; width:100; border-left: 1px solid black;"></td>';
        $html .= '<td style="text-align:right; width:90px; border-left: 1px solid black;"></td>';
        $html .= '</tr>';
        return $html;
    }

    public function pdf_totalamount_row($label_totalamount, $totalamount)
    {
        $html = '';
        $html .= '<table style="margin:0px; padding:0px 2px 1px 3px; width:100%; border:1px solid #000000;">';
        $html .= '<tr>';
        $html .= '<td colspan="4" style="text-align:right; width:580px; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 140%">';
        $html .= $label_totalamount.'</td>';
        $html .= '<td style="text-align:right; width:90px; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 140%">'.number_format($totalamount, 2, '.', ',').'</td>';
        $html .= '</tr>';
        $html .= '</table>';

        return $html;
    }

    public function pdf_remarks($terms)
    {
        $html = '';
        $html .= '<table>';
        $html .= '<tr><td style="width:150">Remarks:</td><td colspan="6" style="width:520"></td></tr>';
        foreach($terms as $key=>$term){
            $html .= '<tr><td style="width:15">'.($key+1).'.</td><td colspan="6" style="width:650">'.$term.'</td></tr>';
        }
        $html .= '<tr><td style="width:15"></td><td colspan="6" style="width:650"></td></tr>';
        $html .= '</table>';


        PDF::SetFont('droidsansfallbackhk', '', 8);
        PDF::WriteHTML($html);
    }


    public function pdf_contactus($contact_name,$contact_phone_display)
    {
        $html = '';
        $html .= '<table>';
        $html .= '<tr><td style="text-align:center">Please feel free to contact '.$contact_name.' at '.$contact_phone_display.' for further assistance.</td></tr>';
        $html .= '</table>';

        PDF::SetFont('droidsansfallbackhk', '', 12);
        PDF::WriteHTML($html);
    }


    public function pdf_output($filename)
    {
        $pdf_filefullname = $filename.'.pdf';
        PDF::Output($pdf_filefullname);
    }

    public function simple_pdf()
    {
        $html = '<h1>ABCDE</h1>';
        PDF::SetTitle('hihi');
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output('hello_world.pdf');
    }

    public function generatepdf()
    {
        $html = '<h1>Hello world</h1>';
        $pdf = new TCPDF();
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('hello_world.pdf');
    }

}