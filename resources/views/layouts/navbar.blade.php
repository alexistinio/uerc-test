<?php
    if(isset($_GET['query'])){
        $query = $_GET['query'];
      }
      else{
        $query = null;
      }

      if(isset($_GET['userType'])){
        $userType = $_GET['userType'];
        }
        else{
            $userType = 'UERC';
        }
?>

<style>
    #profileNav:active{
        color: white
    }
</style>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm w-100" style="z-index: 1001">
                <div class="container-fluid px-4 mx-auto">
                
                <div class="navbar-brand">
                <div>
                    <a id="logo" href="{{ url('/') }}"><img src="/logo/logo.jpg" width="183" height="44"></a>
                </div>
                
                <div>
                    <button type="button" id="mobile-sidebar-btn" class="mobile-sidebar-btn"><img src="/svg/navbar-collapse.svg" alt=""></button>
                </div>
            </div>
      
            @if(str_contains(request()->path(), "user_management"))
            <div class="ms-5 d-none d-lg-block">
                    <form type="get">
                        <div class="d-flex">
                            <input type="search" style="width: 800px; height: 45px; border-radius: 65px" value="<?php echo $query ?>" class="form-control ps-3" name="query" placeholder="Search by Last Name">
                            <input type="hidden" name="userType" value="<?php echo $userType ?>">
                            <button class="ms-2" type="submit" style="border-radius: 50%; background-color: #e6e6e6; padding: 0 17px"><i class="fas fa-search"></i></button>
                            
                        </div>  
                    </form>
            </div>
            @endif
            @if(str_contains(request()->path(), "researcher_management") && !str_contains(request()->path(), "edit_researcher"))
            <div class="ms-5 d-none d-lg-block">
                    <form type="get">
                        <div class="d-flex">
                            <input type="search" style="width: 800px; height: 45px; border-radius: 65px" value="<?php echo $query ?>" class="form-control ps-3" name="query" placeholder="Search by Last Name">
                    
                            <button class="ms-2" type="submit" style="border-radius: 50%; background-color: #e6e6e6; padding: 0 17px"><i class="fas fa-search"></i></button>
                            
                        </div>  
                    </form>
            </div>
            @endif

            @if(str_contains(request()->path(), "protocol_management") || str_contains(request()->path(), "myprotocols"))
            <div class="ms-0 ms-xl-5 d-none d-lg-block">
                    <form type="get">
                        <div class="d-flex">
                            <input type="search" style="width: 800px; height: 45px; border-radius: 65px" class="form-control ps-3" value="<?php echo $query ?>" name="query" placeholder="Search by Protocol Title">
                    
                            <button class="ms-2" type="submit" style="border-radius: 50%; background-color: #e6e6e6; padding: 0 17px"><i class="fas fa-search"></i></button>
                            
                        </div>  
                    </form>
            </div>
            @endif
        
                    <div class="navbar-nav" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                        
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                            @else
                                <li onclick="changeZindex()" class="nav-item dropdown d-none d-lg-flex align-items-center">
                                   <img src="{{ auth()->user()->profile_image == null ? 'profile/default-profile.jpeg' : auth()->user()->profile_image }}" width="50" height="50" class="rounded-circle navProfile" alt="">
                                    @if(auth()->user()->role=="Admin")
                                    <a style="font-family: inherit; font-size: 16px" id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->firstname.' '.auth()->user()->lastname }} ({{ Auth::user()->role }})
                                    </a>
                                    @else
                                    <a style="font-family: inherit; font-size: 16px" id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->firstname.' '.auth()->user()->lastname }} ({{ Auth::user()->colleges }})
                                    </a>
                                    @endif
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a id="profileNav" class="dropdown-item" style="cursor: pointer" onclick="profile()">
                                            Profile
                                        </a>
                                      
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                <div class="d-flex d-lg-none">
                                    <img src="{{ auth()->user()->profile_image == null ? 'profile/default-profile.jpeg' : auth()->user()->profile_image }}" width="50" height="50" class="navProfile rounded-circle" alt="">
                                     <div class="ms-2 pt-1">
                                        <div style="font-family: inherit; font-size: 16px" class="text-dark">
                                            {{ Auth::user()->firstname.' '.auth()->user()->lastname }} ({{ Auth::user()->role=='Admin' ? 'Admin' : Auth::user()->colleges }})
                                        </div>
                                        <div class="text-end">
                                        <a style="color: blue" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        </div>
                                     
                                     </div>   
                              
                                </div>
                       
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <script>
                $(".mobile-sidebar-btn").click(function(){
                    $(".mobile-sidebar").toggle();

                
                    if ($(".mobile-sidebar").is(":visible")) {
                        $('.navbar').css('z-index','5000');
                    }
                    else{
                        $('.navbar').css('z-index','1001');
                    }
                });

                function profile(){
                    $('.background-modal').toggle();
                }
            </script>
            