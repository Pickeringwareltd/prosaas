<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Staff;
use App\Contact;
use App\File;
use App\Location;
use App\Information;
use App\InformationGroup;

class SearchController extends Controller
{
	public function information(Request $request){

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
				$info = Information::withAllTags($tags)->where('get_information_type', 'App\InformationGroup')->get();
			} else {
				$info = Information::where('get_information_type', 'App\InformationGroup')->get();
			}

 			// If there are some staff to show, filter by search field
			if($info){

				foreach ($info as $member) {
    
					$name_lower = strtolower($member->title);
					$search_lower = $search_field;

					// Must compare the lowercase version of the name and the search terms
					if($search_field != ''){
						$search_lower = strtolower($search_lower);
					}

					// If there is a match on the tags and the search criteria, return that contact member
					if(strpos($name_lower, $search_lower) !== false || $search_lower == ''){
						$groupID = $member->get_information_id;

						$group = InformationGroup::find($groupID);
						$group_colour = $group->color;

						$output.= '<div class="info_item pb-4">
	                                  <div class="info_title_box">
	                                    <i class="'. $member->icon .' info_icon" style="display: inline-block; color: '. $group_colour .';"></i>
	                                    <p class="info_title"><b>'. $member->title .'</b></p>
	                                  </div>
	                                  <div class="info_data_box">';

	                                  if($member->encrypted){
	                                  	$output.='<p class="in_vault">VAULT</p>';
	                                  } else {
	                                  	$output.= $member->data;
	                                  }
	                                    
							$output.='</div>
	                                </div>';
					}
				}
 
 				return Response($output);
			} else {
				return Response('');
			}
		}

	}

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

	public function contacts(Request $request){

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
				$contacts = Contact::withAllTags($tags)->get();
			} else {
				$contacts = Contact::all();
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
		                                 <img class="is-rounded" src="/storage/images/'. $member->company_logo .'">
		                               </div>
		                               <div class="contact_data">
		                                 <p class="contact_name">' . $member->name . '</p>
		                                 <p class="contact_role">' . $member->sector . '</p>
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

	public function locations(Request $request){

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
				$locations = Location::withAllTags($tags)->get();
			} else {
				$locations = Location::all();
			}
 
 			// If there are some staff to show, filter by search field
			if($locations){

				foreach ($locations as $location) {
    
					$name_lower = strtolower($location->name);
					$search_lower = $search_field;

					// Must compare the lowercase version of the name and the search terms
					if($search_field != ''){
						$search_lower = strtolower($search_lower);
					}

					// If there is a match on the tags and the search criteria, return that contact member
					if(strpos($name_lower, $search_lower) !== false || $search_lower == ''){
						$output.= '<div class="row info_box position-relative">
				                        <div class="copy_edit_btns position-absolute">
				                            <i class="fas fa-copy shadow copy_info" style="background-color:'. $location->color .';"></i>
				                        </div>
				                        <div class="col-4">
				                          <div class="map_img new_map" id="map_'. $location->id .'" data-name="map_'. $location->id .'" data-long="'. $location->long .'" data-lat="'. $location->lat .'">
				                          </div> 
				                        </div>
				                        <div class="col-8">
				                          <div class="row">
				                            <div class="col">
				                              <p class="box_title">'. $location->name .'</p>
				                            </div>
				                          </div>
				                          <div class="row pt-5">';

				                          	foreach ($location->get_info as $info) {
				                                $output.='<div class="col-6">
								                              <div class="info_item pb-4">
								                                  <div class="info_title_box">
								                                    <i class="'. $info->icon .' info_icon" style="display: inline-block; color: '. $location->color .';"></i>
								                                    <p class="info_title"><b>'. $info->title .'</b></p>
								                                  </div>
								                                  <div class="info_data_box">';

								                                  if($info->encrypted){
								                                  	$output.='<p class="in_vault">VAULT</p>';
								                                  } else {
								                                  	$output.= $info->data;
								                                  } 	
								                              
								                                 $output.='</div>
								                                </div>
								                            </div>';
				                           	};
				                            

				                $output.= 	'</div>
				                          <div class="row pt-3">
				                            <div class="col">';

				                      		foreach ($location->tags as $tag) {
				                                $output.='<span class="tag search-tag is-medium is-info is-rounded" data-name="'. $tag->name .'" style="background-color: '. $location->color .';">
				                                    <p class="pl-3 pr-3">'. ucfirst($tag->name) .'</p>
				                                  <button class="delete is-small" style="display:none;"></button>
				                                </span>';
				                            };

				                            $output.='</div>
				                          </div>
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

	public function files(Request $request){

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
				$files = File::withAllTags($tags)->get();
			} else {
				$files = File::all();
			}
 
 			// If there are some staff to show, filter by search field
			if($files){

				foreach ($files as $file) {
    
					$name_lower = strtolower($file->name);
					$search_lower = $search_field;

					// Must compare the lowercase version of the name and the search terms
					if($search_field != ''){
						$search_lower = strtolower($search_lower);
					}

					// If there is a match on the tags and the search criteria, return that staff member
					if(strpos($name_lower, $search_lower) !== false || $search_lower == ''){
				                          
				        if($file->type == 'doc'){
				        	$output.= ' <div class="file linked_file position-relative" data-link="'. $file->url .'">
				                        	<div class="file_img position-absolute">
				                        		<img src="/images/doc_grey_square.png">
				                        	</div>
				                    		<div class="file_data position-absolute">
				                        		<p class="file_title">'. $file->name .'</p>
				                        		<p class="file_creator">Jack Pickering</p>
				                    		</div> 
				                  		</div>';
				        } else if($file->type == 'pdf') {
				        	$output.= ' <div class="file linked_file position-relative" data-link="'. $file->url .'">
				                        	<div class="file_img position-absolute">
				                        		<img src="/images/pdf_red_square.png">
				                        	</div>
				                    		<div class="file_data position-absolute">
				                        		<p class="file_title">'. $file->name .'</p>
				                        		<p class="file_creator">Jack Pickering</p>
				                    		</div> 
				                  		</div>';
				        } else if($file->type == 'exe') {
				        	$output.= ' <div class="file linked_file position-relative" data-link="'. $file->url .'">
				                        	<div class="file_img position-absolute">
				                        		<img src="/images/exe_blue_square.png">
				                        	</div>
				                    		<div class="file_data position-absolute">
				                        		<p class="file_title">'. $file->name .'</p>
				                        		<p class="file_creator">Jack Pickering</p>
				                    		</div> 
				                  		</div>';
				        } else if($file->type == 'img') {
				         	$output.= ' <div class="file linked_file position-relative" data-link="'. $file->url .'">
				                        	<div class="file_img position-absolute">
				                        		<img src="/images/img_green_square.png">
				                        	</div>
				                    		<div class="file_data position-absolute">
				                        		<p class="file_title">'. $file->name .'</p>
				                        		<p class="file_creator">Jack Pickering</p>
				                    		</div> 
				                  		</div>';
				        } else if($file->type == 'ppt') {
				         	$output.= ' <div class="file linked_file position-relative" data-link="'. $file->url .'">
				                        	<div class="file_img position-absolute">
				                        		<img src="/images/ppt_purple_square.png">
				                        	</div>
				                    		<div class="file_data position-absolute">
				                        		<p class="file_title">'. $file->name .'</p>
				                        		<p class="file_creator">Jack Pickering</p>
				                    		</div> 
				                  		</div>';
				        	
				        } else {
				        	$output.= ' <div class="file linked_file position-relative" data-link="'. $file->url .'">
				                        	<div class="file_img position-absolute">
				                        		<img src="/images/unknown_orange_square.png">
				                        	</div>
				                    		<div class="file_data position-absolute">
				                        		<p class="file_title">'. $file->name .'</p>
				                        		<p class="file_creator">Jack Pickering</p>
				                    		</div> 
				                  		</div>';
				        }
				                           
					}
				};
 
 				return Response($output);
			} else {
				return Response('');
			}
		}
	}

}
