@extends('spark::layouts.app')

@section('scripts')
    <link href="/css/create_process.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <home :user="user" inline-template id="process_template">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
        
                        <p class="title is-1" id="page_title">Add company info</p>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)    
                                <p class="help is-danger error">{{ $error }}</p>
                            @endforeach
                        @endif

                        <form action="/company/item/create" method="post" enctype="multipart/form-data" id="create_item_form">
                            @csrf

                            <div class="field">
                                <label class="label">Item name</label>
                                <div class="control has-icons-right">
                                    <input class="input is-large" type="text" name="itemName" placeholder="Company number">
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-project-diagram"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Item type</label>
                                <div class="field">
                                    <div class="control">
                                        <div class="select is-large">
                                            <select id="item_select" name="itemType">
                                                <option>Text</option>
                                                <option>Image</option>
                                                <option>File</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field" id="text_field">
                                <label class="label">Text value</label>
                                <div class="control has-icons-right">
                                    <input class="input is-large" type="text" name="itemText" placeholder="BC-12345678" id="text_holder">
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-project-diagram"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="field" id="image_field" style="display: none;">
                                <label class="label">Image</label>

                                <div class="file is-info is-boxed">
                                    <label class="file-label">
                                    <input class="file-input" type="file" name="itemImage">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </span>
                                        <span class="file-label">Upload image</span>
                                    </span>
                                    </label>
                                </div>
                            </div>

                            <div class="field" id="doc_field" style="display: none;">
                                <label class="label">Document</label>

                                <div class="file is-info is-boxed">
                                    <label class="file-label">
                                    <input class="file-input" type="file" name="itemDoc">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </span>
                                        <span class="file-label">Upload doc</span>
                                    </span>
                                    </label>
                                </div>
                            </div>

                            <div class="field" id="encrypt_field">
                                <label class="label">Add to vault</label>
                                <div class="control has-icons-right">
                                    
                                    <input type="checkbox" name="encrypted" id="encrypted">
                               
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="field" id="tags">
                                <label class="label">Add tags</label>
                                <div class="tags">
                                    <div id="tag_list" data-count="{{ count($data['tags']) }}">
                                        @foreach($data['tags'] as $tag)
                                          <span class="tag is-medium is-info" data-name="{{ json_decode($tag, true)['en'] }}">
                                            {{ json_decode($tag, true)['en'] }}
                                            <a class="delete is-small" style="display:none;"></a>
                                          </span>
                                        @endforeach
                                    </div>
                                      <span class="tag is-medium is-info is-outlined" id="new_tag_form">
                                        <input id="new_tag_input" type="text" placeholder="Add new tag">
                                        <a class="delete is-small" style="display:none;"></a>
                                      </span>
                                      <span class="icon is-medium" id="new_tag_icon">
                                          <i class="fas fa-plus"></i>
                                      </span>
                                </div>
                            </div>

                            <div class="field is-grouped">
                                <div class="control">
                                    <input type="submit" id="submit_btn" class="button is-link"></input>
                                </div>
                                <div class="control">
                                    <a class="button is-text" href="/company">Cancel</a>
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

    <div class="modal" id="text_modal">
        <div class="modal-background is-warning"></div>
        <div class="modal-card">
            <section class="modal-card-body">
                <p class="title is-3 modal_title">Lock the item in the vault</p>
                <p class="locked_icon"><i class="fas fa-lock"></i></p>
                <input class="input vault_password" type="password" placeholder="Password" id="vault_password">
                <div class="submit_vault_password">
                  <button class="button is-medium is-warning copy vault_unlock_btn" id="vault_unlock_btn">Lock</button>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('javascripts')
    <script type="text/javascript" src="/js/create_company_info.js"></script>
@endsection

