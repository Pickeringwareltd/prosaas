<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CompanyInfoItem;
use App\Staff;

class CompanyController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
    	$items = CompanyInfoItem::all();
        return view('company')->with('items', $items);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function showUsersCompanies()
    {
        return view('companies');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function locations()
    {
        return view('company_locations');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function files()
    {
        return view('company_files');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function staff()
    {
        $staff = Staff::orderBy('fullname')->paginate(12);
        return view('company_staff')->with('staff', $staff);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function contacts()
    {
        return view('company_contacts');
    }
}