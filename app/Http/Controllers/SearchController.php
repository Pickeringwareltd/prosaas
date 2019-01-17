<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\CompanyInfoItem;
use App\Staff;
use App\Client;

class SearchController extends Controller
{
	public function processes(Request $request){
 
 		if($request->ajax()){
 
			$output="";
			$processes=DB::table('processes')->where('title','LIKE','%'.$request->search."%")->get();
 
			if($processes){
 
				foreach ($processes as $key => $process) {

					$output.= '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 card_col">
		                            <a href="/process/'. $process->id .'/tasks">
		                                <div class="card">

		                                    <div class="card-image">
		                                        <figure class="image is-4by3">
		                                            <img src="storage/' . $process->logo .'" alt="Placeholder image">
		                                        </figure>
		                                    </div>

		                                    <div class="card-content">

		                                        <div class="media">
		                                            <div class="media-content">
		                                                <p class="title is-4 card_title">'. $process->title .'</p>
		                                                <p class="subtitle is-6">'. $process->number_of_tasks .' tasks</p>
		                                            </div>
		                                        </div>

		                                        <div class="content">
		                                            <br>
		                                            <p>'. $process->description .'</p>

		                                            <br>
		                                            <time datetime="2016-1-1">'. $process->datetime .'</time>
		                                        </div>
		                                    </div>

		                                </div>
		                            </a>
		                        </div>';
				}

				$output.='<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 new_process card_col">
		                        <a href="/process/create">
		                            <div class="card">

		                                <div class="card-image">
		                                    <figure class="image is-4by3">
		                                        <img src="/images/add_process.png" alt="Placeholder image">
		                                    </figure>
		                                </div>

		                                <div class="card-content">
		                                    <div class="media">
		                                        <div class="media-content">
		                                            <p class="title is-4">Add new process</p>
		                                        </div>
		                                    </div>
		                                </div>

		                            </div>
		                        </a>
		                    </div>';
 
 				return Response($output);
			}
 
 		}

	}

	public function clients(Request $request){

 		if($request->ajax()){
 
			$output="";
			$tags = $request->tags;
			$search_field = $request->search_field;

			// If both are null, return nothing
			if($tags == null && $search_field == null){
				return Response('');
			}

			// If tags have been selected, filter contact out that dont match those tags
			if($tags != ''){
				$contacts = Client::withAllTags($tags)->get();
			} else {
				$contacts = Client::all();
			}
 
 			// If there are some staff to show, filter by search field
			if($contacts){

				foreach ($contacts as $member) {
    
					$name_lower = strtolower($member->name);
					$search_lower = $search_field;

					// Must compare the lowercase version of the name and the search terms
					if($search_field != ''){
						$search_lower = strtolower($search_lower);
					}

					// If there is a match on the tags and the search criteria, return that contact member
					if(strpos($name_lower, $search_lower) !== false || $search_lower == ''){
						$output.= '<div class="contact" data-id="'. $member->id .'">
		                               <div class="contact_img">
		                                 <img class="is-rounded" src="/storage/'. $member->company_logo .'">
		                               </div>
		                               <div class="contact_data">
		                                 <p class="contact_name">' . $member->name . '</p>
		                                 <p class="contact_role">' . $member->type . '</p>
		                               </div>
		                             </div>';
					}
				}
 
 				return Response($output);
			} else {
				return Response('');
			}
		}

	}

	public function staff(Request $request){

 		if($request->ajax()){
 
			$output="";
			$tags = $request->tags;
			$search_field = $request->search_field;

			// If both are null, return nothing
			if($tags == null && $search_field == null){
				return Response('');
			}

			// If tags have been selected, filter staff out that dont match those tags
			if($tags != ''){
				$staff = Staff::withAllTags($tags)->get();
			} else {
				$staff = Staff::all();
			}
 
 			// If there are some staff to show, filter by search field
			if($staff){

				foreach ($staff as $member) {
    
					$name_lower = strtolower($member->fullname);
					$search_lower = $search_field;

					// Must compare the lowercase version of the name and the search terms
					if($search_field != ''){
						$search_lower = strtolower($search_lower);
					}

					// If there is a match on the tags and the search criteria, return that staff member
					if(strpos($name_lower, $search_lower) !== false || $search_lower == ''){
						$output.= '<div class="staff_member" data-id="'. $member->id .'">
		                              <div class="staff_img">
		                                <img class="is-rounded" src="/storage/images/'. $member->profile_picture . '">
		                              </div>
		                              <div class="staff_data">
		                                <p class="staff_name">'. $member->fullname .'</p>
		                                <p class="staff_role">' . $member->role .'</p>
		                              </div>
		                          </div>';
					}
				};
 
 				return Response($output);
			} else {
				return Response('');
			}
		}
	}

