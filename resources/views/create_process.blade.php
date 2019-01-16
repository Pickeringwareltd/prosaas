@extends('spark::layouts.app')

@section('scripts')
    <link href="/css/create_process.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- title -->
<!-- description -->
<!-- logo -->

    <home :user="user" inline-template id="process_template">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
        
                        <p class="title is-1" id="page_title">Create a process</p>

                        <form action="/process/create" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="field">
                                <label class="label">Title</label>
                                <div class="control has-icons-right">
                                    <input class="input is-large" type="text" name="processTitle" placeholder="My new process">
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-project-diagram"></i>
                                    </span>
                                </div>

                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        @if( strpos($error, 'title') !== false )
                                            <p class="help is-danger error">{{ $error }}</p>
                                        @endif
                                    @endforeach
                                @endif
                                
                            </div>

                            <div class="field">
                                <label class="label">Description</label>
                                <div class="control has-icons-right">
                                    <textarea class="textarea" name="processDescription" placeholder="Add a description..."></textarea>
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-comment-alt"></i>
                                    </span>
                                </div>

                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        @if( strpos($error, 'description') !== false )
                                            <p class="help is-danger error">{{ $error }}</p>
                                        @else
                                            <p class="help is-info">Try to be as detailed as possible</p>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="help is-info">Try to be as detailed as possible</p>
                                @endif
                            </div>

                            <div class="field">
                                <label class="label">Logo</label>

                                <div class="file is-info is-boxed">
                                    <label class="file-label">
                                    <input class="file-input" type="file" name="processLogo">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </span>
                                        <span class="file-label">Upload logo</span>
                                    </span>
                                    </label>
                                </div>
                                <p class="help is-info">We strongly suggest adding a logo that will instantly describe the process</p>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <label class="checkbox">
                                        <input type="checkbox" name="addToCommunity">
                                        I'd like to share this with the <a href="#">community</a>
                                    </label>
                                </div>
                            </div>

                            <div class="field is-grouped">
                                <div class="control">
                                    <input type="submit" class="button is-link"></input>
                                </div>
                                <div class="control">
                                    <a class="button is-text" href="/process">Cancel</a>
                                </div>
                            </div>

                        </form>

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
@endsection

