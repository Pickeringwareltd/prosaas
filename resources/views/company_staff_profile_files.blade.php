@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/company_single.css" rel="stylesheet">
    <link href="/css/profiles.css" rel="stylesheet">
    <link href="/css/files.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('pageTitle', 'Techquity')
@section('pageSubTitle', '| Daniel Broswell')

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
                    <li class="nav_item active" data-link="files">Files</li>
                  </ul>
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
                          <div class="file position-relative">
                            <div class="file_img position-absolute">
                                <img src="/images/folder_yellow_square.png">
                            </div>
                            <div class="file_data position-absolute">
                                <p class="file_title">Analytics</p>
                                <p class="file_creator">Jack Pickering</p>
                            </div> 
                          </div>
                          <div class="file position-relative">
                            <div class="file_img position-absolute">
                                <img src="/images/folder_yellow_square.png">
                            </div>
                            <div class="file_data position-absolute">
                                <p class="file_title">Documents</p>
                                <p class="file_creator">Jack Pickering</p>
                            </div> 
                          </div>
                          <div class="file position-relative">
                            <div class="file_img position-absolute">
                                <img src="/images/folder_yellow_square.png">
                            </div>
                            <div class="file_data position-absolute">
                                <p class="file_title">Reports</p>
                                <p class="file_creator">Jack Pickering</p>
                            </div> 
                          </div>
                        </div>
                      </div>
                      
                        <div class="file position-relative">
                          <div class="file_img position-absolute">
                              <img src="/images/doc_grey_square.png">
                          </div>
                          <div class="file_data position-absolute">
                              <p class="file_title">sales_report.doc</p>
                              <p class="file_creator">Jack Pickering</p>
                          </div> 
                        </div>
                        <div class="file position-relative">
                          <div class="file_img position-absolute">
                              <img src="/images/pdf_red_square.png">
                          </div>
                          <div class="file_data position-absolute">
                              <p class="file_title">pitch_deck.pdf</p>
                              <p class="file_creator">John Smith</p>
                          </div> 
                        </div>
                        <div class="file position-relative">
                          <div class="file_img position-absolute">
                              <img src="/images/exe_blue_square.png">
                          </div>
                          <div class="file_data position-absolute">
                              <p class="file_title">customer_offers.exe</p>
                              <p class="file_creator">Jack Pickering</p>
                          </div> 
                        </div>
                        <div class="file position-relative">
                          <div class="file_img position-absolute">
                              <img src="/images/pdf_red_square.png">
                          </div>
                          <div class="file_data position-absolute">
                              <p class="file_title">pitch_deck.pdf</p>
                              <p class="file_creator">John Smith</p>
                          </div> 
                        </div>

                        <div class="file position-relative">
                          <div class="file_img position-absolute">
                              <img src="/images/exe_blue_square.png">
                          </div>
                          <div class="file_data position-absolute">
                              <p class="file_title">customer_offers.exe</p>
                              <p class="file_creator">Jack Pickering</p>
                          </div> 
                        </div>
                        <div class="file position-relative">
                          <div class="file_img position-absolute">
                              <img src="/images/exe_blue_square.png">
                          </div>
                          <div class="file_data position-absolute">
                              <p class="file_title">customer_offers.exe</p>
                              <p class="file_creator">Jack Pickering</p>
                          </div> 
                        </div>
                        <div class="file position-relative">
                          <div class="file_img position-absolute">
                              <img src="/images/doc_grey_square.png">
                          </div>
                          <div class="file_data position-absolute">
                              <p class="file_title">sales_report.doc</p>
                              <p class="file_creator">Jack Pickering</p>
                          </div> 
                        </div>
                        <div class="file position-relative">
                          <div class="file_img position-absolute">
                              <img src="/images/pdf_red_square.png">
                          </div>
                          <div class="file_data position-absolute">
                              <p class="file_title">pitch_deck.pdf</p>
                              <p class="file_creator">John Smith</p>
                          </div> 
                        </div>
                        <div class="file position-relative">
                          <div class="file_img position-absolute">
                              <img src="/images/doc_grey_square.png">
                          </div>
                          <div class="file_data position-absolute">
                              <p class="file_title">sales_report.doc</p>
                              <p class="file_creator">Jack Pickering</p>
                          </div> 
                        </div>
                      
                  </div>
                  <div class="col-3 p-5 sidebar">
                      <div class="profile_picture">
                          <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                      </div>
                      <div class="search">
                          <input type="text" placeholder="Search information"> 
                      </div>
                      <div class="tags">
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #3F50B1;">
                            <p class="pl-3 pr-3">.exe</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #D93563">
                            <p class="pl-3 pr-3">.pdf</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #6A6A6A">
                            <p class="pl-3 pr-3">.doc</p>
                          <button class="delete is-small" style="display:none;"></button>
                        </span>
                        <span class="tag search-tag is-medium is-info is-rounded" data-name="tag_name" style="background-color: #D93563">
                            <p class="pl-3 pr-3">folder</p>
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