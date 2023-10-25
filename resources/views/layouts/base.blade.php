<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UERC</title>
    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
  
    <link 
    href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
    rel="stylesheet"  type='text/css'>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <!-- Scripts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://kit.fontawesome.com/6a386fc5ed.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body{
            height: 100vh
        }
        button{
            background-color:transparent;
            border:none
        }
        li{
            text-decoration:none;
            line-height:30px;
            list-style: none
        }

        a{
            text-decoration: none;
            font-family: 'Open Sans', sans-serif;
        }
      
        .dashboard-body{
            background-color: #e6e6e6;
        }
  
  
  #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2); /* Background with less opacity (adjust the alpha value as needed) */
            display: none; /* Initially hidden */
            justify-content: center;
            align-items: center;
            z-index: 6000; /* Lower z-index for the background overlay */
        }

        .spinner-border {
            z-index: 6100; /* Higher z-index for the spinner */
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
 
 
    </style>
   @livewireStyles
</head>
<body class="<?php echo str_contains(request()->url(), '/dashboard') ? 'dashboard-body' : '' ?>">
 
    <div id="app">
        @include('layouts.navbar') 

         @if(Auth::user())
            @include('layouts.sidebar')
            @include('layouts.profile')
         @endif   

    <main class="py-4">
        @yield('content')
        @isset($slot)
            <div class="content">
             
                @if(session()->get('message'))
                    <div class="alert alert-success" id="alert_close">
                        <div class="row py-2">
                            <div class="col-10">
                            <h5 class="pt-1 ps-2" style="font-family: BlinkMacSystemFont;"><strong>{{ session()->get('message') }}</strong></h5>
                            </div>     
                        
                        <div class="col-2 text-end">
                            <button onclick="close_alert()" class="text-muted" type="button" style="border:none; background-color:transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                                </button>
                        </div>
                        </div>
                    
                    </div>
                @endif
            {{ $slot }}
            </div>
        @endisset
    </main>
    </div>

  <div id="loader">
        <div class="spinner-border text-primary d-none" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
<script>
     // Function to show the loader
        function showLoader() {
            document.getElementById("loader").style.display = "flex";
            document.querySelector("#loader .spinner-border").classList.remove("d-none");
        }

        // Function to hide the loader
        function hideLoader() {
            document.getElementById("loader").style.display = "none";
            document.querySelector("#loader .spinner-border").classList.add("d-none");
        }

        // Attach an event handler to a button or trigger the request in any way you want
        function loadTrigger(link){
            
      
            // Show the loader when the request starts
            showLoader();

            setTimeout(function () {
        window.location.href = link; // Replace with your desired URL
    }, 0); // Adjust the delay as needed
        }
       

  function protocol_function(){

    $('#protocol_form').submit();
  }
  function ongoing_function(){
    $("#ongoing_form").submit();
  }
  function returned_function(){
    $("#returned_form").submit();
  }
  function terminated_function(){
    $("#terminated_form").submit();
  }
  function typeOfReview_function(){
    $("#typeOfReview_form").submit();
  }
  function firstProtocolType_function(){
    $("#firstProtocolType_form").submit();
  }
  function finalProtocolType_function(){
    $("#finalProtocolType_form").submit();
  }
  function completed_function(){
    $("#completed_form").submit();
  }
  function myProtocolType_function(){
    $("#myProtocolType_form").submit();
  }
function formTrigger(id){
    $("#userProtocols_form"+id).submit();
    
 }  

function close_alert(){
    document.getElementById("alert_close").style.display = "none";
}    
function modal_toggle(){
    $('.background-modal').toggle();
}

function protocol_function(){
    $('#protocol_form').submit();
}

function delete_function(id, text, url, type){
Swal.fire({
title: 'Are you sure?',
text: text,
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
    if (result.isConfirmed) {
    $.ajax({
        type: "get",
        url: url+id,
        success: function (response) {
            Swal.fire(
            'Deleted!',
            type+' has been deleted.',
            'success'
            ).then(
            function(){ 
            location.reload();
        })
        }
    });
    }
})
}
</script>
    @livewireScripts
</body>
</html>
