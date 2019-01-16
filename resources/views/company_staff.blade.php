@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/bulma-calendar.min.css" rel="stylesheet">
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
                  <ul id="nav_list">
                    <li class="nav_item" data-link="">Information</li>
                    <li class="nav_item" data-link="/locations">Locations</li>
                    <li class="nav_item" data-link="/files">Files</li>
                    <li class="nav_item active" data-link="/staff">Staff</li>
                    <li class="nav_item" data-link="/contacts">Contacts</li>
                  </ul>
                </div>
                <div class="row pl-5">
                  <div class="col-9 p-5">

                      <span class="tag is-medium is-info is-rounded add_information shadow" style="background-color: #3F50B1;">
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
                            
                            <div class="copy_edit_btns position-absolute">
                                <i class="fas fa-plus shadow copy_info" style="background-color: #3F50B1;"></i>
                            </div>
                        </div>
                        
                        <div class="row pl-5">
                            <div class="staff_member" data-id="1">
                              <div class="staff_img">
                                <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                              </div>
                              <div class="staff_data">
                                <p class="staff_name">Jack Pickering</p>
                                <p class="staff_role">Developer</p>
                              </div>
                            </div> 
                            <div class="staff_member" data-id="2">
                              <div class="staff_img">
                                <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                              </div>
                              <div class="staff_data">
                                <p class="staff_name">Susan Boyle</p>
                                <p class="staff_role">CEO</p>
                              </div>
                            </div>
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
                            <figure class="image card-image staff_picture first_picture" style="z-index: 3; position: relative; right: 0px;">
                                <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                            </figure>
                            <figure class="image card-image staff_picture" style="z-index: 2; position: relative; right: 25px;">
                                <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                            </figure>
                          </div>
                          <div class="row">
                            <p class="people_work_here"><b class="no_of_staff">TWO</b> people work here</p>
                          </div>
                        </div>
                      </div>
                      <div class="search">
                          <input type="text" placeholder="Search staff" id="search"> 
                      </div>
                      <div class="tags">
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="Office" style="background-color: #3F50B1;">
                            <p class="pl-3 pr-3">Office</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="Store" style="background-color: #D93563">
                            <p class="pl-3 pr-3">Store</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="Factory" style="background-color: #6A6A6A">
                            <p class="pl-3 pr-3">Factory</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
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
    <script src="/js/bulma-calendar.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    <script src="/js/inner_navbar.js"></script>
    <script src="/js/staff_links.js"></script>
    <script src="/js/search_staff.js"></script>
@endsection