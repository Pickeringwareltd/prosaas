<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Process;

class ProcessResourceController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('subscribed');

        // $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::all();

        return view('process')->with('processes',  $processes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_process');
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
            'processTitle' => 'required|max:125',
            'processDescription' => 'required|max:500'
        ]);

        $process_title = $request->input('processTitle', 'My new process');
        $process_description = $request->input('processDescription', 'Describing my new process');
        $add_to_community = $request->input('addToCommunity', false);
        $logo_path = '';
        
        if($add_to_community == 'on'){
            $add_to_community = true;
        }

        if($request->hasFile('processLogo') && $request->file('processLogo')->isValid()){
            $process_logo = $request->file('processLogo');
            $logo_path = $request->processLogo->store('storage/uploads', 'public');
        }

        $process = new Process();

        $process->title= $process_title;
        $process->description= $process_description;
        $process->community = $add_to_community;

        $process->index= 0;
        $process->number_of_tasks = 0;
        $process->logo = $logo_path;
        $process->datetime = now();

        $process->save();

        return redirect('/process');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $process = Process::find($id);

        $processes = array();

        array_push($processes, $process);

        return view('process')->with('processes',  $processes);
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
        //
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
