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
        $items = CompanyInfoItem::all();
        $returned_tags = DB::table('tags')->get();

        $tags = [];

        for($i = 0; $i < $returned_tags->count() ; $i++){
            $tags[$i] = $returned_tags[$i]->name;
        }

        $data = [
            'items'  => $items,
            'tags'   => $tags
        ];

        return view('company_staff_profile')->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function files($id)
    {
        return view('company_staff_profile_files');
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
        $our_tags = [];

        $tags = $request->tags;

        for($i = 0; $i < count($tags) ; $i++){
            $our_tags[$i] = \Spatie\Tags\Tag::findOrCreate(['name' => $tags[$i]]);
        }

        $staff = Staff::find($id);

        $staff->tags = $our_tags;

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
