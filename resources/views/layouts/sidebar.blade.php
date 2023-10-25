<style>
.active{
      background-color: <?php echo (Auth::user()->role == 'Admin') ? '#353b48' : '#3c6090' ?>;
      color: white
}

.side-bar{
    position: fixed;
    top:70px;
    width:260px;
    height: 100%;
    background: <?php echo (Auth::user()->role == 'Admin' || Auth::user()->role == 'Admin') ? '#031e23' : '#2d486c' ?>; /* #2f3640 */



}

.side-bar header{
  
    text-align:center;
    padding:10px;
    background: #063146;
}

.side-bar ul a{
    text-decoration: none;
    display: block;
    height:100%;
    width: 100%;
    line-height: 55px;
    color: <?php echo (Auth::user()->role == 'Admin') ? '#e6e6e6' : 'white' ?>;
    padding-left: 9px;
    margin: 4px 0;
    box-sizing: border-box;
    font-family: "Roboto","Arial",sans-serif;
    font-weight: 300;
    font-size: 15px;
    
}

.side-bar ul a:hover{
    background-color: <?php echo (Auth::user()->role == 'Admin') ? '#353b48' : '#3c6090' ?>;

    
}

.side-bar ul{
  
    margin:0;
    padding: 0;
    list-style: none;
    color: white;
    cursor: pointer;
  
    
}

.mobile-sidebar{
    position:fixed;
    z-index:2999;
    top:62px; 
    height:100%;
    background-color:black;
    display: none;   

}
.mobile-sidebar ul a{
   
    color: white;
    font-family: Inter, sans-serif; 

    font-size: 16px
}

.mobile-sidebar li{
    text-decoration:none;
    line-height:70px;
    background-color:black;
}

.mobile-active{
    border-bottom:1px solid skyblue ;
    padding: 10px 0px
}

.mobile-sidebar ul a:hover{
   
   text-decoration: none;
}


@media only screen and (max-width: 1300px) {
    .side-bar {
        display: none
    }
  }


@media only screen and (min-width: 1300px) {
    .mobile-sidebar {
        left:-2800px;
        }
    }
