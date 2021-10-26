<?php

namespace App\Http\Controllers;

// Facades
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

// Models
use App\Models\Column;
use App\Models\Company;

// Repositories
use App\Repositories\CompanyRepository;
use App\Repositories\ColumnRepository;

// Transformers
use App\Transformers\CompanyTransformer;


class CompanyController extends Controller
{
    protected $companyRepository;
    protected $columnRepository;

    public function __construct(
        CompanyRepository $companyRepository,
        ColumnRepository $columnRepository
    )
    {
        $this->companyRepository = $companyRepository;
        $this->columnRepository = $columnRepository;
    }


    public function index()
    {
        // return "hihi index";

        include "db_mapping.php";

        // reorder position ( work around )
        // $this->columnRepository->reorder_position();

      
        $columns = Column::where($db_column_visibility,true)
            ->orderBy($db_column_position,'asc')
            ->get();
        // dd($columns->pluck($db_column_name));

        // category
        $category_selectlist = $this->companyRepository->selectoptions_category('any');

        // fontcolor
        $fontcolor_selectlist = $this->companyRepository->selectoptions_fontcolor('any');

        $fullview = '';
        $ajaxsource = route('company.data');
        $htmltitle = "Company";
        $menu = "customers";
        $submenu = "company";

        // datatables features
        $datatables_colreorder = false;
        $datatables_colvisbutton = true;
        $datatables_columnsearch = false;
        $datatables_checkboxselect = true;
        $datatables_inputsearch = true;
        $datatables_selectsearch = true;
        $datatables_clearfilter = true;
        return view('company.home', compact(
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

    public function create()
    {
        include "db_mapping.php";

        // model company
        $company = $this->companyRepository->create();

        // ref
        $company->$db_company_ref = $this->companyRepository->get_next_ref();

        // category
        $category_selectlist = $this->companyRepository->selectoptions_category('emptystring');

        // fontcolor
        $fontcolor_selectlist = $this->companyRepository->selectoptions_fontcolor('emptystring');

        // printcode
        $company->$db_company_printcode = substr($company->$db_company_ref,-4);

        // followup
        // $company->$db_company_followup = $this->loginService->get_session_login_id();

        // columns
        $columns = Column::get();
        
        // html page parameter
        $htmltitle = "Company # ".$company->$db_company_id;
        $action = 'create';
        
        return view('company.edit', compact(
            'company',
            'action',
            'columns',
            'htmltitle',
            'category_selectlist',
            'fontcolor_selectlist'
        ));

    }


    public function store(Request $request)
    {
        include "db_mapping.php";

        $company = New Company;
        $company->save();

        // created_by
        // $company->$db_company_created_by = $this->loginService->get_session_login_id();
        // updated_by
        // $company->$db_company_updated_by = $this->loginService->get_session_login_id();

        $company = $this->store_or_update_core($company,$request);
        $company->save();

        return redirect()->route('company.show', ['id' => $company->$db_company_id]);
    }

    public function store_or_update_core($company, Request $request)
    {
        include "db_mapping.php";
        $company = $this->store_or_update_input_core($company,$request);
        $company = $this->store_or_update_refresh_core($company);
        $company = $this->refresh_company_updated_created_byname($company);

        return $company;
    }

    public function refresh_company_updated_created_byname($company)
    {
        include "db_mapping.php";

        // created_byname
        // $user = $this->userRepository->find_by_id($company->$db_company_created_by);
        // $user = ( $user ) ? $user : $this->userRepository->create();
        // $company->$db_company_created_byname = $user->$db_user_loginid;

        // updated_byname
        // $user = $this->userRepository->find_by_id($company->$db_company_updated_by);
        // $user = ( $user ) ? $user : $this->userRepository->create();
        // $company->$db_company_updated_byname = $user->$db_user_loginid;

        return $company;
    }


    public function store_or_update_input_core($company, $request)
    {
        include "db_mapping.php";

        $input = $request->all();

        if ($request->exists($db_company_ref)) { $company->$db_company_ref = $request->input($db_company_ref); }
        if ($request->exists($db_company_printcode)) { $company->$db_company_printcode = $request->input($db_company_printcode); }
        if ($request->exists($db_company_category)) { $company->$db_company_category = $request->input($db_company_category); }

        if ($request->exists($db_company_fontcolor)) { $company->$db_company_fontcolor = $request->input($db_company_fontcolor); }
        if ($request->exists($db_company_bgcolor)) { $company->$db_company_bgcolor = $request->input($db_company_bgcolor); }

        if ($request->exists($db_company_name)) { $company->$db_company_name = $request->input($db_company_name); }
        if ($request->exists($db_company_myobname)) { $company->$db_company_myobname = $request->input($db_company_myobname); }
        if ($request->exists($db_company_ename)) { $company->$db_company_ename = $request->input($db_company_ename); }
        if ($request->exists($db_company_cname)) { $company->$db_company_cname = $request->input($db_company_cname); }

        if ($request->exists($db_company_shortname)) { $company->$db_company_shortname = $request->input($db_company_shortname); }
        if ($request->exists($db_company_website)) { $company->$db_company_website = $request->input($db_company_website); }
        if ($request->exists($db_company_br)) { $company->$db_company_br = $request->input($db_company_br); }
        if ($request->exists($db_company_ci)) { $company->$db_company_ci = $request->input($db_company_ci); }
        if ($request->exists($db_company_address)) { $company->$db_company_address = $request->input($db_company_address); }
        if ($request->exists($db_company_address2)) { $company->$db_company_address2 = $request->input($db_company_address2); }

        if ($request->exists($db_company_contact)) { $company->$db_company_contact = $request->input($db_company_contact); }
        if ($request->exists($db_company_contact_tel)) { $company->$db_company_contact_tel = $request->input($db_company_contact_tel); }
        if ($request->exists($db_company_contact_tel2)) { $company->$db_company_contact_tel2 = $request->input($db_company_contact_tel2); }
        if ($request->exists($db_company_contact_fax)) { $company->$db_company_contact_fax = $request->input($db_company_contact_fax); }
        if ($request->exists($db_company_contact_email)) { $company->$db_company_contact_email = $request->input($db_company_contact_email); }

        if ($request->exists($db_company_remark)) { $company->$db_company_remark = $request->input($db_company_remark); }
        if ($request->exists($db_company_followup)) { $company->$db_company_followup = $request->input($db_company_followup); }

        return $company;
    }

    public function store_or_update_refresh_core($company)
    {
        include "db_mapping.php";

        // editwoner
        // $user = $this->userRepository->find_by_id($company->$db_company_followup);
        // $user = ( $user ) ? $user : $this->userRepository->create();
        // $company->$db_company_followup_name = $user->$db_user_loginid;

        return $company;
    }

    public function show($id)
    {
        // return "hihi show";

        $db_company_id = 'id';

        $company = Company::where($db_company_id,$id)->firstOrFail();
        // dd($company);


        $db_column_visibility = 'visibility';
        $db_column_position = 'position';

        $columns = Column::
            where($db_column_visibility,true)
            ->orderBy($db_column_position,'asc')
            ->get();
        // dd($columns);

        $db_company_ref = 'ref';
        $htmltitle = $company->$db_company_ref;

        return view('company.show', compact(
            'company',
            'columns',
            'htmltitle'
        ));  
    }


    public function edit($id)
    {
        include "db_mapping.php";

        $company = Company::where($db_company_id,$id)->firstOrFail();
        
        
        // category
        $category_selectlist = $this->companyRepository->selectoptions_category('emptystring');

        // fontcolor
        $fontcolor_selectlist = $this->companyRepository->selectoptions_fontcolor('emptystring');

        $columns = Column::get();
        // dd($columns);

        $htmltitle = $company->$db_company_ref;
        $action = 'edit';
        return view('company.edit', compact(
            'company',
            'action',
            'columns',
            'category_selectlist',
            'fontcolor_selectlist',
            'htmltitle'
        ));    
    }


    public function update(Request $request, $id)
    {
        // return 'hi update';

        include "db_mapping.php";

        // dd($request);
        $input = $request->all();

        $company = Company::findOrFail($id);

        // updated_by
        // $company->$db_company_updated_by = $this->loginService->get_session_login_id();

        $company = $this->store_or_update_core($company,$request);
        $company->save();

        return redirect()->route('company.show', [$db_company_id => $company->$db_company_id]);
    }


    public function destroy($id)
    {
        // return 'hi destroy';

        $db_company_id = 'id';
        $company = Company::where($db_company_id,$id)->firstOrFail();
        // dd($company);

        if( $company ){
            $company->delete();
        }

        // return 'Delete Done.';
        return redirect()->route('company.index');
    }

    public function duplicate($id)
    {
        include "db_mapping.php";

        // model company
        $company = $this->companyRepository->find_by_id($id);

        // ref
        $company->$db_company_ref = $this->companyRepository->get_next_ref();

        // category
        $category_selectlist = $this->companyRepository->selectoptions_category('emptystring');

        // fontcolor
        $fontcolor_selectlist = $this->companyRepository->selectoptions_fontcolor('emptystring');

        // printcode
        $company->$db_company_printcode = substr($company->$db_company_ref,-4);

        // followup
        // $company->$db_company_followup = $this->loginService->get_session_login_id();

        // remark
        $company->$db_company_remark = null;
        
        // columns
        $columns = Column::get();

        // html form parameter
        $htmltitle = "company # ";
        $action = 'duplicate';        

        return view('company.edit', compact(
            'htmltitle',
            'company',
            'columns',
            'action',
            'fontcolor_selectlist',
            'category_selectlist'
        ));
    }

    public function data(Request $request)
    {
        $companies = Company::query();
        return Datatables::of($companies)
            ->setTransformer(new CompanyTransformer)
            ->make(true);
    }

    public function groupchangeform(Request $request)
    {
        include "db_mapping.php";

        // return "hi group change form";
        
        $companys = collect();

        // dd($request->$db_company_id);
        if (isset($request->$db_company_id)) {
            $companys = Company::findMany($request->$db_company_id);
        }
        // dd($companys);


        $groupstring = null;
        if ( $companys->count() > 0 ){
            $groupstring = implode(" ",$companys->pluck($db_company_ref)->toArray());
        }
        // dd($groupstring);

        // fontcolor
        $fontcolor_selectlist = $this->companyRepository->selectoptions_fontcolor('emptystring');

        $htmltitle = "Group Change FontColor";
        $pagetitle = "Group Change FontColor";

        return view('company.groupchange.groupchangeform', compact(
            'companys',
            'groupstring',
            'htmltitle',
            'pagetitle',
            'fontcolor_selectlist'
        ));
    }

    public function groupchangefontcolor(Request $request)
    {
        // return 'hi group change fontcolor';

        include "db_mapping.php";

        // dd($request);

        if ($request->exists('groupstring')) {
            $groupstring = $request->input('groupstring'); 
        }

        if ($request->exists($db_company_fontcolor)) {
            $newfontcolor = $request->input($db_company_fontcolor); 
        }
        // dd($newfontcolor);

        $targetlist = explode(' ',$groupstring);
        // dd($targetlist);

        $companys = $this->companyRepository->find_by_refs($targetlist);
        // dd($companys);

        $this->companyRepository->groupchangefontcolor_core($companys,$db_company_fontcolor,$newfontcolor);

        return redirect()->route('company.index');
    }
}
