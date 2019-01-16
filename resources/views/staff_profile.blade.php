@extends('spark::layouts.app')

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" rel="stylesheet">
    <link href="/css/bulma-calendar.min.css" rel="stylesheet">

    <link href="/css/profile.css" rel="stylesheet">
    <link href="/css/sidebar.css" rel="stylesheet">
    <link href="/css/data_store.css" rel="stylesheet">
    <link href="/css/errors.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar" class="">
      <div class="sticky">

            <div class="sidebar-header">
                <h2>Search</h2>
            </div>

            <div class="search_bar">
                <p class="control has-icons-left">
                    <input class="input is-small is-rounded" type="text" name="somethingrandom" id="somethingrandom" placeholder="search">
                    <span class="icon is-small is-left">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </span>
                </p>
            </div>

            <div class="tags">
              <div id="tag_list">
                  @foreach($data['tags'] as $tag)
                    <span class="tag search-tag is-medium is-info" data-name="{{ json_decode($tag, true)['en'] }}">
                      {{ json_decode($tag, true)['en'] }}
                      <button class="delete is-small" style="display:none;"></button>
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
    </nav>

    <!-- Page Content -->
    <div id="content">

        <span class="icon is-large" id="sidebarCollapse">
            <i class="fas fa-search"></i>
        </span>

        <home :user="user" inline-template id="staff_template">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-12 d-none" id="error_box">

                      <div class="notification is-danger">
                        <button class="delete"></button>
                        <p id="error_message"></p>
                      </div>

                    </div>

                    <div class="col-md-12 col-lg-2 justify-content-center">
                        <div class="profile_picture">
                            <figure class="image card-image is-128x128" id="profile_img">
                                <img class="is-rounded" src="/storage/storage/uploads/qf96SQdhxRm4EidBCnW1DUmVb99mvWiAFbobBMvG.jpeg">
                            </figure>
                        </div>
                    </div>

                    <div class="col-6 company_name">
                        <p class="title is-1 company_name">Susan Boyle</p>
                        <p>Marketing agent</p>
                        <div>
                          <ul class="contact_list">
                            <li class="contact_item"><i class="fab fa-linkedin contact_icon"></i></li>
                            <li class="contact_item"><i class="fas fa-phone contact_icon"></i></li>
                            <li class="contact_item"><i class="fas fa-envelope contact_icon"></i></li>
                            <li class="contact_item"><i class="fas fa-home contact_icon"></i></li>
                          </ul>
                        </div>

                    </div>
                </div>

                <div class="row justify-content-center info_table" id="data_store">

                    <div class="col-8">

                        <div class="row">
                          <div class="col-8">
                            <div class="tabs">
                              <ul>
                                <li class="is-active" id="data_store_link"><a>Data store</a></li>
                                <li><a>Timeline</a></li>
                                <li><a id="calendar_link">Calendar</a></li>
                                <li><a>Analytics</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-4" style="text-align: right; padding-right: 5%;">
                            <a class="button is-primary is-rounded is-outlined" id="group_btn">Select</a>
                          </div>
                        </div>
                        
                          <div class="row" id="items_grid">
                            <div class="grid-item notification data-item is-primary">
                              <a href="/company/item/create">
                              <p class="title"><i class="fas fa-plus"></i></p>
                              <p class="subtitle">Add data</p>
                              </a>
                            </div>
                            <div class="grid-item notification data-item is-warning">
                              <a href="/company/item/create?locked=true">
                              <p class="title"><i class="fas fa-lock"></i></p>
                              <p class="subtitle">Add to vault</p>
                              </a>
                            </div>
                            <div id="search_results">

                                @foreach($data['items'] as $item)

                                  @if($item->encrypted === 0)

                                    @if($item->type === 'Text')
                                      
                                      <div class="notification data-item is-info copy_btn grid-item grid-item--height2">
                                        <p class="title item-title">{{ $item->name }}</p>
                                        <p class="subtitle item-text">{!! $item->text_value !!}</p>
                                        <input id="{{ $item->id }}" name="{{ $item->id }}" type="checkbox" data-name="{{ $item->name }}" data-value="{{ $item->text_value}}" class="select_box d-none checkbox__input"/>
                                        <label class="select_box d-none" for="{{ $item->id }}"></label>
                                      </div>
                                     
                                    @elseif($item->type === 'Image')

                                      <div class="notification data-item is-info grid-item">
                                        <p class="title item-title">{{ $item->name }}</p>
                                        <img class="" src="/storage/{{ $item->image_path }}" style="max-width: 50%;"></img>
                                      </div>

                                    @else

                                      <div class="notification data-item is-info grid-item grid-item--height3">
                                        <p class="title item-title">{{ $item->name }}</p>
                                        <p class="locked_icon"><i class="fas fa-file-alt"></i></p>
                                      </div>

                                    @endif

                                  @else

                                    @if($item->type === 'Text')
                                      
                                    <div class="notification data-item is-warning vault_item grid-item grid-item--height3" data-value="{{ $item->text_value}}" data-id="{{ $item->id }}">
                                      <div class="content">
                                        <p class="title">{{ $item->name }}</p>
                                        <div class="content">
                                            <p class="locked_icon"><i class="fas fa-lock"></i></p>
                                        </div>
                                        <input id="{{ $item->id }}" name="{{ $item->id }}" type="checkbox" data-name="{{ $item->name }}" data-value="{{ $item->text_value}}" class="select_box checkbox__input d-none"/>
                                        <label class="select_box d-none" for="{{ $item->id }}"></label>
                                      </div>
                                    </div>

                                    @else

                                      <div class="notification data-item is-warning vault_item grid-item grid-item--height3" data-value="{{ $item->text_value}}">
                                        <div class="content">
                                          <p class="title">{{ $item->name }}</p>
                                          <div class="content">
                                              <p class="locked_icon"><i class="fas fa-lock"></i></p>
                                          </div>
                                        </div>
                                      </div>

                                    @endif

                                  @endif

                                @endforeach

                                </div>
                          </div>
                          </div>

                        </div>
                      </div>
                </div>
            </div>
        </home>
    </div>
