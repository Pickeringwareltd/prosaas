@extends('spark::layouts.new_app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/bulma-calendar.min.css" rel="stylesheet">

    <link href="/css/companies.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('pageTitle', 'Your companies')

@section('content')
<div class="wrapper">

    <!-- Page Content -->
    <div id="content">
        <home :user="user" inline-template id="staff_template"> 
            <div class="container-fluid">
                <div class="row companies_table p-5">

                    <div class="col-10 col-sm-4 col-xl-3 ml-5 mr-5 mb-5 shadow company_card" id="iconemy">
                      <div class="row pr-3 py-4 shadow company_img">
                          <img src="/images/iconemy_logo.png">
                      </div>

                      <div class="row p-3 mt-5">
                        <div class="col-12">
                          <p class="company_name">Iconemy</p>
                          <p class="company_role">Owner</p>
                        </div>

                        <div class="col-12 p-4">
                            <div class="row">
                              <figure class="image card-image staff_picture first_picture" style="z-index: 3; position: relative; right: 0px;">
                                  <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                              </figure>
                              <figure class="image card-image staff_picture" style="z-index: 2; position: relative; right: 25px;">
                                  <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                              </figure>
                              <p class="w-100 pt-2"><b class="no_of_staff">TWO</b> people work here</p>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-10 col-sm-4 col-xl-3 ml-5 mr-5 mb-5 shadow company_card" id="techquity">
                      <div class="row pr-3 py-4 shadow company_img">
                          <img src="/images/techquity_logo.png">
                      </div>

                      <div class="row p-3 mt-5">
                        <div class="col-12">
                          <p class="company_name">Techquity</p>
                          <p class="company_role">Developer</p>
                        </div>

                        <div class="col-12 p-4">
                            <div class="row">
                                <figure class="image card-image staff_picture" style="z-index: 5; position: relative; right: 0px;">
                                    <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                                </figure>
                                <figure class="image card-image staff_picture" style="z-index: 4; position: relative; right: 25px;">
                                    <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                                </figure>
                                <figure class="image card-image staff_picture" style="z-index: 3; position: relative; right: 50px;">
                                    <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                                </figure>
                                <figure class="image card-image staff_picture" style="z-index: 2; position: relative; right: 75px;">
                                    <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                                </figure>
                              <p class="w-100 pt-2"><b class="no_of_staff">FOUR</b> people work here</p>
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="col-10 col-sm-4 col-xl-3 ml-5 mr-5 mb-5 shadow company_card" id="iconemy">
                      <div class="row pr-3 py-4 shadow company_img">
                          <img src="/images/iconemy_logo.png">
                      </div>

                      <div class="row p-3 mt-5">
                        <div class="col-12">
                          <p class="company_name">Iconemy</p>
                          <p class="company_role">Owner</p>
                        </div>

                        <div class="col-12 p-4">
                            <div class="row">
                              <figure class="image card-image staff_picture first_picture" style="z-index: 3; position: relative; right: 0px;">
                                  <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                              </figure>
                              <figure class="image card-image staff_picture" style="z-index: 2; position: relative; right: 25px;">
                                  <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                              </figure>
                              <p class="w-100 pt-2"><b class="no_of_staff">TWO</b> people work here</p>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-10 col-sm-4 col-xl-3 ml-5 mr-5 mb-5 shadow company_card" id="techquity">
                      <div class="row pr-3 py-4 shadow company_img">
                          <img src="/images/techquity_logo.png">
                      </div>

                      <div class="row p-3 mt-5">
                        <div class="col-12">
                          <p class="company_name">Techquity</p>
                          <p class="company_role">Developer</p>
                        </div>

                        <div class="col-12 p-4">
                            <div class="row">
                                <figure class="image card-image staff_picture" style="z-index: 5; position: relative; right: 0px;">
                                    <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                                </figure>
                                <figure class="image card-image staff_picture" style="z-index: 4; position: relative; right: 25px;">
                                    <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                                </figure>
                                <figure class="image card-image staff_picture" style="z-index: 3; position: relative; right: 50px;">
                                    <img class="is-rounded" src="/storage/storage/uploads/5LI9T6pfpqAJleWeUZgXpTwUUFWCzApp6jrlVF8o.jpeg">
                                </figure>
                                <figure class="image card-image staff_picture" style="z-index: 2; position: relative; right: 75px;">
                                    <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                                </figure>
                              <p class="w-100 pt-2"><b class="no_of_staff">FOUR</b> people work here</p>
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="col-10 col-sm-4 col-xl-3 ml-5 mr-5 mb-5 shadow company_card" id="add_company">
                      <div class="row pr-3 py-4 shadow company_img">
                          <img src="/images/add_sign.png">
                      </div>

                      <div class="row p-3 mt-5">
                        <div class="col-12">
                          <p class="company_name">Add a company</p>
                        </div>

                        <div class="col-12 p-4">
                            <div class="row">
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
@endsection