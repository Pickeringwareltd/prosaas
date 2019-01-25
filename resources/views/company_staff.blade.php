@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/company_single.css" rel="stylesheet">
    <link href="/css/company_staff.css" rel="stylesheet">
    <link href="/css/processes.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('pageTitle', 'Techquity')

@section('content')
<div class="wrapper">

    <!-- Page Content -->
    <div id="content">
        <home :user="user" inline-template id="staff_template">
          <div class="single_element">
            <div class="container-fluid">
                <div class="row pl-3">
                  <div class="col-9">
                    <ul id="nav_list" class="pb-3">
                      <li class="nav_item" data-link="">Information</li>
                      <li class="nav_item" data-link="/locations">Locations</li>
                      <li class="nav_item" data-link="/files">Files</li>
                      <li class="nav_item active" data-link="/staff">Staff</li>
                      <li class="nav_item" data-link="/contacts">Contacts</li>
                    </ul>
                    <hr />
                  </div>
                </div>
                <div class="row pl-5">
                  <div class="col-9 p-5">

                      <span class="tag is-medium is-info is-rounded add_information shadow add_staff" style="background-color: #3F50B1;">
                        <p class="pl-3 pr-3">Add staff</p>
                        <i class="fas fa-plus"></i>
                      </span>
                      <div class="row">
                         <p class="process_title">Processes</p>
                      </div>
                      <div class="row pt-4 pb-5">
                         <div class="processes">
                            <div class="process">
                              <div class="process_img">
                                <img class="is-rounded" src="/storage/images/process_1.png">
                              </div>
                              <p class="process_name">Onboard staff</p>
                            </div>
                            <div class="process">
                              <div class="process_img">
                                <img class="is-rounded" src="/storage/images/process_2.png">
                              </div>
                              <p class="process_name">File PAYE taxes</p>
                            </div>
                            <div class="process">
                              <div class="process_img">
                                <img class="is-rounded" src="/storage/images/process_3.png">
                              </div>
                              <p class="process_name">Assess progress</p>
                            </div>
                            <div class="process">
                              <div class="process_img">
                                <img class="is-rounded" src="/images/add_new_process.png">
                              </div>
                              <p class="process_name">Add new process</p>
                            </div>
                          </div>
                        </div>


                      <div class="info_box">

                        <div class="row info_title_row pb-5 position-relative">
                            <p class="box_title">Staff</p>

                            <div class="box_image position-absolute">
                              <img src="/images/s_blue_square.png">
                            </div>
                            
                            <div class="copy_edit_btns position-absolute add_staff">
                                <i class="fas fa-plus shadow copy_info" style="background-color: #3F50B1;"></i>
                            </div>
                        </div>
                        
                        <div class="row pl-5">

                            @foreach ($staff as $member)
                                <div class="col-3 staff_member" data-id="{{ $member->id }}">
                                  <div class="staff_img">
                                    <img class="is-rounded" src="/storage/images/{{ $member->profile_picture }}">
                                  </div>
                                  <div class="staff_data">
                                    <p class="staff_name">{{ $member->fullname }}</p>
                                    <p class="staff_role">{{ $member->role }}</p>
                                  </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="row pt-5 justify-content-center">
                          {{ $staff->links() }}
                        </div>

                      </div>
                  </div>
                  <div class="col-3 p-5 sidebar">
                      <div class="company_logo">
                          <img src="/images/techquity_logo.png">
                      </div>
                      <div class="company_people">
                        <div class="staff_pictures">
                          <div class="row">
                            @for ($i = 0; $i < 4; $i++)
                                <figure class="image card-image staff_picture" style="z-index: {{ 5 - $i }}; position: relative; right: {{ $i * 25 }}px;">
                                    <img class="image is-rounded" src="/storage/images/{{ $first_four_staff[$i]->profile_picture }}">
                                </figure>
                            @endfor
                          </div>
                          <div class="row">
                            <p class="people_work_here"><b id="no_of_staff" data-num="{{ $number_of_staff }}">-</b> people work here</p>
                          </div>
                        </div>
                      </div>
                      <div class="search">
                          <input type="text" placeholder="Search staff" id="search"> 
                      </div>
                      <div class="tags">
                        @foreach ($tags as $tag)
                          @php
                              // colours for tags
                              $colours = array("#3F50B1", "#35D9CC","#D93563");
                               
                              // get random index from array $arrX
                              $randIndex = array_rand($colours);
                          @endphp
                            <span class="tag search-tag is-medium is-info is-rounded" data-name="{{ $tag }}" style="background-color: {{ $colours[$randIndex] }}">
                                <p class="pl-3 pr-3">{{ $tag }}</p>
                              <button class="delete is-small" style="display:none;"></button>
                            </span>
                        @endforeach
                      </div>
                      <div id="search_results"> 
                      </div>
                  </div>
                </div>
            </div>
          </div>
        </home>

    </div>
</div>

@endsection

@section('javascripts')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    <script src="/js/inner_navbar.js"></script>
    <script src="/js/staff_links.js"></script>
    <script src="/js/search_staff.js"></script>
    <script src="/js/sidebar_staff.js"></script>
@endsection