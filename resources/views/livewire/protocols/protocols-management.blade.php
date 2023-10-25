<div>

@include('view.protocol_management.add_protocol')
@include('view.protocol_management.edit_protocol')

<style>
  .dropdown-menu li a:active{
    color: white !important
  }
  a {
    color: black
  }

  a:hover{
    color:inherit
  }
</style>

<div class="row px-1">
    <div class="col pt-4">
      <div style="font-size: 25px; font-family: 'Inter Tight', sans-serif; border-radius: 25px" class="btn-lg py-0">
            Protocol Management
    </div>
      <nav class="ms-3" style="--bs-breadcrumb-divider: '>'; position: relative" aria-label="breadcrumb" s>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a style="color: blue" href="/protocol_management">Protocols</a></li>
          <li class="breadcrumb-item" aria-current="page">Dashboard</li>
        
        </ol>
      </nav>
    </div>

    <div class="col-12 col-sm-6 text-center text-sm-end py-3">
        <button id="upload_protocol" data-bs-toggle="modal" data-bs-target="#modal_1" class="btn btn-primary p-3">Upload Protocol <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -3px"width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg></button>
    </div>
</div>

<div class="row text-center" style="border-top:1px solid #bdc3c7; border-bottom:1px solid #bdc3c7; box-shadow: 0px 3px 5px gray; padding: 20px 0">
    <div class="col">
    <div class="dropdown">
      <button id="" style="font-size: 23px; font-family: 'Open sans', sans-serif; border-radius: 25px; font-weight: 100" class="btn-lg dropdown-toggle py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
       {{ $status }}
      </button>
      <ul class="dropdown-menu py-3">
        <li>
          <a onclick="all_protocols()" class="dropdown-item" style="background-color: <?php echo ($approval=='all') ? '#e6e6e6' : '' ?>; cursor: pointer;">
          All Protocols
          <form class="" action="/protocol_management" method="get" name="dropdownForm" id="all_form">
              <input type="hidden" name="approval" id="approval" value="all">
        
              @if(Auth::user()->role == 'Admin')
              <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
              <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
              @endif
              <input type="hidden" name="data" value="<?php echo $data ?>">
              <input type="hidden" name="sort" value="<?php echo $sort ?>">
              <input type="hidden" name="tor" value="<?php echo $tor ?>">
           </form>
          </a>
        </li>
        <li>
          <a onclick="on_going()" class="dropdown-item" style="background-color: <?php echo ($approval=='ongoing') ? '#e6e6e6' : '' ?>; cursor: pointer">
          On-going Review
            <form class="" action="/protocol_management" method="get" name="dropdownForm" id="ongoing_form">
              <input type="hidden" name="approval" id="approval" value="ongoing">
        
              @if(Auth::user()->role == 'Admin')
              <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
              <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
              @endif
              <input type="hidden" name="data" value="<?php echo $data ?>">
              <input type="hidden" name="sort" value="<?php echo $sort ?>">
              <input type="hidden" name="tor" value="<?php echo $tor ?>">
           </form>
          </a>
        </li>
        <li>
          <a onclick="approved()"class="dropdown-item" style="background-color: <?php echo ($approval=='approved') ? '#e6e6e6' : '' ?>; cursor: pointer">
            Approved & On-going
            <form class="" action="/protocol_management" method="get" name="dropdownForm" id="approved_form">
              <input type="hidden" name="approval" id="approval" value="approved">
        
              @if(Auth::user()->role == 'Admin')
              <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
              <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
              @endif
              <input type="hidden" name="data" value="<?php echo $data ?>">
              <input type="hidden" name="sort" value="<?php echo $sort ?>">
              <input type="hidden" name="tor" value="<?php echo $tor ?>">
           </form>
          </a>
        </li>
        <li>
          <a onclick="returned()" class="dropdown-item" style="background-color: <?php echo ($approval=='returned') ? '#e6e6e6' : '' ?>; cursor: pointer">
            Returned
            <form class="" action="/protocol_management" method="get" name="dropdownForm" id="returned_form">
              <input type="hidden" name="approval" id="approval" value="returned">
        
              @if(Auth::user()->role == 'Admin')
              <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
              <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
              @endif
              <input type="hidden" name="data" value="<?php echo $data ?>">
              <input type="hidden" name="sort" value="<?php echo $sort ?>">
              <input type="hidden" name="tor" value="<?php echo $tor ?>">
           </form>
          </a>
        </li>
        <li>
          <a onclick="terminated()" class="dropdown-item" style="background-color: <?php echo ($approval=='terminated') ? '#e6e6e6' : '' ?>; cursor: pointer">
            Terminated
            <form class="" action="/protocol_management" method="get" name="dropdownForm" id="terminated_form">
              <input type="hidden" name="approval" id="approval" value="terminated">
        
              @if(Auth::user()->role == 'Admin')
              <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
              <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
              @endif
              <input type="hidden" name="data" value="<?php echo $data ?>">
              <input type="hidden" name="sort" value="<?php echo $sort ?>">
              <input type="hidden" name="tor" value="<?php echo $tor ?>">
           </form>
          </a>
        </li>
        <li>
          <a onclick="completed()" class="dropdown-item" style="background-color: <?php echo ($approval=='completed') ? '#e6e6e6' : '' ?>; cursor: pointer">
            Completed
            <form class="" action="/protocol_management" method="get" name="dropdownForm" id="completed_form">
              <input type="hidden" name="approval" id="approval" value="completed">
        
              @if(Auth::user()->role == 'Admin')
              <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
              <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
              @endif
              <input type="hidden" name="data" value="<?php echo $data ?>">
              <input type="hidden" name="sort" value="<?php echo $sort ?>">
              <input type="hidden" name="tor" value="<?php echo $tor ?>">
           </form>
          </a>
        </li>
      </ul>
    </div>

