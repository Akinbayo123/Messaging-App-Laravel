<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamschat.dreamguystech.com/mobile/template-bootstrap/settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 10:45:11 GMT -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <title>DreamsChat - HTML Mobile Template</title>
<base href="/public">
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
                    <a href="{{ route('dashboard') }}" class="back-btn"><img src="assets/img/icons/arrow.png" alt></a>
                    Settings
                </div>
            </div>
        </div>

        <div class="settings-col">
            <div class="container">
                <div class="top-profile status-top-profile without-circle">
                    <div class="profile">
                        <div class="avatar">
                            <img src="{{auth()->user()->profile_img ? Storage::url(auth()->user()->profile_img) : asset('assets/img/avatar-1.jpg') }}" alt>
                        </div>
                        <a href="profile.html" class="profile-details">
                            <span class="main-title">{{ auth()->user()->name }}</span>
                            <span class="sub-title">{{ auth()->user()->status ? auth()->user()->status :"I'm new here" }}</span>
                        </a>
                    </div>
                </div>
                <div class="settings-details">
                    <ul>
                        <li><a href="{{ route('account') }}"><span><i class="fas fa-key"></i></span> Account</a></li>
                        <li><a href="chat-settings.html"><span><i class="far fa-envelope"></i></span> Chat</a></li>
                        <li><a href="notifications.html"><span><i class="fas fa-bell"></i></span> Notifications</a></li>
                        <li><a href="invite-friends.html"><span><i class="fas fa-users"></i></span> Invite friends</a>
                        </li>
                        <li><a href="about-help.html"><span><i class="fas fa-question-circle"></i></span> About and
                                help</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from dreamschat.dreamguystech.com/mobile/template-bootstrap/settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 10:45:12 GMT -->

</html>
