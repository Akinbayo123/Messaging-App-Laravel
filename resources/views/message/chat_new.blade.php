<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <title>DreamsChat - HTML Mobile Template</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="main-wrapper chat-bg">

        <div class="header header-small">
            <div class="top-profile">
                <div class="profile pt-10">
                    <a href="chat.html" class="back-btn"><img src="assets/img/icons/arrow.png" alt></a>
                    New Chat
                </div>
                <div class="search pt-10">
                    <a href="#" class="search-icon"><img src="assets/img/icons/search.png" alt></a>
                </div>
                <div class="search_chat has-search">
                    <span class="fas fa-search form-control-feedback"></span>
                    <span class="close-search"><i class="far fa-times-circle"></i></span>
                    <input class="form-control chat_input" id="search-contact" type="text" placeholder>
                </div>
            </div>
        </div>

        <div class="chat-list-col contact-list">
            <div class="container">
                <div class="person-list">
                    <ul>
                        @foreach ($user as $users)
                            
                        <li class="person-list-item col-12">
                            <div>
                                <div class="avatar">
                                    <img src="{{$users->profile_img ? Storage::url($users->profile_img) : asset('assets/img/avatar-1.jpg') }}" width="48" alt>
                                </div>
                                <div class="person-list-body align-items-center">
                                    <div>
                                        <h5>{{ $users->name }}</h5>
                                        <p class="no-read">{{ $users->status ? $users->status :"I'm new here" }}</p>
                                    </div>
                                    <div class="last-chat-time d-flex">
                                        <a href="{{ route('message.view',$users->id) }}" class="invite-link">Message</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>
