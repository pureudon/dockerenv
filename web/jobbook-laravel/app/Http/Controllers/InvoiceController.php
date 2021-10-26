<?php

namespace App\Http\Controllers;

// Facades
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;

// Models
use App\Models\InvoiceColumn;
use App\Models\Invoice;

// Repositories
use App\Repositories\InvoiceRepository;
use App\Repositories\InvoiceColumnRepository;

// Transformers
use App\Transformers\InvoiceTransformer;

// Services
use App\Services\TCPDFSample1Service;
use App\Services\TCPDFSample2Service;
use App\Services\TCPDFSample3Service;
use App\Services\TCPDFSample4Service;

class InvoiceController extends Controller
{
    protected $invoiceRepository;
    protected $invoicecolumnRepository;
    protected $tcpdfsample1Service;
    protected $tcpdfsample2Service;
    protected $tcpdfsample3Service;
    protected $tcpdfsample4Service;

    public function __construct(
        InvoiceRepository $invoiceRepository,
        InvoiceColumnRepository $invoicecolumnRepository,
        TCPDFSample1Service $tcpdfsample1Service,
        TCPDFSample2Service $tcpdfsample2Service,
        TCPDFSample3Service $tcpdfsample3Service,
        TCPDFSample4Service $tcpdfsample4Service
    )
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->invoicecolumnRepository = $invoicecolumnRepository;
        $this->tcpdfsample1Service = $tcpdfsample1Service;
        $this->tcpdfsample2Service = $tcpdfsample2Service;
        $this->tcpdfsample3Service = $tcpdfsample3Service;
        $this->tcpdfsample4Service = $tcpdfsample4Service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "hihi index";

        // $columns = InvoiceColumn::orderBy('id','asc')->get();
        // foreach($columns as $column){
        //     // echo '$'.$column->variablename.' = \''.$column->name.'\';';
        //     // echo '$'.$column->variablename.' => (string) $invoice->$'.$column->variablename.',';
        //     echo 'if ($request->exists($'.$column->variablename.')) { $invoice->$'.$column->variablename.' = $request->input($'.$column->variablename.'); }';

        //     echo '<br>';
        // }
        // die('done.');


        include "db_mapping.php";

        // reorder position ( work around )
        $this->invoicecolumnRepository->reorder_position();

        
        $columns = InvoiceColumn::where($db_column_visibility,true)
            ->orderBy($db_column_position,'asc')
            ->get();
        // dd($columns->pluck($db_column_name));

        // category
        $category_selectlist = $this->invoiceRepository->selectoptions_category('any');

        // fontcolor
        $fontcolor_selectlist = $this->invoiceRepository->selectoptions_fontcolor('any');

        $fullview = '';
        $ajaxsource = route('invoice.data');
        $htmltitle = "Invoice";
        $menu = "invoice";
        $submenu = "invoice";

