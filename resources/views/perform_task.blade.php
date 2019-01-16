@extends('spark::layouts.app')

@section('scripts')
    <link href="/css/task.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
@endsection

@section('content')
    <home :user="user" inline-template id="tag_template">
        <div class="container">
            <h1 class="title is-3" id="process_title">{{ $process->title }}</h1>
            <a class="delete" href="/process" id="close_btn"></a>
            <div class="row">
                <div class="col-2"></div>

                <div class="col-8">
                    <div class="progress" id="process_progress_bar">
                        <div class="progress-bar progress-bar-success" id="progress_bar_progress" role="progressbar" data-count="{{ $process->tasks->count() }}" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            0%
                        </div>
                    </div>
                </div>

                <div class="col-2"></div>
            </div>

            <!-- Show task -->
            <div class="row">
                <div class="col-12">            
                    <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true, "draggable": false, "pageDots": false, "fullscreen": true }'>
                        @forelse($process->tasks->sortBy('index') as $task)
                        <div class="carousel-cell">
                            <div class="card">
                                <div class="card-content">
                                    @if ($task->logo != 'null')
                                        <img class="img card_logo" src="{{ $task->logo }}">
                                    @endif
                                    <p class="title card_title">{{ $task->name }}</p>
                                    <p class="subtitle card_description">{{ $task->description }}</p>
                                    @if ($task->requiresInput)
                                        <div class="form-group form_inputs">
                                            <br />
                                            <input type="text" class="form-control input is-large" id="input" aria-describedby="chnumHelp">
                                        </div>
                                    @endif
                                </div>
                                <footer class="card-footer">
                                    <p class="card-footer-item is-danger"><button class="button is-danger is-large">I can't do this</button></p>
                                    @if($loop->last)
                                        <a href="/process" class="card-footer-item"><button class="button is-success is-large done_btn">Done!</button></a>
                                    @else
                                        <a class="card-footer-item"><button class="button is-success is-large done_btn">Next</button></a>
                                    @endif
                                </footer>
                            </div>
                        </div>
                        @empty
                        <div class="carousel-cell">
                            <div class="card">
                                <div class="card-content">
                                    <p class="title card_title">No tasks available</p>
                                </div>
                                <footer class="card-footer">
                                    <a class="card-footer-item" href="/tasks"><button class="button is-success is-large done_btn">Create now</button></a>
                                </footer>
                            </div>
                        </div>                       
                        @endforelse
                    </div>
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
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="/js/task.js"></script>
@endsection
