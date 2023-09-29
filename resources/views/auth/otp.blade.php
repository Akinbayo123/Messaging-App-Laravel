<x-layout>
    <div class="main-wrapper login-page">
        <div class="container">
            
            @if( session()->has('message'))
            <div class="alert alert-secondary fs-6 fw-bold text-center alert-dismissible fade show" style="color: black" role="alert">
                {{ session()-> get('message') }}
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
                <span>Waiting to automatically detect and OTP send to </span><br><br>
                <span>Enter 6 digit OTP</span>
            </div>
            
            <div class="login-form">
                <form class="list" id="login-form" method="POST" action="{{ route('verifiedOtp') }}">
                    @csrf
                    <ul>
                        <input type="hidden" name="email" value="{{ $email }}">
                        <li>
                            <div class="input text-center">
                                <input id="partitioned" name="otp" type="text" maxlength="6" placeholder="••••••" onKeyPress="if(this.value.length==6) return false;" />
                            </div>
                        </li>
                    </ul>
                    
                    <h6 class="otp-text">Did’nt receive the code? <a href="{{ route("resendOtp",$email) }}">RESEND CODE</a></h6>

                    <div class="bottom-submit">
                        <div class="left">
                           
                        </div>
                        <div class="right">
                            <button type="submit" class="submit-btn"><img src="assets/img/icons/arrow.png" alt></button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

</x-layout>