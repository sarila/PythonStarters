<?php

namespace App\Http\Controllers;

use App\Models\Companyinfo;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    // Company Info
    public function company(){
        Session::put('admin_page', 'company_info');
        $company = Companyinfo::first();
        return view ('admin.setting.company', compact('company'));
    }

    public function companyUpdate(Request $request, $id){
        $data = $request->all();
        $company = Companyinfo::findOrFail($id);
        $company->update($data);
        // $company->address = $data['address'];
        // $company->site_subtitle = $data['site_subtitle'];
        // $company->save();
        Session::flash('success_message', 'Company Info Has Been Updated Successfully');
        return redirect()->back();
    }
}
