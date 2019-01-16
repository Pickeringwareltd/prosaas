@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/bulma-calendar.min.css" rel="stylesheet">
    <link href="/css/company_single.css" rel="stylesheet">
    <link href="/css/company_locations.css" rel="stylesheet">

    <script src='https://api.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.css' rel='stylesheet' />

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
                    <li class="nav_item active" data-link="/locations">Locations</li>
                    <li class="nav_item" data-link="/files">Files</li>
                    <li class="nav_item" data-link="/staff">Staff</li>
                    <li class="nav_item" data-link="/contacts">Contacts</li>
                  </ul>
                </div>
                <div class="row pl-3">
                  <div class="col-9">
                    <span class="tag is-medium is-info is-rounded add_information shadow" style="background-color: #3F50B1;">
                      <p class="pl-3 pr-3">Add location</p>
                      <i class="fas fa-plus"></i>
                    </span>
                  </div>
                  <div class="col-3"></div>
                </div>
                <div class="row pl-5">
                  <div class="col-9 p-5">
                    
                      <div class="row info_box position-relative">
                        <div class="copy_edit_btns position-absolute">
                            <i class="fas fa-copy shadow copy_info" style="background-color: #3F50B1;"></i>
                        </div>
                        <div class="col-4">
                          <div class="map_img" id="map">
                          </div> 
                        </div>
                        <div class="col-8">
                          <div class="row">
                            <div class="col">
                              <p class="box_title">Head office</p>
                            </div>
                          </div>
                          <div class="row pt-5">
                            <div class="col-6">
                              <div class="info_item pb-4">
                                  <div class="info_title_box">
                                    <i class="fas fa-map-marker-alt info_icon" style="display: inline-block; color: #3F50B1;"></i>
                                    <p class="info_title"><b>Address</b></p>
                                  </div>
                                  <div class="info_data_box">
                                    <p>Flat 2</p>
                                    <p>Commerce House</p>
                                    <p>Exchange Square</p>
                                    <p>TS1 5HJ</p>
                                  </div>
                                </div>
                            </div>
                            <div class="col-6">
                              <div class="info_item pb-4">
                                  <div class="info_title_box">
                                    <i class="fas fa-lock info_icon" style="display: inline-block; color: #3F50B1;"></i>
                                    <p class="info_title"><b>Building code</b></p>
                                  </div>
                                  <div class="info_data_box">
                                    <p class="in_vault">VAULT</p>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="row pt-3">
                            <div class="col">
                                <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #3F50B1;">
                                    <p class="pl-3 pr-3">Office</p>
                                  <button class="delete is-small" style="display:none;"></button>
                                </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                      <div class="row info_box position-relative">
                        <div class="copy_edit_btns position-absolute">
                                <i class="fas fa-copy shadow copy_info" style="background-color: #D93563;"></i>
                            </div>
                        <div class="col-4">
                          <div class="map_img" id="map2"></div>
                        </div>
                        <div class="col-8">
                              <div class="row">
                                <div class="col">
                                  <p class="box_title">Middlesbrough store</p>
                                </div>
                              </div>
                              <div class="row pt-5">
                                <div class="col-6">
                                  <div class="info_item pb-4">
                                      <div class="info_title_box">
                                        <i class="fas fa-map-marker-alt info_icon" style="display: inline-block; color: #D93563;"></i>
                                        <p class="info_title"><b>Address</b></p>
                                      </div>
                                      <div class="info_data_box">
                                        <p>Flat 2</p>
                                        <p>Commerce House</p>
                                        <p>Exchange Square</p>
                                        <p>TS1 5HJ</p>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                  <div class="info_item pb-4">
                                      <div class="info_title_box">
                                        <i class="fas fa-lock info_icon" style="display: inline-block; color: #D93563;"></i>
                                        <p class="info_title"><b>Building code</b></p>
                                      </div>
                                      <div class="info_data_box">
                                        <p class="in_vault">VAULT</p>
                                      </div>
                                  </div>
                                  <div class="info_item pb-4">
                                      <div class="info_title_box">
                                        <i class="fas fa-lock info_icon" style="display: inline-block; color: #D93563;"></i>
                                        <p class="info_title"><b>VAT registration code</b></p>
                                      </div>
                                      <div class="info_data_box">
                                        <p class="in_vault">VAULT</p>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row pt-3">
                                <div class="col">
                                    <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #D93563;">
                                        <p class="pl-3 pr-3">Store</p>
                                      <button class="delete is-small" style="display:none;"></button>
                                    </span>
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
                          <input type="text" placeholder="Search locations"> 
                      </div>
                      <div class="tags">
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #3F50B1;">
                            <p class="pl-3 pr-3">Office</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #D93563">
                            <p class="pl-3 pr-3">Store</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #6A6A6A">
                            <p class="pl-3 pr-3">Factory</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
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
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClkmbrF12saBbvlL8-ly-nv24wI7SzmsU&callback=initMap">
    </script>
    <script src="/js/bulma-calendar.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>

    <script src="/js/google_maps.js"></script>
    <script src="/js/inner_navbar.js"></script>
@endsection