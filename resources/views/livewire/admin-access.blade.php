<div>
@include('view.protocol_management.add_protocol')
@include('view.protocol_management.edit_protocol')
<style>
  a {
    color: black
  }

  #titleBtn:hover{
    background-color: #e6e6e6
  } 

  .card-h{
    border-radius: 0;
    border-left: 7px solid gray;
  }
</style>
<?php 
 $id = request('id');
?>

<body>


    <div class="card card-h py-1 mt-3 shadow-lg">
        <div class="card-body d-flex">
        <img src="{{ auth()->user()->profile_image == null ? 'profile/default-profile.jpeg' : auth()->user()->profile_image }}" width="100" height="100" class="rounded-circle" alt="">
             
        <div class="ps-2">
       
      
          <div class="dropdown">
          <button id="titleBtn" 
             style="font-size: 22px; 
                    font-weight: 500; 
                    font-family: -apple-system, BlinkMacSystemFont, sans-serif; 
                    font-style: italic" class="btn-lg dropdown-toggle py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
             Admin Access
          </button>
          <button id="upload_protocol" data-bs-toggle="modal" data-bs-target="#modal_1" class="btn btn-primary py-2 mt-4 mt-sm-0">Upload Protocol 
              <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -3px"width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
              </svg>
          </button>
      <ul class="dropdown-menu py-3">
        <li class="mb-2">
          <a class="dropdown-item" href="/myprotocols">
            My Protocols
          </a>
        </li>
        <li>
          <a class="dropdown-item" style="background-color: silver" href="/admin/protocol_management/admin" id="uploadBtn">
            Admin Access
          </a>
          <form action="/meetings/store" enctype="multipart/form-data" id="upload_form" method="post">
            @csrf
            <input onchange="upload()" type="file" name="uploadInput" id="uploadInput" class="d-none">
          </form>
        
        </li>
      </ul>
    </div>
    
  
              <div class="ps-3 mt-3 d-none d-md-flex align-items-baseline">
                  <div onclick="myProtocolType_function()" class="{{ $protocol=='all' && Auth::user()->role=='Admin' ? 'active' : '' }} p-2" style="cursor: pointer; background-color: <?php echo $protocol=='all' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">All Protocols</div>
                    <form id="myProtocolType_form" action="" method="get">
                        <input type="hidden" name="protocol" value="all">
                    </form>

                    <div onclick="ongoing_function()" class="{{ $protocol=='On-going Review' && Auth::user()->role=='Admin' ? 'active' : '' }} ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='ongoing' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">On-going</div>
                    <form id="ongoing_form" action="" method="get">
                        <input type="hidden" name="protocol" value="ongoing">
                    </form>

                  <div onclick="returned_function()" class="<?php echo $protocol=='Returned' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='returned' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Returned</div>
                    <form id="returned_form" action="" method="get">
                      <input type="hidden" name="protocol" value="returned">
                    </form>
                  
                  <div onclick="terminated_function()" class="<?php echo $protocol=='Terminated' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='terminated' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Terminated</div>
                    <form id="terminated_form" action="" method="get">
                      <input type="hidden" name="protocol" value="terminated">
                    </form>

 

                  
              </div>
          
              <div class="d-none d-md-flex px-2 py-1 mt-2" style="border-top: 1px solid silver">
                <div onclick="typeOfReview_function()" class="<?php echo $protocol=='typeOfReview' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-1 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='typeOfReview' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Type of Review</div>
                <form id="typeOfReview_form" action="" method="get">
                  <input type="hidden" name="protocol" value="typeOfReview">
                </form>

                <div onclick="firstProtocolType_function()" class="<?php echo $protocol=='firstDecision' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='firstDecision' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Approved First Decision</div>
                <form id="firstProtocolType_form" action="" method="get">
                  <input type="hidden" name="protocol" value="firstDecision">
                </form>
                <div onclick="finalProtocolType_function()" class="<?php echo $protocol=='finalDecision' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='finalDecision' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Final Decision Approval</div>
                <form id="finalProtocolType_form" action="" method="get">
                    <input type="hidden" name="protocol" value="finalDecision">
                </form>

                <div onclick="completed_function()" class="<?php echo $protocol=='Completed' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='completed' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Completed</div>
                <form id="completed_form" action="" method="get">
                    <input type="hidden" name="protocol" value="completed">
                </form>   
             </div>
             <form id="protocol_form" action="" method="get">
              <select onchange="protocol_function()" name="protocol" id="protocol" class="form-select d-block d-md-none mt-3">
                 <option value="all">All Protocols</option>
                 <option value="ongoing">On-going</option>
                 <option value="returned">Returned</option>
                 <option value="terminated">Terminated</option>
                 <option value="firstDecision">Approved First Decision</option>
                 <option value="finalDecision">Final Decision Approval</option>
                 <option value="completed">Completed</option>
              </select>
            </form>  
            <?php 
          $status = "all";
          if($protocol=='On-going Review'){
            $status = 'ongoing'; 
          }

          else if($protocol=='Returned'){
            $status = 'returned'; 
          }
          else if($protocol=='Terminated'){
            $status = 'terminated'; 
          }
          else if($protocol=='Completed'){
            $status = 'completed'; 
          }
          else if($protocol=='firstDecision'){
            $status = 'firstDecision';
          }
          else if($protocol=='finalDecision'){
            $status = 'finalDecision';
          }
          else{
           //
          }
          echo "<script>document.getElementById('protocol').value = '$status';</script>";
          ?>
        </div>
     
               
        </div>
    </div>


    <div class="card card-b px-2 pt-2 mt-2 shadow-lg" id="yourProtocols_div">
      @if($protocol!='firstDecision')
        <div class="row mt-1 px-2">
        <div class="col-2 d-none d-lg-block">
            <form id="data_form" action="" method="get">
         
        
                <div class="px-1 mt-1" id="entriesDiv">Show 
                <select name="data" id="data" style="height: 30px">
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="45">45</option>
                </select>  
                Entries</div>
           
                
                <input type="hidden" name="sort" value="<?php echo $sort ?>">
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
                <input type="hidden" name="tor" value="<?php echo $tor ?>">
                <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">


            </form>

                <?php
                    echo "<script>
                    document.getElementById('data').value = '$data';
                    </script>";
                ?>
        </div>
    

        <div class="col-12 col-lg-4" id="reviewersDiv">
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
          
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
                <input type="hidden" name="data" value="<?php echo $data ?>">
                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
                <input type="hidden" name="sort" value="<?php echo $sort ?>">
                <input type="hidden" name="tor" value="<?php echo $tor ?>">
        
            
            </form>
            <?php
            echo "<script>
            document.getElementById('reviewer').value = '$reviewer';
            </script>";
            ?>
        
        </div>
        
    
        
        <div class="col-12 col-lg-3 mt-lg-0 mt-2">
      <form id="collegesFilter_form" action="" method="get">   
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

        <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
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



          <div class="col-6 col-md-2 mt-lg-0 mt-2" id="sortDiv">
            <div>
            <form id="sort_form" action="" method="get" class="d-flex justify-content-end">

  
                <input type="hidden" name="data" value="<?php echo $data ?>">
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
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
        @if($protocol!='firstDecision')
        <div class="col-1 d-lg-block d-none" id="controlsHide">
            <a href="/administrator" class="btn btn-dark">Reset</a>
        </div>
        @endif
        


       @if($protocol!='typeOfReview')
        <div class="col-12 col-lg-3 mt-2" id="torDiv">
            <form id="tor_form" action="" method="get">
                <div class="d-flex align-items-center">
           
                <select id="tor" name="tor" class="form-select text-start">
                    <option selected value="all">All Type of Reviews</option>
                    <option value="FR">Full Board</option>
                    <option value="EX">Exempted</option>
                    <option value="ER">Expedited</option>
                </select>
                </div>
        
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
                <input type="hidden" name="data" value="<?php echo $data ?>">
                <input type="hidden" name="sort" value="<?php echo $sort ?>">
                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
                <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
        
            
            </form>
            <?php
            echo "<script>
            document.getElementById('tor').value = '$tor';
            </script>";
            ?>
        
        </div>
     @endif
       
        </div>
        @else
        <div class="row mt-1 px-2">
          
        <div class="col-2 d-none d-lg-block">
            <form id="data_form" action="" method="get">
         
        
                <div class="px-1 mt-1" id="entriesDiv">Show 
                <select name="data" id="data" style="height: 30px">
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="45">45</option>
                </select>  
                Entries</div>
           
                
                <input type="hidden" name="sort" value="<?php echo $sort ?>">
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
                <input type="hidden" name="tor" value="<?php echo $tor ?>">
                <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">


            </form>

                <?php
                    echo "<script>
                    document.getElementById('data').value = '$data';
                    </script>";
                ?>
        </div>



        <div class="col-12 col-lg-4">
        
        <form id="access_form" action="" method="get">
            <div class="d-flex align-items-center">
                <label for="access" class="me-2 mt-2">Protocol:</label>
                <select id="access" name="access" class="form-select text-start">
                    <option value="forAccess">For Initial Certificate Access</option>
                    <option value="granted">Access Already Granted</option>

            
                </select>
            </div>
  
            <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
            <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
            <input type="hidden" name="data" value="<?php echo $data ?>">
            <input type="hidden" name="sort" value="<?php echo $sort ?>">
            <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
            
            
        </form>
        <?php
            echo "<script>
            document.getElementById('access').value = '$access';
            </script>";
        ?>
        
        </div>
  
    

        <div class="col-12 col-lg-4 mt-lg-0 mt-2" id="reviewersDiv">
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
          
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
                <input type="hidden" name="data" value="<?php echo $data ?>">
                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
                <input type="hidden" name="sort" value="<?php echo $sort ?>">
                <input type="hidden" name="tor" value="<?php echo $tor ?>">
        
            
            </form>
            <?php
            echo "<script>
            document.getElementById('reviewer').value = '$reviewer';
            </script>";
            ?>
        
        </div>


        <div class="col-1 d-lg-block d-none" id="controlsHide">
            <a href="/admin/protocol_management/admin" class="btn btn-dark">Reset</a>
        </div>
        
        <div class="col-12 col-lg-3 mt-2">
      <form id="collegesFilter_form" action="" method="get">   
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

        <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
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

       @if($protocol!='typeOfReview')
        <div class="col-12 col-lg-3 mt-2" id="torDiv">
            <form id="tor_form" action="" method="get">
                <div class="d-flex align-items-center">
           
                <select id="tor" name="tor" class="form-select text-start">
                    <option selected value="all">All Type of Reviews</option>
                    <option value="FR">Full Board</option>
                    <option value="EX">Exempted</option>
                    <option value="ER">Expedited</option>
                </select>
                </div>
        
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
                <input type="hidden" name="data" value="<?php echo $data ?>">
                <input type="hidden" name="sort" value="<?php echo $sort ?>">
                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
                <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
        
            
            </form>
            <?php
            echo "<script>
            document.getElementById('tor').value = '$tor';
            </script>";
            ?>
        
        </div>
     @endif



     <div class="col-6 col-md-2 mt-2" id="sortDiv">
            <div>
            <form id="sort_form" action="" method="get" class="d-flex justify-content-end">

  
                <input type="hidden" name="data" value="<?php echo $data ?>">
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
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
        @endif

        @include('livewire.protocols.protocols')


  

</div>
</div>
</body>

</div>
@include('livewire.protocols.js.js-protocols')
