<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Staff;
use App\CompanyInfoItem;
use Spatie\Tags\HasTags;
use DB;

class StaffResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();
        return view('staff')->with('staff', $staff);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_staff');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'staffName' => 'required|max:125',
            'staffRole' => 'required|max:125'
        ]);

        $staff_name = $request->input('staffName', 'John Smith');
        $staff_role = $request->input('staffRole', 'Not given');
        $logo_path = '';

        if($request->hasFile('staffLogo') && $request->file('staffLogo')->isValid()){
            $process_logo = $request->file('staffLogo');
            $logo_path = $request->staffLogo->store('storage/uploads', 'public');
        }

        $staff = new Staff();

        $staff->fullname= $staff_name;
        $staff->role= $staff_role;
        $staff->profile_picture = $logo_path;

        $staff->save();

        return redirect('/staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::find($id);
        $staff->info = $staff->get_info;

        return view('company_staff_profile')->with('profile', $staff);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function files($id)
    {
        $staff = Staff::find($id);
        return view('company_staff_profile_files')->with('profile', $staff);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::find($id);

        $staff->attachTag('PR');

        $staff->save();

        return redirect('/company/staff');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