        // datatables features
        $datatables_colreorder = false;
        $datatables_colvisbutton = false;
        $datatables_columnsearch = false;
        $datatables_checkboxselect = false;
        $datatables_inputsearch = false;
        $datatables_selectsearch = false;
        $datatables_clearfilter = false;
        return view('invoice.home', compact(
            'htmltitle',
            'fullview',
            'ajaxsource',
            'datatables_colreorder',
            'datatables_colvisbutton',
            'datatables_columnsearch',
            'datatables_checkboxselect',
            'datatables_inputsearch',
            'datatables_selectsearch',
            'category_selectlist',
            'fontcolor_selectlist',
            'datatables_clearfilter',
            'columns',
            'menu',
            'submenu'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        include "db_mapping.php";

        // model invoice
        $invoice = $this->invoiceRepository->create();

        // ref
        $invoice->$db_invoice_ref = $this->invoiceRepository->get_next_ref('INV');

        // category
        $category_selectlist = $this->invoiceRepository->selectoptions_category('emptystring');

        // fontcolor
        $fontcolor_selectlist = $this->invoiceRepository->selectoptions_fontcolor('emptystring');

        // printcode
        // $invoice->$db_invoice_printcode = substr($invoice->$db_invoice_ref,-4);

        // followup
        // $invoice->$db_invoice_followup = $this->loginService->get_session_login_id();

        // columns
        $columns = InvoiceColumn::get();
        
        // html page parameter
        $htmltitle = "Invoice # ".$invoice->$db_invoice_id;
        $action = 'create';
        
        return view('invoice.edit', compact(
            'invoice',
            'action',
            'columns',
            'htmltitle',
            'category_selectlist',
            'fontcolor_selectlist'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        include "db_mapping.php";

        $invoice = New Invoice;
        $invoice->save();

        // created_by
        // $invoice->$db_invoice_created_by = $this->loginService->get_session_login_id();
        // updated_by
        // $invoice->$db_invoice_updated_by = $this->loginService->get_session_login_id();

        $invoice = $this->store_or_update_core($invoice,$request);
        $invoice->save();

        return redirect()->route('invoice.show', ['invoice' => $invoice]);
    }

    public function store_or_update_core($invoice, Request $request)
    {
        include "db_mapping.php";
        $invoice = $this->store_or_update_input_core($invoice,$request);
        $invoice = $this->store_or_update_refresh_core($invoice);
        $invoice = $this->refresh_invoice_updated_created_byname($invoice);

        return $invoice;
    }

    public function store_or_update_input_core($invoice, $request)
    {
        include "db_mapping.php";

        $input = $request->all();

        if ($request->exists($db_invoice_name)) { $invoice->$db_invoice_name = $request->input($db_invoice_name); }
        if ($request->exists($db_invoice_category)) { $invoice->$db_invoice_category = $request->input($db_invoice_category); }
        if ($request->exists($db_invoice_type)) { $invoice->$db_invoice_type = $request->input($db_invoice_type); }
        if ($request->exists($db_invoice_ref)) { $invoice->$db_invoice_ref = $request->input($db_invoice_ref); }
        if ($request->exists($db_invoice_fontcolor)) { $invoice->$db_invoice_fontcolor = $request->input($db_invoice_fontcolor); }
        if ($request->exists($db_invoice_companyid)) { $invoice->$db_invoice_companyid = $request->input($db_invoice_companyid); }
        if ($request->exists($db_invoice_companyname1)) { $invoice->$db_invoice_companyname1 = $request->input($db_invoice_companyname1); }
        if ($request->exists($db_invoice_companyname2)) { $invoice->$db_invoice_companyname2 = $request->input($db_invoice_companyname2); }
        if ($request->exists($db_invoice_clientid)) { $invoice->$db_invoice_clientid = $request->input($db_invoice_clientid); }
        if ($request->exists($db_invoice_clientname)) { $invoice->$db_invoice_clientname = $request->input($db_invoice_clientname); }
        if ($request->exists($db_invoice_siteid)) { $invoice->$db_invoice_siteid = $request->input($db_invoice_siteid); }
        if ($request->exists($db_invoice_sitename)) { $invoice->$db_invoice_sitename = $request->input($db_invoice_sitename); }
        if ($request->exists($db_invoice_addr1)) { $invoice->$db_invoice_addr1 = $request->input($db_invoice_addr1); }
        if ($request->exists($db_invoice_addr2)) { $invoice->$db_invoice_addr2 = $request->input($db_invoice_addr2); }
        if ($request->exists($db_invoice_addr3)) { $invoice->$db_invoice_addr3 = $request->input($db_invoice_addr3); }
        if ($request->exists($db_invoice_attn)) { $invoice->$db_invoice_attn = $request->input($db_invoice_attn); }
        if ($request->exists($db_invoice_dept)) { $invoice->$db_invoice_dept = $request->input($db_invoice_dept); }
        if ($request->exists($db_invoice_contactperson)) { $invoice->$db_invoice_contactperson = $request->input($db_invoice_contactperson); }
        if ($request->exists($db_invoice_tel)) { $invoice->$db_invoice_tel = $request->input($db_invoice_tel); }
        if ($request->exists($db_invoice_fax)) { $invoice->$db_invoice_fax = $request->input($db_invoice_fax); }
        if ($request->exists($db_invoice_email)) { $invoice->$db_invoice_email = $request->input($db_invoice_email); }
        if ($request->exists($db_invoice_quot)) { $invoice->$db_invoice_quot = $request->input($db_invoice_quot); }
        if ($request->exists($db_invoice_po)) { $invoice->$db_invoice_po = $request->input($db_invoice_po); }
        if ($request->exists($db_invoice_totalamount)) { $invoice->$db_invoice_totalamount = $request->input($db_invoice_totalamount); }
        if ($request->exists($db_invoice_created_by)) { $invoice->$db_invoice_created_by = $request->input($db_invoice_created_by); }
        if ($request->exists($db_invoice_created_byname)) { $invoice->$db_invoice_created_byname = $request->input($db_invoice_created_byname); }
        if ($request->exists($db_invoice_updated_by)) { $invoice->$db_invoice_updated_by = $request->input($db_invoice_updated_by); }
        if ($request->exists($db_invoice_updated_byname)) { $invoice->$db_invoice_updated_byname = $request->input($db_invoice_updated_byname); }


        return $invoice;
    }

    public function store_or_update_refresh_core($invoice)
    {
        include "db_mapping.php";

        // editwoner
        // $user = $this->userRepository->find_by_id($invoice->$db_invoice_followup);
        // $user = ( $user ) ? $user : $this->userRepository->create();
        // $invoice->$db_invoice_followup_name = $user->$db_user_loginid;

        return $invoice;
    }

    public function refresh_invoice_updated_created_byname($invoice)
    {
        include "db_mapping.php";

        // created_byname
        // $user = $this->userRepository->find_by_id($invoice->$db_invoice_created_by);
        // $user = ( $user ) ? $user : $this->userRepository->create();
        // $invoice->$db_invoice_created_byname = $user->$db_user_loginid;

        // updated_byname
        // $user = $this->userRepository->find_by_id($invoice->$db_invoice_updated_by);
        // $user = ( $user ) ? $user : $this->userRepository->create();
        // $invoice->$db_invoice_updated_byname = $user->$db_user_loginid;

        return $invoice;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        // return "hihi show";

        $db_invoice_id = 'id';

        $invoice = Invoice::where($db_invoice_id,$invoice->$db_invoice_id)->firstOrFail();
        // dd($invoice);


        $db_column_visibility = 'visibility';
        $db_column_position = 'position';

        $columns = InvoiceColumn::
            where($db_column_visibility,true)
            ->orderBy($db_column_position,'asc')
            ->get();
        // dd($columns);

        $db_invoice_ref = 'ref';
        $htmltitle = $invoice->$db_invoice_ref;

        return view('invoice.show', compact(
            'invoice',
            'columns',
            'htmltitle'
        ));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        include "db_mapping.php";

        $invoice = Invoice::where($db_invoice_id,$invoice->$db_invoice_id)->firstOrFail();
        
        
        // category
        $category_selectlist = $this->invoiceRepository->selectoptions_category('emptystring');

        // fontcolor
        $fontcolor_selectlist = $this->invoiceRepository->selectoptions_fontcolor('emptystring');

        $columns = InvoiceColumn::get();
        // dd($columns);

        $htmltitle = $invoice->$db_invoice_ref;
        $action = 'edit';
        return view('invoice.edit', compact(
            'invoice',
            'action',
            'columns',
            'category_selectlist',
            'fontcolor_selectlist',
            'htmltitle'
        ));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        // return 'hi update';

        include "db_mapping.php";

        // dd($request);
        $input = $request->all();

        $invoice = Invoice::findOrFail($invoice->$db_invoice_id);

        // updated_by
        // $invoice->$db_invoice_updated_by = $this->loginService->get_session_login_id();

        $invoice = $this->store_or_update_core($invoice,$request);
        $invoice->save();

        return redirect()->route('invoice.show', ['invoice' => $invoice]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        // return 'hi destroy';

        $db_invoice_id = 'id';
        $invoice = Invoice::where($db_invoice_id,$invoice->$db_invoice_id)->firstOrFail();
        // dd($invoice);

        if( $invoice ){
            $invoice->delete();
        }

        // return 'Delete Done.';
        return redirect()->route('invoice.index');
    }

    public function data(Request $request)
    {
        $invoices = Invoice::query();
        return Datatables::of($invoices)
            ->setTransformer(new InvoiceTransformer)
            ->make(true);
    }

    public function duplicate($id)
    {
        include "db_mapping.php";

        // model invoice
        $invoice = $this->invoiceRepository->find_by_id($id);

        // ref
        $invoice->$db_invoice_ref = $this->invoiceRepository->get_next_ref('INV');

        // category
        $category_selectlist = $this->invoiceRepository->selectoptions_category('emptystring');

        // fontcolor
        $fontcolor_selectlist = $this->invoiceRepository->selectoptions_fontcolor('emptystring');

        // printcode
        // $invoice->$db_invoice_printcode = substr($invoice->$db_invoice_ref,-4);

        // followup
        // $invoice->$db_invoice_followup = $this->loginService->get_session_login_id();

        // remark
        // $invoice->$db_invoice_remark = null;
        
        // columns
        $columns = InvoiceColumn::get();

        // html form parameter
        $htmltitle = "invoice # ";
        $action = 'duplicate';        

        return view('invoice.edit', compact(
            'htmltitle',
            'invoice',
            'columns',
            'action',
            'fontcolor_selectlist',
            'category_selectlist'
        ));
    }

    // TCPDF 

    public function pdf($id)
    {
        // $this->tcpdfsample1Service->generatepdf();
        $this->tcpdfsample1Service->generate_sample1_pdf($id=1, $letterhead=true, $signature=true, $letterfooter=true);
    }

    public function pdf2($id)
    {
        // $this->tcpdfsample2Service->simple_pdf();
        $this->tcpdfsample2Service->generatejobpdf($id,$letterhead=false,$location='I');
    }

    public function pdf3($id)
    {
        $this->tcpdfsample3Service->generatejobpdf($id,$letterhead=false,$location='I');
    }

    public function pdf4($id)
    {
        $this->tcpdfsample4Service->generatejobpdf($id,$letterhead=false,$location='I');
    }
    
}
