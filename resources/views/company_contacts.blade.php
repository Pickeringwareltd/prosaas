@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/bulma-calendar.min.css" rel="stylesheet">
    <link href="/css/company_single.css" rel="stylesheet">
    <link href="/css/company_contacts.css" rel="stylesheet">
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
                    <li class="nav_item" data-link="/staff">Staff</li>
                    <li class="nav_item active" data-link="/contacts">Contacts</li>
                  </ul>
                </div>
                <div class="row pl-5">
                  <div class="col-9 p-5">
                    <span class="tag is-medium is-info is-rounded add_information shadow" style="background-color: #3F50B1;">
                      <p class="pl-3 pr-3">Add group</p>
                      <i class="fas fa-plus"></i>
                    </span>
                    <div class="row">
                       <p class="process_title">Processes</p>
                    </div>
                    <div class="row pt-5 pb-5">
                       <div class="processes">
                          <div class="process">
                            <div class="process_img">
                              <img class="is-rounded" src="/storage/images/process_1.png">
                            </div>
                            <p class="process_name">Add contact</p>
                          </div>
                          <div class="process">
                            <div class="process_img">
                              <img class="is-rounded" src="/storage/images/process_2.png">
                            </div>
                            <p class="process_name">Assign product</p>
                          </div>
                          <div class="process">
                            <div class="process_img">
                              <img class="is-rounded" src="/storage/images/process_3.png">
                            </div>
                            <p class="process_name">Assess quota</p>
                          </div>
                          <div class="process">
                            <div class="process_img">
                              <img class="is-rounded" src="/images/add_new_process.png">
                            </div>
                            <p class="process_name">Add new process</p>
                          </div>
                        </div>
                      </div>

                    <div class="row">
                      <div class="info_box">

                        <div class="row info_title_row pb-5 position-relative">
                            <p class="box_title">Clients</p>

                            <div class="box_image position-absolute">
                              <img src="/images/c_red_square.png">
                            </div>
                            
                            <div class="copy_edit_btns position-absolute">
                                <i class="fas fa-plus shadow copy_info" style="background-color: #D93563;"></i>
                            </div>
                        </div>
                        
                        <div class="row pl-5">
                            <div class="contact" data-id="1">
                              <div class="contact_img">
                                <img class="is-rounded" src="/storage/storage/uploads/EE1dpIJgpqac8HWXvZ2pFXn5b8UuF9cz5pVzOB1J.png">
                              </div>
                              <div class="contact_data">
                                <p class="contact_name">Western Union</p>
                                <p class="contact_role">Finance</p>
                              </div>
                            </div>
                            <div class="contact" data-id="2">
                              <div class="contact_img">
                                <img class="is-rounded" src="/storage/storage/uploads/ba3iVjhwhuBpQeQ6o7jKsCrr26vmObxshz1GsRju.png">
                              </div>
                              <div class="contact_data">
                                <p class="contact_name">Starling Bank</p>
                                <p class="contact_role">Finance</p>
                              </div>
                            </div>
                        </div>

                      </div>

                      <div class="info_box">

                        <div class="row info_title_row pb-5 position-relative">
                            <p class="box_title">Suppliers</p>

                            <div class="box_image position-absolute">
                              <img src="/images/s_green_square.png">
                            </div>
                            
                            <div class="copy_edit_btns position-absolute">
                                <i class="fas fa-plus shadow copy_info" style="background-color: #35D9CC;"></i>
                            </div>
                        </div>
                        
                        <div class="row pl-5">
                            <div class="contact">
                              <div class="contact_img">
                                <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                              </div>
                              <div class="contact_data">
                                <p class="contact_name">Jack Pickering</p>
                                <p class="contact_role">Developer</p>
                              </div>
                            </div>
                            <div class="contact">
                              <div class="contact_img">
                                <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                              </div>
                              <div class="contact_data">
                                <p class="contact_name">Susan Boyle</p>
                                <p class="contact_role">CEO</p>
                              </div>
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
                          <input type="text" placeholder="Search contacts" id="search"> 
                      </div>
                      <div class="tags">
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="Suppliers" style="background-color: #35D9CC;">
                            <p class="pl-3 pr-3">Suppliers</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="Clients" style="background-color: #D93563">
                            <p class="pl-3 pr-3">Clients</p>
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
    <script src="/js/contact_links.js"></script>
    <script src="/js/search_client.js"></script>

@endsection