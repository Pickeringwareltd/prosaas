@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">

    <link href="/css/company_staff.css" rel="stylesheet">
    <link href="/css/company_single.css" rel="stylesheet">

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
                      <li class="nav_item active" data-link="">Information</li>
                      <li class="nav_item" data-link="/locations">Locations</li>
                      <li class="nav_item" data-link="/files">Files</li>
                      <li class="nav_item" data-link="/staff">Staff</li>
                      <li class="nav_item" data-link="/contacts">Contacts</li>
                    </ul>
                    <hr />
                  </div>
                </div>
                <div class="row pl-3">
                  <div class="col-9">
                    <span class="tag is-medium is-info is-rounded add_information shadow" style="background-color: #3F50B1;">
                      <p class="pl-3 pr-3">Add information</p>
                      <i class="fas fa-plus"></i>
                    </span>
                  </div>
                  <div class="col-3"></div>
                </div>
                <div class="row pl-5">
                  <div class="col-9 p-5">

                    @foreach($info_groups as $group)
                        <div class="info_box">
                            <div class="row info_title_row pb-5 position-relative">
                                <p class="box_title">{{ $group->title }}</p>

                                <div class="box_image position-absolute">
                                  <img src="{{ $group->logo }}">
                                </div>
                                
                                <div class="copy_edit_btns position-absolute">
                                    <i class="fas fa-copy shadow copy_info" style="background-color: {{ $group->color }};"></i>
                                </div>
                            </div>
                            
                            <div class="row pl-5">

                              @foreach($group->info as $info)
                              <div class="col-4">

                                <div class="info_item pb-4">
                                  <div class="info_title_box">
                                    <i class="{{ $info->icon }} info_icon" style="display: inline-block; color: {{ $group->color }};"></i>
                                    <p class="info_title"><b>{{ $info->title }}</b></p>
                                  </div>
                                  <div class="info_data_box">
                                    @if($info->encrypted)
                                      <p class="in_vault">VAULT</p>
                                    @else
                                      <p>{!! $info->data !!}</p>
                                    @endif
                                  </div>
                                </div>

                              </div>
                              @endforeach

                            </div>
                          </div>
                      @endforeach
                      
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
                          <input type="text" placeholder="Search information" id="search"> 
                      </div>
                      <div class="tags">
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="general" style="background-color: #3F50B1;">
                            <p class="pl-3 pr-3">General</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="custom" style="background-color: #D93563">
                            <p class="pl-3 pr-3">Custom</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="vault" style="background-color: #6A6A6A">
                            <p class="pl-3 pr-3">Vault</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                      </div>
                      <div id="search_results"></div>
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
    <script src="/js/sidebar_staff.js"></script>
    <script src="/js/search_information.js"></script>
@endsection