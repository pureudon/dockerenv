<?php

namespace App\Transformers;

use Carbon\Carbon;
use DateTime;
use League\Fractal\TransformerAbstract;

use App\Models\Company;

class CompanyTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Company $company)
    {
        include 'db_mapping.php';

        // action
        $view_html = '<a href="'.route('company.show', ['id' => $company->$db_company_id]).'" >View' . '</a>';
        $edit_html = '<a href="'.route('company.edit', ['id' => $company->$db_company_id]).'" >Edit' . '</a>';
        $duplicate_html = '<a href="'.route('company.duplicate', ['id' => $company->$db_company_id]).'" >Duplicate' . '</a>';
        $action_html = $view_html;
        $action_html .= ' '.$edit_html;
        $action_html .= ' '.$duplicate_html;
        // $action_html = '';

        // company name
        if ($company->$db_company_fontcolor=='Red'){
            $name_css = 'RedColor';
        }
        elseif ($company->$db_company_fontcolor=='LimeGreen'){
            $name_css = 'LimeGreenColor';
        }
        elseif ($company->$db_company_fontcolor=='SpringGreen'){
            $name_css = 'SpringGreenColor';
        }
        elseif ($company->$db_company_fontcolor=='DodgerBlue'){
            $name_css = 'DodgerBlueColor';
        }
        elseif ($company->$db_company_fontcolor=='DeepSkyBlue'){
            $name_css = 'DeepSkyBlueColor';
        }
        elseif ($company->$db_company_fontcolor=='RoyalBlue'){
            $name_css = 'RoyalBlueColor';
        }
        elseif ($company->$db_company_fontcolor=='SlateBlue'){
            $name_css = 'SlateBlueColor';
        }
        elseif ($company->$db_company_fontcolor=='LightBlue'){
            $name_css = 'LightBlueColor';
        }
        elseif ($company->$db_company_fontcolor=='Aqua'){
            $name_css = 'AquaColor';
        }
        elseif ($company->$db_company_fontcolor=='DarkViolet'){
            $name_css = 'DarkVioletColor';
        }
        else{
            $name_css = '';
        }
        $name_html = '<span class="'.$name_css.'">'.$company->$db_company_name.'</span>';

        return [
            $db_company_id      => (string) $company->$db_company_id,
            $db_company_ref      => (string) $company->$db_company_ref,
            $db_company_printcode       => (string) $company->$db_company_printcode,
            $db_company_category       => (string) $company->$db_company_category,
            $db_company_name       => (string) $name_html,
            $db_company_ref       => (string) $company->$db_company_ref,
            'action'       => (string) $action_html,

            $db_company_myobname       => (string) $company->$db_company_myobname,
            $db_company_ename       => (string) $company->$db_company_ename,
            $db_company_cname       => (string) $company->$db_company_cname,
            $db_company_shortname       => (string) $company->$db_company_shortname,
            $db_company_fontcolor       => (string) $company->$db_company_fontcolor,
            $db_company_bgcolor       => (string) $company->$db_company_bgcolor,

            $db_company_website       => (string) $company->$db_company_website,
            $db_company_br       => (string) $company->$db_company_br,
            $db_company_ci       => (string) $company->$db_company_ci,
            $db_company_address       => (string) $company->$db_company_address,
            $db_company_address2       => (string) $company->$db_company_address2,

            $db_company_contact       => (string) $company->$db_company_contact,
            $db_company_contact_tel       => (string) $company->$db_company_contact_tel,
            $db_company_contact_tel2       => (string) $company->$db_company_contact_tel2,
            $db_company_contact_fax       => (string) $company->$db_company_contact_fax,
            $db_company_contact_email       => (string) $company->$db_company_contact_email,
            
            $db_company_remark       => (string) $company->$db_company_remark,
            $db_company_followup       => (string) $company->$db_company_followup,
            $db_company_followup_name       => (string) $company->$db_company_followup_name,

            $db_company_created_by       => (string) $company->$db_company_created_by,
            $db_company_created_byname       => (string) $company->$db_company_created_byname,
            $db_company_updated_by       => (string) $company->$db_company_updated_by,
            $db_company_updated_byname       => (string) $company->$db_company_updated_byname,
            $db_company_created_at       => (string) $company->$db_company_created_at,
            $db_company_updated_at       => (string) $company->$db_company_updated_at,
        ];
    }

}