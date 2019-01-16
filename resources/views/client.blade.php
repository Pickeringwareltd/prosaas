@extends('spark::layouts.app')

@section('scripts')
    <link href="/css/staff.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/sidebar.css" rel="stylesheet">
@endsection

@section('content')
<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar" class="active">
        <div class="sidebar-header">
            <p class="title is-3">Search</p>
        </div>

        <div class="search_bar">
            <p class="control has-icons-left">
                <input class="input is-small is-rounded" type="text" id="search" placeholder="search">
                <span class="icon is-small is-left">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </span>
            </p>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="content">

        <span class="icon is-large" id="sidebarCollapse">
            <i class="fas fa-search"></i>
        </span>

        <home :user="user" inline-template id="staff_template">
            <div class="container">
                <h1 class="title is-3" id="process_title">Clients</h1>
                <br /><br />

                <div class="row" id="search_results">

                    @foreach ($clients as $member)
                       
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 card_col">
                            <a href="/">

                                <figure class="image card-image is-128x128">
                                    <img class="is-rounded" src="storage/{{ $member->company_logo }}">
                                </figure>

                                <p class="title is-4 card_title">{{ $member->name }}</p>
                                <p class="card_role">{{ $member->type }}</p>

                            </a>
                        </div>

                    @endforeach

                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 card_col">
                            <a href="/client/create">

                                <figure class="image card-image is-128x128">
                                    <img class="is-rounded" src="/images/add_process.png">
                                </figure>

                                <p class="title is-4 card_title">Add new client</p>
                            </a>
                        </div>
                </div>
            </div>
        </home>
    </div>
</div>
@endsection

@section('javascripts')
    <script type="text/javascript" src="/js/sidebar.js"></script>
    <script type="text/javascript" src="/js/search_client.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
@endsection

