@extends('spark::layouts.app')

@section('scripts')
    <link href="/css/create_process.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
@endsection

@section('content')
    <home :user="user" inline-template id="process_template">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
        
                        <p class="title is-1" id="page_title">Create member of staff</p>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)    
                                <p class="help is-danger error">{{ $error }}</p>
                            @endforeach
                        @endif

                        <form action="/staff/create" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="field">
                                <label class="label">Full name</label>
                                <div class="control has-icons-right">
                                    <input class="input is-large" type="text" name="staffName" placeholder="John Smith">
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-project-diagram"></i>
                                    </span>
                                </div>
                                
                            </div>

                            <div class="field">
                                <label class="label">Role</label>
                                <div class="control has-icons-right">
                                    <input class="input is-large" type="text" name="staffRole" placeholder="Developer">
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-project-diagram"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Profile picture</label>

                                <div class="file is-info is-boxed">
                                    <label class="file-label">
                                    <input class="file-input" type="file" name="staffLogo">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </span>
                                        <span class="file-label">Upload logo</span>
                                    </span>
                                    </label>
                                </div>
                                <p class="help is-info">We strongly suggest adding a logo including the staff members face</p>
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

