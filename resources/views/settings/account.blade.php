<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamschat.dreamguystech.com/mobile/template-bootstrap/account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 10:45:17 GMT -->

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
                    <a href="{{ route('settings') }}" class="back-btn"><img src="assets/img/icons/arrow.png" alt></a>
                    Account
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
                <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="drop-down-col">
                    <ul>
                        <li>
                            <label>Status</label>
                           <input type="input"  name="status" value="{{ auth()->user()->status ? auth()->user()->status :"I'm new here" }}" class="browser-default custom-select"></input>
                           @error('status')
                           <p style="color:red;">{{ $message }}</p>
                       @enderror
                        </li>
                    </ul>
                </div>
                <div class="drop-down-col">
                    <ul>
                        <li>
                            <label>Name</label>
                           <input type="text" name="name" value="{{ auth()->user()->name }}" class="browser-default custom-select"></input>
                           @error('name')
                           <p style="color:red;">{{ $message }}</p>
                       @enderror
                        </li>
                    </ul>
                </div>
                <div class="drop-down-col">
                    <ul>
                        <li>
                            <label>Phone Number</label>
                           <input type="text" name="phone" value="{{ auth()->user()->phone }}" class="browser-default custom-select"></input>
                           @error('phone')
                           <p style="color:red;">{{ $message }}</p>
                       @enderror
                        </li>
                    </ul>
                </div>
                <div class="drop-down-col">
                    <ul>
                        <li>
                            <label>Email</label>
                           <p class="browser-default custom-select">{{ auth()->user()->email }}</p>

                        </li>
                    </ul>
                </div>
                <div class="drop-down-col">
                    <ul>
                        <li>
                            <label>Update Profile Pics</label>
                            <div>
                                <input type="file" name="image">
                                @error('image')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                            </div>
                           
                        </li>
                    </ul>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from dreamschat.dreamguystech.com/mobile/template-bootstrap/account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 10:45:17 GMT -->

</html>
