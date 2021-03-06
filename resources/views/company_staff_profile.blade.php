@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/company_single.css" rel="stylesheet">
    <link href="/css/profiles.css" rel="stylesheet">
    <link href="/css/processes.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('pageTitle', 'Techquity')
@section('pageSubTitle', '| '.$profile->fullname )

@section('content')
<div class="wrapper">

    <!-- Page Content -->
    <div id="content">
        <home :user="user" inline-template id="staff_template">
          <div class="single_element">
            <div class="container-fluid">
                <div class="row pl-3">
                  <ul id="nav_list">
                    <li class="nav_item active" data-link="/company/staff/{{ $profile->id }}">Information</li>
                    <li class="nav_item" data-link="/company/staff/{{ $profile->id }}/files">Files</li>
                  </ul>
                </div>
                <div class="row pl-5">
                  <div class="col-9 p-5">
                    <span class="tag is-medium is-info is-rounded add_information shadow" style="background-color: #3F50B1;">
                      <p class="pl-3 pr-3">Add information</p>
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
                      <div class="info_box">

                        <div class="row info_title_row pb-5 position-relative">
                            <p class="box_title">General info</p>

                            <div class="box_image position-absolute">
                              <img src="/images/g_blue_square.png">
                            </div>
                            
                            <div class="copy_edit_btns position-absolute">
                                <i class="fas fa-copy shadow copy_info" style="background-color: #3F50B1;"></i>
                            </div>
                        </div>
                        
                        <div class="row pl-5">
                              @foreach($profile->info as $info)
                              <div class="col-4">

                                <div class="info_item pb-4">
                                  <div class="info_title_box">
                                    <i class="{{ $info->icon }} info_icon" style="display: inline-block; color: #3F50B1;"></i>
                                    <p class="info_title"><b>{{ $info->title }}</b></p>
                                  </div>
                                  <div class="info_data_box">
                                    @if($info->encrypted)
                                      <p class="in_vault">VAULT</p>
                                    @else
                                      {!! $info->data !!}
                                    @endif
                                  </div>
                                </div>

                              </div>
                              @endforeach
                        </div>

                      </div>
                      <div class="info_box">
                        <div class="row info_title_row pb-5 position-relative">
                            <p class="box_title">Custom info</p>
                            <div class="box_image  position-absolute">
                              <img src="/images/C_red_square.png">
                            </div>
                            <div class="copy_edit_btns position-absolute">
                                <i class="fas fa-copy shadow copy_info" style="background-color: #D93563;"></i>
                            </div>
                        </div>
                                                <div class="row pl-5">
                          <div class="col-4">

                            <div class="info_item pb-4">
                              <div class="info_title_box">
                                <i class="fas fa-globe info_icon" style="display: inline-block; color: #D93563;"></i>
                                <p class="info_title"><b>Website</b></p>
                              </div>
                              <div class="info_data_box">
                                <p>www.techquity.com</p>
                              </div>
                            </div>

                            <div class="info_item pb-4">
                              <div class="info_title_box">
                                <i class="fas fa-phone info_icon" style="display: inline-block; color: #D93563;"></i>
                                <p class="info_title"><b>Main office number</b></p>
                              </div>
                              <div class="info_data_box">
                                <p>01642 777 666</p>
                              </div>
                            </div>

                          </div>
                          <div class="col-4">

                            <div class="info_item pb-4">
                              <div class="info_title_box">
                                <i class="fas fa-lock info_icon" style="display: inline-block; color: #D93563;"></i>
                                <p class="info_title"><b>Office code</b></p>
                              </div>
                              <div class="info_data_box">
                                <p class="in_vault">VAULT</p>
                              </div>
                            </div>

                          </div>
                          <div class="col-4">
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-3 p-5 sidebar">
                      <div class="profile_picture">
                          <img class="is-rounded" src="/storage/images/{{ $profile->profile_picture }}">
                      </div>
                      <div class="search">
                          <input type="text" placeholder="Search information"> 
                      </div>
                      <div class="tags">
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #3F50B1;">
                            <p class="pl-3 pr-3">General</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #D93563">
                            <p class="pl-3 pr-3">Custom</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #6A6A6A">
                            <p class="pl-3 pr-3">Vault</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #D93563">
                            <p class="pl-3 pr-3">Number</p>
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
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    <script src="/js/inner_navbar_profiles.js"></script>
@endsection