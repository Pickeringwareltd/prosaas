@extends('spark::layouts.app')

@section('scripts')
    <link href="/css/process.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
@endsection

@section('content')
    <home :user="user" inline-template id="process_template">
        <div class="container">
            <h1 class="title is-3" id="process_title">Select tasks</h1>
            <br /><br />

                <div class="row">

                    @foreach ($tasks as $task)
                       
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 card_col">
                            <a href="/process/14/tasks">
                                <div class="card">

                                    <div class="card-image">

                                    </div>

                                    <div class="card-content">

                                        <div class="media">
                                            <div class="media-content">
                                                <p class="title is-4 card_title">{{ $task->name }}</p>
                                            </div>
                                        </div>

                                        <div class="content">
                                            <br>
                                            <p>{{ $task->description }}</p>
                                        </div>
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
                                            <p class="title is-4">Create your own task</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
        </div>
    </home>
    <section class="hero is-large is-info is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Software footer</h1>
                <h2 class="subtitle">Something address blah blah</h2>
            </div>
        </div>
    </section>
@endsection

@section('javascripts')
@endsection

