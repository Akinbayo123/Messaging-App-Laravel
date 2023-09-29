<x-layout>

    <div class="main-wrapper login-page">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-secondary fs-6 fw-bold text-center alert-dismissible fade show"
                    style="color: black" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="login-icon">
                <div class="login-top-icon">
                    <div class="inner-top-icon">
                        <img src="assets/img/icons/login-icon.svg" alt>
                    </div>
                </div>
            </div>
            <div class="login-title">
                <span>Enter your details to register</span>
            </div>

            <div class="login-form">
                <form class="drop-down-col" id="login-form" method="POST" action="{{ route('register.save') }}">
                    @csrf
                    <ul>
                        <li class="select-language">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control item" id="email"
                                    placeholder="Name">
                            </div>
                            @error('name')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </li>

                        <li class="select-language">
                            <div class="form-group">
                                <input type="email" name="email" value="{{ @request('email') }}"
                                    class="form-control item" id="email" placeholder="Email Address">
                            </div>
                            @error('email')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </li>
                        <li class="select-language">
                            <div class="form-group">
                                <input type="number" name="phone" class="form-control item" id="phone"
                                    placeholder="Phone Number">
                            </div>
                            @error('phone')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </li>
                        <li class="select-language">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control item" id="email"
                                    placeholder="Password">
                            </div>
                            @error('password')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </li>
                        <li class="select-language">
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control item"
                                    id="email" placeholder="Confirm Password">
                            </div>
                            @error('password_confirmation')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </li>
                    </ul>
                    <div class="bottom-submit mt-3">
                        <div class="left">
                            <ul>
                                <li></li>
                                <li class="active"></li>
                            </ul>
                        </div>
                        <div class="right">
                            <button type="submit" class="submit-btn"><img src="assets/img/icons/arrow.png"
                                    alt></button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-layout>
