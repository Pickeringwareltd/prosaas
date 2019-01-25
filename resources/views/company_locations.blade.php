@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">

    <link href="/css/company_staff.css" rel="stylesheet">
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
                  <div class="col-9">
                    <ul id="nav_list" class="pb-3">
                      <li class="nav_item" data-link="">Information</li>
                      <li class="nav_item active" data-link="/locations">Locations</li>
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
                      <p class="pl-3 pr-3">Add location</p>
                      <i class="fas fa-plus"></i>
                    </span>
                  </div>
                  <div class="col-3"></div>
                </div>
                <div class="row pl-5">
                  <div class="col-9 p-5">

                    <div id="search_results"></div>
                    <div id="all_results">
                        @foreach($locations as $location)

                          <div class="row info_box position-relative">
                            <div class="copy_edit_btns position-absolute">
                                <i class="fas fa-copy shadow copy_info" style="background-color: {{ $location->color }};"></i>
                            </div>
                            <div class="col-4">
                              <div class="map_img new_map" id="map_{{ $location->id }}" data-name="map_{{ $location->id }}" data-long="{{ $location->long }}" data-lat="{{ $location->lat }}">
                              </div> 
                            </div>
                            <div class="col-8">
                              <div class="row">
                                <div class="col">
                                  <p class="box_title">{{ $location->name }}</p>
                                </div>
                              </div>
                              <div class="row pt-5">
                                @foreach($location->info as $info)
                                  <div class="col-6">
                                    <div class="info_item pb-4">
                                        <div class="info_title_box">
                                          <i class="{{ $info->icon }} info_icon" style="display: inline-block; color: {{ $location->color }};"></i>
                                          <p class="info_title"><b>{{ $info->title }}</b></p>
                                        </div>
                                        <div class="info_data_box">
                                          @if($info->encrypted == true)
                                            <p class="in_vault">VAULT</p>
                                          @else
                                            {!! $info->data !!}
                                          @endif
                                        </div>
                                      </div>
                                  </div>
                                @endforeach
                              </div>
                              <div class="row pt-3">
                                <div class="col">
                                  @foreach($location->tags as $tag)
                                    <span class="tag search-tag is-medium is-info is-rounded" data-name="{{ $tag->name }}" style="background-color: {{ $location->color }};">
                                        <p class="pl-3 pr-3">{{ ucfirst($tag->name) }}</p>
                                      <button class="delete is-small" style="display:none;"></button>
                                    </span>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>

                        @endforeach
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
                          <input type="text" placeholder="Search locations" id="search"> 
                      </div>
                      <div class="tags">
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="office" style="background-color: #3F50B1;">
                            <p class="pl-3 pr-3">Office</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="store" style="background-color: #D93563">
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
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>

    <!-- <script src="/js/google_maps.js"></script> -->
    <script src="/js/inner_navbar.js"></script>
    <script src="/js/sidebar_staff.js"></script>
    <script src="/js/search_locations.js"></script>
@endsection