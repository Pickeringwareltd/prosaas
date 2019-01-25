@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/company_single.css" rel="stylesheet">
    <link href="/css/company_staff.css" rel="stylesheet">
    <link href="/css/files.css" rel="stylesheet">

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
                      <li class="nav_item active" data-link="/files">Files</li>
                      <li class="nav_item" data-link="/staff">Staff</li>
                      <li class="nav_item" data-link="/contacts">Contacts</li>
                    </ul>
                    <hr />
                    <ul id="burger_nav" class="pb-3">
                      @foreach($burger_nav as $nav_item)

                          @if (!$loop->first)
                              <li data-link=""> > </li>
                          @else 
                              <li class="nav_item" data-link="/files/">Home</li>
                              <li data-link=""> > </li>
                          @endif
                          @if ($loop->last)
                            <li class="nav_item active" data-link="/files/{{ $nav_item->id }}">{{ $nav_item->name }}</li>
                          @else
                            <li class="nav_item" data-link="/files/{{ $nav_item->id }}">{{ $nav_item->name }}</li>
                          @endif

                      @endforeach
                    </ul>    
                  </div>
                </div>
                <div class="row pl-3">
                  <div class="col-9">
                    <span class="tag is-medium is-info is-rounded add_information shadow" style="background-color: #3F50B1;">
                      <p class="pl-3 pr-3">Add file</p>
                      <i class="fas fa-plus"></i>
                    </span>
                  </div>
                  <div class="col-3"></div>
                </div>
                <div class="row pl-5">
                  <div class="col-9 p-3 pt-0">

                    <div class="row">
                      <div class="col-9 pb-3 file_table">
                        <div class="row">
                            @foreach($folders as $folder)
                                <div class="col-3 file folder position-relative" data-id="{{ $folder->id }}">
                                      <div class="file_img position-absolute">
                                          <img src="/images/folder_yellow_square.png">
                                      </div>
                                      <div class="file_data position-absolute">
                                          <p class="file_title">{{ $folder->name }}</p>
                                          <p class="file_creator">Jack Pickering</p>
                                      </div> 
                                </div>
                            @endforeach
                          </div>
                      </div>
                    </div>

                    <div class="row">
                        @foreach($files as $file)
                          <div class="col-3 file linked_file position-relative" data-link="{{ $file->url }}">
                            <div class="file_img position-absolute">
                              @if($file->type == 'doc')
                                <img src="/images/doc_grey_square.png">
                              @elseif($file->type == 'pdf')
                                <img src="/images/pdf_red_square.png">
                              @elseif($file->type == 'exe')
                                <img src="/images/exe_blue_square.png">
                              @elseif($file->type == 'ppt')
                                <img src="/images/ppt_purple_square.png">
                              @elseif($file->type == 'img')
                                <img src="/images/img_green_square.png">
                              @else
                                <img src="/images/unknown_orange_square.png">
                              @endif
                            </div>
                            <div class="file_data position-absolute">
                                <p class="file_title">{{ $file->name }}</p>
                                <p class="file_creator">Jack Pickering</p>
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
                          <input type="text" placeholder="Search files" id="search"> 
                      </div>
                      <div class="tags">
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="exe" style="background-color: #3F50B1;">
                            <p class="pl-3 pr-3">.exe</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="pdf" style="background-color: #D93563">
                            <p class="pl-3 pr-3">.pdf</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="doc" style="background-color: #6A6A6A">
                            <p class="pl-3 pr-3">.doc</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="img" style="background-color: #288605">
                            <p class="pl-3 pr-3">image</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="unknown" style="background-color: #CC6600">
                            <p class="pl-3 pr-3">unknown</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>  
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="ppt" style="background-color: #7003CE">
                            <p class="pl-3 pr-3">.ppt</p>
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
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    <script src="/js/inner_navbar.js"></script>
    <script src="/js/file_navigator.js"></script>
    <script src="/js/sidebar_staff.js"></script>
    <script src="/js/search_files.js"></script>
@endsection