</div>

<div id="copy_area" style="display:none;">
    <a class="button is-primary is-large is-rounded" id="select_btn">Select</a>
</div>

<div class="modal" id="text_modal">
    <div class="modal-background is-warning"></div>
    <div class="modal-card">
        <section class="modal-card-body">
            <div id="encrypted_area">
              <p class="title is-3 modal_title">Unlock the vault</p>
              <p class="locked_icon"><i class="fas fa-lock"></i></p>
              <input class="input vault_password" type="password" placeholder="Password" id="vault_password">
              <div class="submit_vault_password">
                <button class="button is-medium is-warning copy vault_unlock_btn" id="vault_submit">Unlock</button>
              </div>
            </div>
            <div id="decrypted_answer" style="display: none;">
              <p class="locked_icon"><i class="fas fa-lock-open"></i></p>
              <p class="title is-3 modal_title" id="answer"></p>
              <p class="title is-3 modal_title d-none" id="wrong_password_message">Oops! Wrong password</p>
              <div class="correct_password" style="display: none;">
                <div class="copy_vault_value">
                  <button class="button is-medium is-warning copy vault_copy_btn" id="vault_copy">Copy</button>
                </div>
                <div class="change_vault_password">
                  <button class="button is-medium is-warning copy vault_password_btn" id="vault_password_btn">Change password</button>
                </div>
              </div>
              <div class="wrong_password" style="display: none;">
                <input class="input vault_password" type="password" placeholder="Password" id="vault_password_again">
                <div class="submit_vault_password">
                  <button class="button is-medium is-warning copy vault_unlock_btn" id="vault_submit_again">Try again</button>
                </div>
              </div>
              <div id="new_password_box" style="display: none;">
                  <input class="input vault_password" type="password" placeholder="Password" id="vault_new_password">
                  <div class="submit_vault_password">
                      <button class="button is-medium is-warning copy vault_unlock_btn" id="vault_new_submit">Submit</button>
                  </div>
              </div>
            </div>
        </section>
    </div>
</div>

<div class="modal" id="select_modal">
    <div class="modal-background is-warning"></div>
    <div class="modal-card">
        <section class="modal-card-body">
            <p class="title is-3 modal_title">Copy/Edit items</p>

            <ul id="selected_list">
            </ul>

            <span>
                <a class="button is-success is-large is-rounded" id="copy_btn">Copy</a>
                <a class="button is-success is-large is-rounded" id="copied_btn" style="display: none;">Copied!</a>
            </span>
            <span>
                <a class="button is-primary is-large is-rounded" id="add_tag_btn">Add tags</a>
            </span>
        </section>
    </div>
</div>

<div class="modal" id="add_tags_modal">
    <div class="modal-background is-warning"></div>
    <div class="modal-card">
        <section class="modal-card-body">
            <p class="title is-3 modal_title">Add tags</p>

            <ul id="selected_item_list">
            </ul>

            <div class="tags">
              <div id="modal_tag_list">
                  @foreach($data['tags'] as $tag)
                    <span class="tag add-tags added-tag is-medium is-info" data-name="{{ json_decode($tag, true)['en'] }}">
                      {{ json_decode($tag, true)['en'] }}
                      <button class="delete is-small" style="display:none;"></button>
                    </span>
                  @endforeach
              </div>

              <span class="tag is-medium is-info is-outlined" id="modal_new_tag_form">
                <input id="modal_new_tag_input" type="text" placeholder="Add new tag">
                <a class="delete is-small" style="display:none;"></a>
              </span>
              <span class="icon is-medium" id="modal_new_tag_icon">
                  <i class="fas fa-plus"></i>
              </span>
            </div>

            <span>
                <a class="button is-primary is-large is-rounded" id="add_tags_submit">Add tags</a>
            </span>
        </section>
    </div>
</div>
@endsection

@section('javascripts')
    <script src="/js/bulma-calendar.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>

    <!-- <script type="text/javascript" src="/js/data_store.js"></script> -->
    <script type="text/javascript" src="/js/sidebar.js"></script>
    <script type="text/javascript" src="/js/profile_modals.js"></script>
    <script type="text/javascript" src="/js/search_items.js"></script> 
    <script type="text/javascript" src="/js/encryption.js"></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
@endsection