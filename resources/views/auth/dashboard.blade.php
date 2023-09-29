<x-dashboard>
    <div class="main-wrapper chat-bg">



        <div class="header">
            <div class="top-profile">
                <a href="profile.html" class="profile">
                    <span class="avatar"><img
                            src="{{ auth()->user()->profile_img ? Storage::url(auth()->user()->profile_img) : asset('assets/img/avatar-1.jpg') }}"
                            alt></span>
                    Hi, {{ auth()->user()->name }}
                </a>
                <div class="search">
                    <a href="{{ route('dashboard') }}#" class="search-icon"><img src="assets/img/icons/search.png"
                            alt></a>
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="true"><img
                            src="assets/img/icons/hamburger-icon.svg" alt></a>
                    <div class="dropdown-menu dropdown-menu-end header_drop_icon">
                        <a href="#" class="dropdown-item">New Group</a>
                        
                        <a href="{{ route('settings') }}" class="dropdown-item">Settings</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
                <div class="search_chat has-search">
                    <span class="fas fa-search form-control-feedback"></span>
                    <span class="close-search"><i class="far fa-times-circle"></i></span>
                    <input class="form-control chat_input" id="search-contact" type="text" placeholder>
                </div>
            </div>
            <ul class="navbar">
                <li class="nav-item">
                    <a class="nav-link camera-icon" href="#">
                        <img src="assets/img/icons/camera.png" alt>
                    </a>
                    <input type="file" name="photo" class="custom-file-upload" />
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="chat.html">Chat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="group.html">Group</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="status.html">Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="call.html">Call</a>
                </li>
            </ul>
            <div class="add-new-btn">
                <a href="{{ route('chat_new') }}"><i class="fas fa-plus"></i></a>
            </div>
        </div>

        <div class="chat-list-col">
            <div class="container">
                <div class="person-list">
                    <ul>

                        @foreach ($conversation as $convers)
                            @if ($convers->receiver_id == auth()->user()->id)
                                @php
                                    $senderId = $convers->user->id;
                                    $unreadCount = $unreadCountsMap[$senderId] ?? 0;
                                @endphp
                                <li class="person-list-item col-12">
                                    <a href="{{ route('message.view', $convers->user->id) }}">
                                        <div
                                            class="avatar {{ $convers->user->isOnline() ? 'avatar-online' : 'avatar-offline' }}">
                                            <img src="{{ $convers->user->profile_img ? Storage::url($convers->user->profile_img) : asset('assets/img/avatar-1.jpg') }}"
                                                width="48" alt>
                                        </div>
                                        <div class="person-list-body">
                                            <div>

                                                <h5>{{ $convers->user->name }}</h5>
                                               @if ($convers->message)
                                                @if ($convers->message->image)
                                                <p class="{{ $convers->message->read==1 ? 'read' : " " }}"><i class="fa fa-image me-2"></i>Photo</p>
                                                @else
                                                <p class="{{ $convers->message->read==1 ? 'read' : " " }}">
                                                    {{ $convers->message->message }}
                                                </p>
                                                @endif
                                                @else 
                                                <h6 class="">
                                                    Message Deleted
                                                </h6> 
                                                @endif
                                            </div>
                                            <div class="last-chat-time"><small
                                                    class="text-muted">{{ $convers->created_at->diffForHumans() }}</small>
                                            </div>

                                            <div class=" text-white d-flex align-item-center justify-content-center ms-4"
                                                style="height: 20px;width:20px; {{ $unreadCount == 0 ? '' : 'background:#6f42c1' }}; border-radius:100%;">
                                                <i class="mt-auto">{{ $unreadCount == 0 ? ' ' : $unreadCount }}</i>
                                            </div>

                                        </div>
                                    </a>
                                </li>
                            @else
                                @php
                                    $senderId = $convers->users->id;
                                    $unreadCount = $unreadCountsMap[$senderId] ?? 0;
                                @endphp
                                <li class="person-list-item col-12">
                                    <a href="{{ route('message.view', $convers->users->id) }}">
                                        <div
                                            class="avatar {{ $convers->users->isOnline() ? 'avatar-online' : 'avatar-offline' }} ">
                                            <img src="{{ $convers->users->profile_img ? Storage::url($convers->users->profile_img) : asset('assets/img/avatar-1.jpg') }}"
                                                width="48" alt>
                                        </div>
                                        <div class="person-list-body">
                                            <div>
                                                <h5>{{ $convers->users->name }}</h5>
                                                @if ($convers->message)
                                                @if ($convers->message->image)
                                                <p class="{{ $convers->message->read==1 ? 'read' : " " }}"><i class="fa fa-image me-2"></i>Photo</p>
                                                @else
                                                <p class="{{ $convers->message->read==1 ? 'read' : " " }}">
                                                    {{ $convers->message->message }}
                                                </p>
                                                @endif 
                                                @else 
                                                <h6 class="">
                                                    Message Deleted
                                                </h6> 
                                                @endif
                                               
                                            </div>
                                            <div class="last-chat-time"><small
                                                    class="text-muted">{{ $convers->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class=" text-white d-flex align-item-center justify-content-center ms-4"
                                                style="height: 20px;width:20px; {{ $unreadCount == 0 ? '' : 'background:#6f42c1' }}; border-radius:100%;">
                                                <i class="mt-auto">{{ $unreadCount == 0 ? ' ' : $unreadCount }}</i>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
