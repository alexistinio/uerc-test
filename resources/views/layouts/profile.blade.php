        <style>
        #profile{
             width: 600px;
                background-color: white;
                border-radius: 8px;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
        }
            @media only screen and (max-width: 680px) {
                #profile {
                      width: 540px;
                }
            @media only screen and (max-width: 580px) {
                #profile {
                      width: 470px;
                }
        </style>
        
        <div class="background-modal"
                style="
            height: 100%;
            width: 100vw;
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            z-index: 2000;
            display: none
            ">
            <div id="profile" class="text-light text-center position-fixed pb-5">
                <div class="mt-3 me-3 text-end">
        
                    <svg onclick="modal_toggle()" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg>
                </div>
                <div>
         
                   <img src="{{ auth()->user()->profile_image == null ? 'profile/default-profile.jpeg' : auth()->user()->profile_image }}" class="rounded-circle" alt="">

                    <div class="mt-4 fw-bold text-dark" style="font-size: 18px; font-family: Open Sans, sans-serif">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
                    @if(Auth::user()->role=="Admin")
                    <div class="text-muted" style="font-size: 16px; font-family: Open Sans, sans-serif">{{ Auth::user()->colleges }}</div>
                    @else
                    <div style="line-height: normal">
                        <div class="text-muted" style="font-size: 16px; font-family: Open Sans, sans-serif">{{  (str_contains(Auth::user()->courses, "College")) ? '' : 'BS' }} {{ Auth::user()->courses }}</div>
                        <div class="text-muted" style="font-size: 16px; font-family: Open Sans, sans-serif">{{ Auth::user()->colleges }}</div>
                    </div>
              
                    @endif
                </div>
                <hr class="mx-4" style="color: gray">
                    <div class="px-5">
                        <div class="text-primary mt-4 d-flex justify-content-between align-items-center" style="font-size: 18px; font-family: Open Sans, sans-serif; font-weight: 800">
                          <div class="">Contact Information</div>
                          <a href="/edit_profile" class="btn btn-primary">Edit Profile</a>
                        </div>
                        <div class="text-primary text-start mt-4" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 600">Email Address:</div>

                        <div class="text-dark text-start" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 400">{{ Auth::user()->email }}</div>

                        <div class="text-primary text-start mt-4" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 600">Phone Number:</div>
                        <div class="text-dark text-start" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 400">{{ Auth::user()->phone_number }}</div>

                        <div class="text-primary text-start mt-4" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 600">Account Created:</div>
                        <div class="text-dark text-start" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 400">{{ date('M d, Y', strtotime(Auth::user()->created_at)) }}</div>
                    </div>
            </div>
        </div>