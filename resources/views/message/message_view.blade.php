<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamschat.dreamguystech.com/mobile/template-bootstrap/chat.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 10:44:49 GMT -->

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




    <div class="header header-small">
        <div class="top-profile">
            <div class="profile">
                <a href="{{ route('dashboard') }}" class="back-btn"><img src="assets/img/icons/arrow.png" alt></a>
                <a href="{{ route('friend_profile',$user->id) }}" class="profile">
                    <span class="avatar"><img src="{{$user->profile_img ? Storage::url($user->profile_img) : asset('assets/img/avatar-1.jpg') }}" alt></span>
                    {{ $user->name }}
                </a>
            </div>
            <div class="search call-action">
                <a href="video-call.html"><img src="assets/img/icons/video.png" alt></a>
                <a href="voice-call.html"><img src="assets/img/icons/call.png" alt></a>
            </div>
        </div>
    </div>




    <div class="main-wrapper messages-content chat-bg" style="margin-bottom:800px!important;">
        <div class="messages p-6">

            @foreach ($message as $messages)
                @if ($messages->sender_id != auth()->user()->id)
                    <div class="message message-received message-first message-last message-tail">
                        <div class="message-content">

                            <div class="message-bubble">
                                @if ($messages->image)
                                    <img class="ms-1" src="{{ Storage::url($messages->image) }}"
                                        style="width: 120px;height: 120px;" alt="">
                                @endif
                                <div class="message-text">{{ $messages->message }}</div>
                            </div>
                            <div class="message-footer">{{ $messages->created_at->format('F d') }},
                                {{ $messages->created_at->format('h:i:A') }}</div>

                        </div>
                    </div>
                @else
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form action="{{ route('update_message') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" name="message" value="{{ $messages->id }}"
                                            style="width: 100%">
                                        <input type="hidden" name="message_id" style="width: 100%">
                                        @error('message')
                                            <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
        </div>
        <!-- Modal -->

        <div class="message message-sent message-first mb-4">
            <div class="message-content">

                <div class="message-bubble">
                    @if ($messages->image)
                        <img class="ms-3" src="{{ Storage::url($messages->image) }}"
                            style="width: 120px;height: 120px;" alt="">
                    @endif
                    <div class="message-text" id="message-content-{{ $messages->id }}">
                        {{ $messages->message }}</div>
                </div>
                <div class="message-footer">{{ $messages->created_at->format('F d') }},
                    {{ $messages->created_at->format('h:i:A') }} <img
                        src="{{ $messages->read == 0 ? asset('assets/img/icons/gray-tick.png') : asset('assets/img/icons/green-tick.png') }}"
                        alt></div>
                <div class="message-options d-flex">
                    <div>
                        <button class="edit-button" data-bs-toggle="modal" data-message-id="{{ $messages->id }}"
                            data-bs-target="#exampleModal">Edit</button>
                    </div>
                    <form action="{{ route('message.delete', $messages->id) }}" method="POST">
                        @csrf
                        <button class="delete-button" type="submit"
                            data-message-id="{{ $messages->id }}">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @endforeach

    </div>
    <div class="toolbar messagebar mt-4" id="">
        <div class="toolbar-inner">

            <form action="{{ route('send_msg', $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="messagebar-area">
                    <textarea style="border: none!important" name="message" placeholder="Type your message"></textarea>
                    @error('message')
                        <p style="color:red;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="media-buttons">
                    <ul>
                        <li>
                            <button style="background: transparent;border:none; color:ache" type="submit"><i
                                    class="fa fa-paper-plane" style="font-size:22px;"></i></button>
                        </li>
                        <li>
                            <a href="#"><img src="assets/img/icons/attachment.png" alt></a>
                            <input type="file" name="" class="custom-file-upload" />
                        </li>
                        <li>
                            <a href="#"><img src="assets/img/icons/camera-gray.png" alt></a>
                            <input type="file" name="image" class="custom-file-upload" />
                        </li>

                    </ul>
                </div>
            </form>
        </div>
    </div>
    </div>



    <script>
        window.onload = function() {

            window.scrollTo(0, document.body.scrollHeight);
            const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get the message ID from the data attribute
                    const messageId = this.getAttribute('data-message-id');

                    // Get the message content based on the message ID
                    const messageContent = document.getElementById(`message-content-${messageId}`)
                        .textContent;

                    // Populate the modal input field with the message content
                    const modalInput = document.querySelector('#exampleModal input[name="message"]');
                    const modalId = document.querySelector('#exampleModal input[name="message_id"]');
                    modalInput.value = messageContent;
                    modalId.value = messageId;
                });
            });
        };
    </script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>
