<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CompanyInfoItem;

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
        return view('company_staff');
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