</div>

</div>

@if($query=='')
@if(Auth::user()->role == "Admin")
<div class="row mt-4 mb-3">

  <div class="col-12 col-lg-4" id="collegesDiv">

    <form id="collegesFilter_form" action="" method="get">
      <div class="d-flex align-items-center">
      <label for="colleges" class="me-2 mt-2">College: </label>
        <select id="colleges" name="colleges" class="form-select text-start">
            <option selected value="all">All Colleges</option>
            <option value="ARC">College of Architecture</option>
            <option value="BUS">College of Business Administration</option>
            <option value="CELA">College of Education and Liberal Arts</option>
            <option value="ENG">College of Engineering</option>
            <option value="LAW">College of Law</option>
            <option value="NUR">College of Nursing</option>
            <option value="PHA">College of Pharmacy</option>
            <option value="COS">College of Science</option>
        </select>
      </div>
     
        <input type="hidden" name="approval" value="<?php echo $approval ?>">
        <input type="hidden" name="data" value="<?php echo $data ?>">
        <input type="hidden" name="sort" value="<?php echo $sort ?>">
        <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
        <input type="hidden" name="tor" value="<?php echo $tor ?>">
    </form>
    <?php
      echo "<script>
      document.getElementById('colleges').value = '$colleges';
      </script>";
    ?>

  </div>

  <div class="col-12 col-lg-4 mt-2 mt-lg-0" id="reviewersDiv">
   
    <form id="reviewer_form" action="" method="get">
        <div class="d-flex align-items-center">
          <label for="reviewer" class="me-2 mt-2">Reviewer:</label>
          <select id="reviewer" name="reviewer" class="form-select text-start">
              <option selected value="all">All Board Members</option>
              @foreach($board_members as $b)
              <option value="{{ $b->id }}">{{ $b->title }} {{ $b->firstname }} {{ $b->lastname }}</option>
              @endforeach
          </select>
        </div>
        <input type="hidden" name="approval" value="<?php echo $approval ?>">
        <input type="hidden" name="data" value="<?php echo $data ?>">
        <input type="hidden" name="sort" value="<?php echo $sort ?>">
        <input type="hidden" name="tor" value="<?php echo $tor ?>">
        <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
  
      
    </form>
    <?php
      echo "<script>
      document.getElementById('reviewer').value = '$reviewer';
      </script>";
    ?>
  
  </div>

  
  <div class="col-2 d-none d-lg-block" id="sortDiv">
    <div>
      <form id="sort_form" action="" method="get" class="d-flex justify-content-end">
        <input type="hidden" name="approval" value="<?php echo $approval ?>">
        <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
        <input type="hidden" name="data" value="<?php echo $data ?>">
        <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
        <input type="hidden" name="tor" value="<?php echo $tor ?>">

        <select name="sort" id="sort" class="form-select text-start">
              <option value="DESC">Latest</option>
              <option value="ASC">Oldest</option>
        </select>
      </form>
   
      <?php
        echo "<script>
        document.getElementById('sort').value = '$sort';
        </script>";
      ?>
      
    </div>
  </div>

  <div class="col text-end d-none d-lg-block" id="controlsHide">
      <a href="/protocol_management" class="btn btn-dark">Reset</a>
  </div>

