@extends('spark::layouts.app')

@section('scripts')
    <link href="/css/process.css" rel="stylesheet">
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

        <home :user="user" inline-template id="process_template">
            <div class="container">
                <h1 class="title is-3" id="process_title">Your processes</h1>
                <br /><br />

                    <div class="row" id="search_results">

                        @foreach ($processes as $process)
                           
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 card_col">
                                <a href="/process/{{ $process->id }}/tasks">
                                    <div class="card">

                                        <div class="card-image">
                                            <figure class="image is-4by3">
                                                <img src="storage/{{ $process->logo }}" alt="Placeholder image">
                                            </figure>
                                        </div>

                                        <div class="card-content">

                                            <div class="media">
                                                <div class="media-content">
                                                    <p class="title is-4 card_title">{{ $process->title }}</p>
                                                    <p class="subtitle is-6">{{ $process->number_of_tasks }} tasks</p>
                                                </div>
                                            </div>

                                            <div class="content">
                                                <br>
                                                <p>{{ $process->description }}</p>

                                                <br>
                                                <time datetime="2016-1-1">{{ $process->datetime }}</time>
                                            </div>

                                            @if($process->community)
                                                <span class="tag community_tag is-primary">public</span>
                                            @else
                                                <span class="tag community_tag is-info">private</span>
                                            @endif

                                        </div>

                                    </div>
                                </a>
                            </div>

                        @endforeach

                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 new_process card_col">
                            <a href="/process/create">
                                <div class="card">

                                    <div class="card-image">
                                        <figure class="image is-4by3">
                                            <img src="/images/add_process.png" alt="Placeholder image">
                                        </figure>
                                    </div>

                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-content">
                                                <p class="title is-4">Add new process</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
            </div>
        </home>
    </div>
</div>
@endsection

@section('javascripts')
    <script type="text/javascript" src="js/search_process.js"></script>
    <script type="text/javascript" src="/js/sidebar.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
@endsection

