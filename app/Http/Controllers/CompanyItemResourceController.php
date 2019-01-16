<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CompanyInfoItem;
use DB;

class CompanyItemResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $returned_tags = DB::table('tags')->get();

        $tags = [];

        for($i = 0; $i < $returned_tags->count() ; $i++){
            $tags[$i] = $returned_tags[$i]->name;
        }

        $data = [
            'tags'   => $tags
        ];

        return view('create_company_item')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $this->validate($request, [
            'itemName' => 'required|max:125'
        ]);

        $item_name = $request->input('itemName', 'Some info');
        $item_type = $request->input('itemType', 'Text');
        $encrypted = $request->input('encrypted', false);
        $tags = $request->input('tags');

        if($item_type == 'Text'){
            $text_val = $request->input('itemText', 'Some text');
            $image_path = '';
            $doc_path = '';
        } else if($item_type == 'Image'){
            $text_val = '';
            $doc_path = '';

            if($request->hasFile('itemImage') && $request->file('itemImage')->isValid()){
                $item_image = $request->file('itemImage');
                $image_path = $request->itemImage->store('storage/uploads', 'public');
            }
        } else{
            $text_val = '';
            $image_path = '';

            if($request->hasFile('itemDoc') && $request->file('itemDoc')->isValid()){
                $item_doc = $request->file('itemDoc');
                $doc_path = $request->itemDoc->store('storage/uploads', 'public');
            }
        }

        if($encrypted == 'on' || $encrypted == 'true'){
            $encrypted = 1;
        } else {
            $encrypted = 0;
        }

        $info = new CompanyInfoItem();

        $info->name= $item_name;
        $info->type= $item_type;
        
        $info->text_value = $text_val;
        $info->image_path = $image_path;
        $info->file_path = $doc_path;

        $info->encrypted = $encrypted;

        $info->tags = $tags; //tags will be created if they don't exist

        $info->save();

        return redirect('/staff/1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = CompanyInfoItem::withAllTags(['Personal', 'Text']);
        return view('staff_profile')->with('items', $items);
    }

    /**
     * Add tags to multiple items
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function groupAddTags(Request $request)
    {
        $data = $request->all();

        $items = $request->input('items', '');
        $tags = $request->input('tags', '');

        // Iterate through items array and find in DB
        // Add the tags to that item
        for($i = 0; $i < count($items) ; $i++){
            $item_id = $items[$i];
            $item = CompanyInfoItem::find($item_id);
            $item->attachTags($tags);
            $item->save();
        }

        return response()->json(['success' => true, 'item' => $item, 'tags' => $item->tags]);
    }

    /**
     * Change the password of an encrypted item
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $data = $request->all();

        $item_id = $request->input('item', '');
        $cipher_text = $request->input('cipher_text', '');

        $item = CompanyInfoItem::find($item_id);
        $item->text_value = $cipher_text;
        $item->save();

        return response()->json(['success' => true, 'item' => $item]);
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
