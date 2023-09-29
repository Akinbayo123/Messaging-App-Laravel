<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamschat.dreamguystech.com/mobile/template-bootstrap/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 10:45:02 GMT -->

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

    <link rel="stylesheet" href="assets/plugins/swiper/css/swiper.min.css">

    <link rel="stylesheet" href="assets/plugins/fancybox/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="account-profile">
            <div class="container">
                <div class="top-profile">
                    <div class="profile">
                        <a href="{{ route('message.view', $user->id) }}" class="back-btn"><img
                                src="assets/img/icons/arrow.png" alt></a>
                    </div>
                </div>
                <div class="profile-picture">
                    <img src="{{ $user->profile_img ? Storage::url($user->profile_img) : asset('assets/img/avatar-1.jpg') }}"
                        alt>
                </div>
                <div class="name-details">
                    <h4>{{ $user->name }}</h4>
                    <span class="seen-details">Last seen today at 04:18 PM</span>
                </div>

            </div>
        </div>

        <div class="media-section">
            <div class="container">
                <div class="media-col">
                    <div class="title-col">
                        <h6>Media</h6>
                        <span class="media-details"> <i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($media as $medias)
                            @if ($medias->image)
                                <div class="swiper-slide">
                                    <a href="{{ Storage::url($medias->image) }}" data-fancybox="images"><img
                                            src="{{ Storage::url($medias->image) }}" alt></a>
                                </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="drop-down-col">
                    <ul>
                        <li class="pt-2">
                            <label>Status</label>
                            <p>{{ $user->status ? $user->status : "I'm new here" }}</p>
                        </li>
                    </ul>
                </div>
                <div class="drop-down-col">
                    <ul>
                        <li>
                            <label>Name</label>
                            <p>{{ $user->name }}</p>
                        </li>
                    </ul>
                </div>
                <div class="drop-down-col">
                    <ul>
                        <li>
                            <label>Phone Number</label>
                            <p>{{ $user->phone }}</p>
                        </li>
                    </ul>
                </div>
                <div class="drop-down-col">
                    <ul>
                        <li>
                            <label>Last seen</label>
                            <p>Today</p>
                        </li>
                    </ul>
                </div>
                <div class="drop-down-col">
                    <ul>
                        <li>
                            <label>Email</label>
                            <p>{{ $user->email }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/swiper/js/swiper.min.js"></script>

    <script src="assets/plugins/fancybox/js/jquery.fancybox.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from dreamschat.dreamguystech.com/mobile/template-bootstrap/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 10:45:10 GMT -->

</html>
