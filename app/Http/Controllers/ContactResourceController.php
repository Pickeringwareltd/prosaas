<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;

class ContactResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $clients = Client::all();
        // return view('client')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('create_client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'clientName' => 'required|max:125',
        //     'clientType' => 'required|max:125'
        // ]);

        // $client_name = $request->input('clientName', 'John Smith');
        // $client_type = $request->input('clientType', 'Not given');
        // $logo_path = '';

        // if($request->hasFile('clientLogo') && $request->file('clientLogo')->isValid()){
        //     $process_logo = $request->file('clientLogo');
        //     $logo_path = $request->clientLogo->store('storage/uploads', 'public');
        // }

        // $client = new Client();

        // $client->name= $client_name;
        // $client->type= $client_type;
        // $client->company_logo = $logo_path;

        // $client->save();

        // return redirect('/c');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);

        return view('company_contact_profile')->with('contact', $contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function files($id)
    {
        $contact = Contact::find($id);
        return view('company_contact_profile_files')->with('contact', $contact);
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

        $contact = Contact::find($id);

        $contact->attachTag('Warehouse');

        $contact->save();

        return redirect('/company/contacts');
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
