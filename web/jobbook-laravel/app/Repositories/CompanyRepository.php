<?php

namespace App\Repositories;

// Facades
use Illuminate\Support\Collection;
use Carbon\Carbon;

// Models
use App\Models\Company;



class CompanyRepository
{

    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }


    public function create()
    {
        include 'db_mapping.php';
        return New Company;
    }

    public function find_by_id($id)
    {
        include 'db_mapping.php';
        $company = $this->company
            ->where($db_company_id, '=', $id)
            ->orderBy($db_company_id,'desc')
            ->first();
        return $company;
    }

    public function find_by_ref($ref)
    {
        include 'db_mapping.php';
        $company = $this->company
            ->where($db_company_ref, '=', $ref)
            ->orderBy($db_company_ref,'desc')
            ->first();
        return $company;
    }

    public function find_by_refs($targetlist)
    {
        include 'db_mapping.php';
        $companys = $this->company
            ->whereIn($db_company_ref, $targetlist)
            ->orderBy($db_company_ref,'asc')
            ->get();
        return $companys;
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
        
        $latest_company = Company::where($db_company_ref, 'LIKE', $crkeywords)->orderBy($db_company_ref, 'desc')->take(1)->get()->first();

        if ($latest_company) {
            $cr_lastest_number = substr($latest_company->$db_company_ref, 3, 6); // CRxxxxxx >>xxxxxx
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

    public function groupchangefontcolor_core($companys,$db_company_fontcolor,$newfontcolor)
    {
        // return 'hi group change fontcolor';

        include "db_mapping.php";

        if (count($companys) > 0){
            $groupchangetimestamp = Carbon::now()->toDateTimeString();
            $newfontcolor = $newfontcolor;
            foreach($companys as $company){
                $company->$db_company_updated_at = $groupchangetimestamp;
                $company->$db_company_fontcolor = $newfontcolor;

                $company->timestamps = false;
                $company->save();
            }
        }

        return $companys;
    }
}