</div>  

  <div class="row">
  <div class="col-2 d-none d-lg-block">
        <form id="data_form" action="" method="get">


    <div class="px-1" id="entriesDiv">Show 
    <select name="data" id="data" style="height: 30px">
      <option value="15">15</option>
      <option value="30">30</option>
      <option value="45">45</option>
    </select>  
    Entries</div>
    <input type="hidden" name="sort" value="<?php echo $sort ?>">
    <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
    <input type="hidden" name="approval" value="<?php echo $approval ?>">
    <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
    <input type="hidden" name="tor" value="<?php echo $tor ?>">
  </form>

  <?php
    echo "<script>
    document.getElementById('data').value = '$data';
    </script>";
  ?>
        </div>
      <div class="col-12 col-lg-3" id="">
            <form id="tor_form" action="" method="get">
                <div class="d-flex align-items-center">
                <select id="tor" name="tor" class="form-select text-start">
                    <option selected value="all">All Type of Reviews</option>
                    <option value="FR">Full Board</option>
                    <option value="EX">Exempted</option>
                    <option value="ER">Expedited</option>
                </select>
                </div>
                <input type="hidden" name="sort" value="<?php echo $sort ?>">
                <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
                <input type="hidden" name="data" value="<?php echo $data ?>">
                <input type="hidden" name="approval" value="<?php echo $approval ?>">
        
            
            </form>
            <?php
            echo "<script>
            document.getElementById('tor').value = '$tor';
            </script>";
            ?>
        
        </div>


  </div>

@else <!----------------------------- USER ------------------------------->
<div class="row mt-4 px-2">
    <div class="col-12 col-lg-2">
        <form id="data_form" action="" method="get">
 
            <div class="px-1" id="entriesDiv">Show 
              <select name="data" id="data" style="height: 30px">
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="45">45</option>
              </select>  
              Entries
          </div>
          <input type="hidden" name="approval" value="<?php echo $approval ?>">
          <input type="hidden" name="sort" value="<?php echo $sort ?>">
          <input type="hidden" name="tor" value="<?php echo $tor ?>">
        </form>

          <?php
            echo "<script>
            document.getElementById('data').value = '$data';
            </script>";
          ?>
     </div>

     <div class="col-12 col-lg-3 mt-2 mt-lg-0" id="">
          <form id="tor_form" action="" method="get">
              <div class="d-flex align-items-center">
              <select id="tor" name="tor" class="form-select text-start">
                  <option selected value="all">All Type of Reviews</option>
                  <option value="FR">Full Board</option>
                  <option value="EX">Exempted</option>
                  <option value="ER">Expedited</option>
              </select>
              </div>
              <input type="hidden" name="data" value="<?php echo $data ?>">
              <input type="hidden" name="sort" value="<?php echo $sort ?>">
              <input type="hidden" name="approval" value="<?php echo $approval ?>">
          </form>
            <?php
            echo "<script>
            document.getElementById('tor').value = '$tor';
            </script>";
            ?>
      </div>

      <div class="col-12 col-lg-2 mt-lg-0 mt-2" id="sortDiv">
        <div>
          <form id="sort_form" action="" method="get">
            <input type="hidden" name="approval" value="<?php echo $approval ?>">
            <input type="hidden" name="data" value="<?php echo $data ?>">
            <input type="hidden" name="tor" value="<?php echo $tor ?>">

            <select name="sort" id="sort" class="form-select text-start">
                  <option value="DESC">Latest</option>
                  <option value="ASC">Oldest</option>
            </select>
          </form>
      
          <?php
            echo "<script>
            document.getElementById('sort').value = '$sort';
            </script>";
          ?>
          
        </div>
      </div>

      <div class="col text-end d-none d-lg-block" id="controlsHide">
          <a href="/protocol_management" class="btn btn-dark">Reset</a>
      </div>
</div>
@endif
@endif

    

      @include('livewire.protocols.protocols')




</div>
@include('livewire.protocols.js.js-protocols')