</style>
@if (Auth::user())  
<div class="side-bar">
<ul class="py-1">

    <li class="{{ 'dashboard' == request()->path() ? 'active' : ''}}">
        <a onclick="loadTrigger('/dashboard')">
         <div class="d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-house-door" style="margin-top: 15px" viewBox="0 0 16 16">
                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
            </svg>
            <div style="<?php echo 'dashboard' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">Dashboard</div>
         </div>
        </a>
    </li>
    @if (Auth::user()->role == 'Admin')  
    <li class="{{ 'user_management' == request()->path() ? 'active' : ''}}{{ 'add_user' == request()->path() ? 'active' : ''}}{{ 'edit_user' == request()->path() ? 'active' : ''}}">
        <a onclick="loadTrigger('/user_management')">
        <div class="d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" style="margin-top: 15px" class="bi bi-person-workspace" viewBox="0 0 16 16">
                <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
            </svg>
            <div style="<?php echo 'user_management' == request()->path() ? 'font-weight: 400' : ''?>"  class="ms-4">User Management</div>
         </div>
        </a>
    </li>
    <li class="<?php echo str_contains(request()->path(), 'protocol_codes') ? 'active' : '' ?>">
        <a onclick="loadTrigger('/protocol_codes')">
        <div class="d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" style="margin-top: 15px" class="bi bi-file-code" viewBox="0 0 16 16">
                <path d="M6.646 5.646a.5.5 0 1 1 .708.708L5.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zm2.708 0a.5.5 0 1 0-.708.708L10.293 8 8.646 9.646a.5.5 0 0 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2z"/>
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
             </svg>
            <div style="<?php echo 'protocol_codes' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">Protocol Codes</div>
         </div>
        </a>
    </li>
    @endif
    <li class="<?php echo str_contains(request()->path(), 'researcher_management') || str_contains(request()->path(), 'edit_researcher') 
    || str_contains(request()->path(), 'add_researcher') ? 'active' : '' ?>">
        <a onclick="loadTrigger('/researcher_management')">
        <div class="d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" style="margin-top: 15px" height="26" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
            </svg>
            <div style="<?php echo 'researcher_management' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">Researchers</div>
         </div>
        </a>
    </li>
    <li>
        <a onclick="loadTrigger('/protocol_management')" class="<?php echo str_contains(request()->path(), 'protocol_management') ? 'active' : '' ?>">
        <div class="d-flex align-items-center justify-content-between">
            
        <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-journals" viewBox="0 0 16 16">
                <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>
                <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z"/>
            </svg>
            <div style="<?php echo 'protocol_management' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">Protocol Management</div>
        </div>
        <div class="pe-3">
            @if(!str_contains(request()->url(), 'protocol_management'))
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
            </svg>
            @else
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
            </svg>
            @endif
        </div>
          
              
        </div>
        </a>
        @if(str_contains(request()->url(), 'protocol_management') || str_contains(request()->url(), 'myprotocols') || str_contains(request()->url(), 'administrator'))
        <ul>
            <li class="<?php echo str_contains(request()->url(), 'protocol_management') && !str_contains(request()->url(), 'myprotocols') && !str_contains(request()->url(), 'admin') && !str_contains(request()->url(), 'protocols') ? 'active' : '' ?>">
                <a onclick="loadTrigger('/protocol_management')">
                <div class="d-flex align-items-center px-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                    </svg>
                    <div style="<?php echo 'protocol_management' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">Protocols</div>
                </div>
                </a>
            </li>
            <li class="<?php echo str_contains(request()->url(), 'myprotocols') ? 'active' : '' ?>">
                <a onclick="loadTrigger('/myprotocols')">
                <div class="d-flex align-items-center px-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                    </svg>
                    <div style="<?php echo 'protocol_management' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">My Protocols</div>
                </div>
                </a>
            </li>
        </ul>
        @endif
    </li>

    <li class="<?php echo str_contains(request()->path(), 'board_member_mgt') || str_contains(request()->path(), 'create_board_member') || 
    str_contains(request()->path(), 'edit_board_member') ? 'active' : '' ?>">
        <a onclick="loadTrigger('/board_member_mgt')">
        <div class="d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" style="margin-top: 15px" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
            </svg>
            <div style="<?php echo 'board_member_mgt' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">Board Members</div>
         </div>
        </a>
    </li>
 
    @if(Auth::user()->role=='Admin')
    <li class="<?php echo str_contains(request()->path(), 'drive') ? 'active' : '' ?>">
        <a onclick="loadTrigger('/drive')">
        <div class="d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" style="margin-top: 15px" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v6zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z"/>
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
            </svg>
            <div style="<?php echo 'drive' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">UERC Meetings</div>
         </div>
        </a>
    </li>
 
    <li class="<?php echo str_contains(request()->path(), 'reports') ? 'active' : '' ?>">
        <a onclick="loadTrigger('/reports')">
        <div class="d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" style="margin-top: 15px" fill="currentColor" class="bi bi-database-fill" viewBox="0 0 16 16">
                <path d="M3.904 1.777C4.978 1.289 6.427 1 8 1s3.022.289 4.096.777C13.125 2.245 14 2.993 14 4s-.875 1.755-1.904 2.223C11.022 6.711 9.573 7 8 7s-3.022-.289-4.096-.777C2.875 5.755 2 5.007 2 4s.875-1.755 1.904-2.223Z"/>
                <path d="M2 6.161V7c0 1.007.875 1.755 1.904 2.223C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777C13.125 8.755 14 8.007 14 7v-.839c-.457.432-1.004.751-1.49.972C11.278 7.693 9.682 8 8 8s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                <path d="M2 9.161V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13s3.022-.289 4.096-.777C13.125 11.755 14 11.007 14 10v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                <path d="M2 12.161V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
             </svg>
            <div style="<?php echo 'reports' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">PHREB Reporting</div>
         </div>
        </a>
    </li>
    @endif
  </ul>
  </div>   


  <div class="container-fluid">
    <div class="row">
        <div class="col justify-content-center mobile-sidebar">
        <ul>
            <div class="text-md-center fw-bold pe-4" style="font-size: 24px">
                <li><a class="{{ 'dashboard' == request()->path() ? 'mobile-active' : ''}}" href="/dashboard">Dashboard</a></li>
                @if(Auth::user()->role == 'Admin')
                <li><a class="{{ 'user_management' == request()->path() ? 'mobile-active' : ''}}{{ 'add_user' == request()->path() ? 'mobile-active' : ''}}{{ 'edit_user' == request()->path() ? 'mobile-active' : ''}}" href="/user_management">User Management</a></li>
                <li><a class="{{ 'protocol_codes' == request()->path() ? 'mobile-active' : ''}}" href="/protocol_codes">Protocol Codes</a></li>
                @endif
                <li><a class="<?php echo str_contains(request()->path(), 'researcher_management') || str_contains(request()->path(), 'edit_researcher') 
    || str_contains(request()->path(), 'add_researcher') ? 'mobile-active' : '' ?>"" href="/researcher_management">Researcher Management</a></li>
                
                <li><a class="{{ str_contains(request()->path(), 'protocol_management') ||  str_contains(request()->path(), 'myprotocols') || 
                str_contains(request()->path(), 'administrator') ? 'mobile-active' : '' }}" href="/protocol_management">Protocol Management</a></li>
                
                <li class="{{ str_contains(request()->path(), 'protocol_management') ||  str_contains(request()->path(), 'myprotocols') || 
                str_contains(request()->path(), 'administrator') ? '' : 'd-none' }}">
                    <a href="/protocol_management">
                    <div class="d-flex align-items-center justify-content-md-center px-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                        </svg>
                        <div style="font-size: 14px;<?php echo 'protocol_management' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">Protocols</div>
                    </div>
                    </a>
                </li>
                <li class="{{ str_contains(request()->path(), 'protocol_management') ||  str_contains(request()->path(), 'myprotocols') || 
                str_contains(request()->path(), 'administrator') ? '' : 'd-none' }}">
                    <a href="/myprotocols">
                    <div class="d-flex align-items-center justify-content-md-center px-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                        </svg>
                        <div style="font-size: 14px;<?php echo 'protocol_management' == request()->path() ? 'font-weight: 400' : ''?>" class="ms-4">My Protocols</div>
                    </div>
                    </a>
                </li>
                <li><a class="<?php echo str_contains(request()->path(), 'board_member_mgt') || str_contains(request()->path(), 'create_board_member') || 
    str_contains(request()->path(), 'edit_board_member') ? 'mobile-active' : '' ?>" href="/board_member_mgt">Board Member Management</a></li>
                @if(Auth::user()->role=='Admin')
                <li><a class="{{ str_contains(request()->path(), 'drive') ? 'mobile-active' : ''}}" href="/drive">Meetings</a></li>
                <li><a class="{{ 'reports' == request()->path() ? 'mobile-active' : ''}}" href="/reports">PHREB Reporting</a></li>
                @endif
            </div>
            </ul>
        </div>
    </div>
  </div>
@endif