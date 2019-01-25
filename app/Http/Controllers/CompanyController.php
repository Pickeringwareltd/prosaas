<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\InformationGroup;
use App\Information;
use App\Staff;
use App\Contact;
use App\ContactGroup;
use App\Folder;
use App\File;
use App\Location;
use Spatie\Tags\HasTags;
use DB;

class CompanyController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        $all_staff = Staff::all();
        $number_of_staff = count($all_staff);
        // Get first 4 staff pictures for the side-bar
        $first_four = Staff::take(4)->get();

        $info_groups = InformationGroup::all();

        foreach($info_groups as $group){
            $group->info = $group->get_info;
        }

        return view('company')->with('number_of_staff', $number_of_staff)->with('first_four_staff', $first_four)->with('info_groups', $info_groups);
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
        $all_staff = Staff::all();
        $number_of_staff = count($all_staff);
        // Get first 4 staff pictures for the side-bar
        $first_four = Staff::take(4)->get();

        $locations = Location::all();

        foreach($locations as $location){
            $location->tags = $location->tags()->get();
            $location->info = $location->get_info;
        }

        return view('company_locations')->with('number_of_staff', $number_of_staff)->with('first_four_staff', $first_four)->with('locations', $locations);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function rootFolder()
    {   
        // Get all staff for the count in the side-bar
        $root_folders = Folder::where('parent_id', null)->orderBy('name')->get();
        $root_files = File::where('folder_id', null)->orderBy('name')->get();

        $all_staff = Staff::all();
        $number_of_staff = count($all_staff);
        // Get first 4 staff pictures for the side-bar
        $first_four = Staff::take(4)->get();

        $burger_nav = [];

        return view('company_files')->with('folders', $root_folders)->with('files', $root_files)->with('burger_nav', $burger_nav)->with('number_of_staff', $number_of_staff)->with('first_four_staff', $first_four);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function withinFolder($id)
    {   
        $child_folders = Folder::where('parent_id', $id)->orderBy('name')->get();
        $child_files = File::where('folder_id', $id)->orderBy('name')->get(); 

        $parent_folder = Folder::where('id', $id)->get();

        $all_staff = Staff::all();
        $number_of_staff = count($all_staff);
        // Get first 4 staff pictures for the side-bar
        $first_four = Staff::take(4)->get();

        // Empty global burger nav array and populate with correct folders
        $burger_nav = [];

        // Need to check parent id, if not null, check if tat folder has a parent id, each time pick up the folder name and ID and add to burger nav array, the last one is active
        do {
            $parent_folder = Folder::where('id', $id)->get();

            array_push($burger_nav, $parent_folder[0]);

            $id = $parent_folder[0]->parent_id;
        } while ($id != null);

        $values = array_values($burger_nav);
        $rv = array_reverse($values);

        return view('company_files')->with('folders', $child_folders)->with('files', $child_files)->with('burger_nav', $rv)->with('number_of_staff', $number_of_staff)->with('first_four_staff', $first_four);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function staff()
    {
        // Get all staff for the count in the side-bar
        $all_staff = Staff::all();
        $number_of_staff = count($all_staff);

        // Get first 4 staff pictures for the side-bar
        $first_four = Staff::take(4)->get();

        // Get staff alphabetically, with 12 per page for main table
        $staff = Staff::orderBy('fullname')->paginate(12);

        // Get all tags relating to the staff members
        $tags = $this->getStaffTags();

        return view('company_staff')->with('staff', $staff)->with('number_of_staff', $number_of_staff)->with('first_four_staff', $first_four)->with('tags', $tags);
    }

    protected function getStaffTags(){
        $tagIds = \DB::table('taggables')
           ->distinct()
           ->select('tag_id')
           ->where('taggable_type', Staff::class)
           ->get()
           ->pluck('tag_id');

        $returned_tags = \Spatie\Tags\Tag::whereIn('id', $tagIds)->get(['name']);

        $tags = [];

        for($i = 0; $i < $returned_tags->count() ; $i++){
            $tags[$i] = $returned_tags[$i]->name;
        }

        return $tags;
    }
    
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function contacts()
    {
        // Get all staff for the count in the side-bar
        $all_staff = Staff::all();
        $number_of_staff = count($all_staff);

        // Get first 4 staff pictures for the side-bar
        $first_four = Staff::take(4)->get();

        // Get all tags relating to the staff members
        $tags = $this->getContactTags();

        $groups = ContactGroup::all();
        $contacts = Contact::where('group_id', 1)->get();

        foreach($groups as $group){
           $contacts = Contact::where('group_id', $group->id)->get(); 
           $group->contacts = $contacts;
        }

        return view('company_contacts')->with('number_of_staff', $number_of_staff)->with('first_four_staff', $first_four)->with('tags', $tags)->with('groups', $groups);
    }

    protected function getContactTags(){
        $tagIds = \DB::table('taggables')
           ->distinct()
           ->select('tag_id')
           ->where('taggable_type', Contact::class)
           ->get()
           ->pluck('tag_id');

        $returned_tags = \Spatie\Tags\Tag::whereIn('id', $tagIds)->get(['name']);

        $tags = [];

        for($i = 0; $i < $returned_tags->count() ; $i++){
            $tags[$i] = $returned_tags[$i]->name;
        }

        return $tags;
    }
}