	public function companyItems(Request $request){
 
 		if($request->ajax()){
 
			$output="";
			$sent = $request->search;
			$search_field = $request->search_field;
			$selected_tags = $request->selected_tags;

			if($sent != ''){
				$items = CompanyInfoItem::withAllTags($sent)->get();
			} else {
				$items = CompanyInfoItem::all();
			}
 
			if($items){

				foreach ($items as $item) {

					$name_lower = strtolower($item->name);
					$search_lower = $search_field;

					if($search_field != ''){
						$search_lower = strtolower($search_lower);
					}

					if($selected_tags != null){

						foreach($selected_tags as $tag) {
							
							$tag_data = explode(":", $tag);
							$name = $tag_data[0];

							if($name_lower == strtolower($name)){
								$selected = true;
							} else {
								$selected = false;
							}

						}

					}

					$select_box = '<input id="{{ $item->id }}" name="'. $item->id .'" type="checkbox" data-name="'. $item->name .'" data-value="'. $item->text_value .'" class="select_box checkbox__input d-none"/>
                                        <label class="select_box d-none" for="'. $item->id .'"></label>';


					$selected_box = '<input id="{{ $item->id }}" name="'. $item->id .'" type="checkbox" data-name="'. $item->name .'" data-value="'. $item->text_value .'" class="select_box checkbox__input d-none"/>
						<label class="select_box d-none" for="'. $item->id .'"></label>';

					// Must also meet the search field criteria
					if(strpos($name_lower, $search_lower) !== false || $search_lower == ''){

						if($item->encrypted ===  1){
							$output.='<div class="notification data-item is-warning vault_item grid-item grid-item--height3" data-value="'. $item->text_value .'" data-id="'. $item->id . '">
                                      <div class="content">
                                        <p class="title">'. $item->name .'</p>
                                        <input id="{{ $item->id }}" name="'. $item->id .'" type="checkbox" data-name="'. $item->name .'" data-value="'. $item->text_value .'" class="select_box checkbox__input d-none"/>
                                        <label class="select_box d-none" for="'. $item->id .'"></label>
                                        <div class="content">
                                            <p class="locked_icon"><i class="fas fa-lock"></i></p>
                                        </div>
                                      </div>
                                    </div>';
						} else {
							if($item->type == 'Text'){
								$output.='<div class="notification data-item is-info copy_btn grid-item grid-item--height2">
		                                        <p class="title item-title">'. $item->name .'</p>
		                                        <p class="subtitle item-text">'. $item->text_value .'</p>
		                                        <input id="'. $item->id .'" name="'. $item->id .'" type="checkbox" data-name="'. $item->name .'" data-value="'. $item->text_value.'" class="select_box checkbox__input d-none"/>
                                        		<label class="select_box d-none" for="'. $item->id .'"></label>
		                                        
		                                      </div>';
							} else if ($item->type == 'Image'){
								$output.='<div class="notification data-item is-info grid-item">
		                                        <p class="title item-title">'. $item->name . '</p>
		                                        <img class="" src="/storage/'. $item->image_path .'" style="max-width: 50%;"></img>
		                                        
		                                      </div>';
							} else if ($item->type == 'File'){
								$output.='<div class="notification data-item is-info grid-item grid-item--height3">
		                                        <p class="title item-title">'.$item->name .'</p>
		                                        <p class="locked_icon"><i class="fas fa-file-alt"></i></p>
		                                        
		                                      </div>';
							}
						}
					}
				};
 
 				return Response($output);
			}
 
 		}

	}
}
