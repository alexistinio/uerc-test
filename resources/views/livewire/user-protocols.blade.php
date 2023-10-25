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
</style>

<?php 
 $id = request('id');
?>

<body>


<div class="card py-1 mt-3 border border-0 shadow-lg">
        <div class="card-body">
          <div class="row">
            <div class="col-1 d-none d-lg-block">
            <img src="{{ $user->profile_image == null ? 'profile/default-profile.jpeg' : $user->profile_image }}" width="100" height="100" class="rounded-circle" alt="">
            </div>

            <div class="col">
            <div class="ps-2">

          <button id="titleBtn" 
             style="font-size: 22px; 
                    font-weight: 500; 
                    font-family: -apple-system, BlinkMacSystemFont, sans-serif; 
                    font-style: italic;" class="btn-lg py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
         {{ $user->firstname.' '.$user->lastname }}'s Protocols
          </button>
  
        
  
              <div class="ps-3 mt-3 d-none d-lg-flex" style="overflow: hidden;">
                  <div onclick="myProtocolType_function()" class="{{ $protocol=='all' && Auth::user()->role=='Admin' ? 'active' : '' }} p-2" style="cursor: pointer; background-color: <?php echo $protocol=='all' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">All Protocols</div>
                    <form id="myProtocolType_form" action="" method="get">
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="protocol" value="all">
                    </form>

                    <div onclick="ongoing_function()" class="{{ $protocol=='On-going Review' && Auth::user()->role=='Admin' ? 'active' : '' }} ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='ongoing' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">On-going</div>
                    <form id="ongoing_form" action="" method="get">
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="protocol" value="ongoing">
                    </form>

                  <div onclick="returned_function()" class="<?php echo $protocol=='Returned' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='returned' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Returned</div>
                    <form id="returned_form" action="" method="get">
                        <input type="hidden" name="id" value="{{ $id }}">
                      <input type="hidden" name="protocol" value="returned">
                    </form>
                  
                  <div onclick="terminated_function()" class="<?php echo $protocol=='Terminated' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='terminated' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Terminated</div>
                    <form id="terminated_form" action="" method="get">
                       <input type="hidden" name="id" value="{{ $id }}">
                      <input type="hidden" name="protocol" value="terminated">
                    </form>

                  <div onclick="firstProtocolType_function()" class="<?php echo $protocol=='firstDecision' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='firstDecision' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Approved First Decision</div>
                    <form id="firstProtocolType_form" action="" method="get">
                       <input type="hidden" name="id" value="{{ $id }}">
                      <input type="hidden" name="protocol" value="firstDecision">
                    </form>
                  <div onclick="finalProtocolType_function()" class="<?php echo $protocol=='finalDecision' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='finalDecision' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Final Decision Approval</div>
                     <form id="finalProtocolType_form" action="" method="get">
                         <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="protocol" value="finalDecision">
                     </form>
                  
                  <div onclick="completed_function()" class="<?php echo $protocol=='Completed' && Auth::user()->role=='Admin' ? 'active' : '' ?> ms-3 p-2" style="cursor: pointer; background-color: <?php echo $protocol=='completed' && Auth::user()->role!='Admin' ? '#e6e6e6' : '' ?>; border-radius: 10px">Completed</div>
                     <form id="completed_form" action="" method="get">
                         <input type="hidden" name="id" value="{{ $id }}">
                       <input type="hidden" name="protocol" value="completed">
                     </form>   
                  
              </div>
   
              <form id="protocol_form" action="" method="get">
              <select onchange="protocol_function()" name="protocol" id="protocol" class="form-select d-block d-lg-none mt-2">

                 <option value="all">All Protocols</option>
                 <option value="ongoing">On-going</option>
                 <option value="returned">Returned</option>
                 <option value="terminated">Terminated</option>
                 <option value="firstDecision">Approved First Decision</option>
                 <option value="finalDecision">Final Decision Approval</option>
                 <option value="completed">Completed</option>
              </select>
       
             
            </form>  
     
            <?php echo "<script>document.getElementById('protocol').value = '$protocol';</script>"; ?>
   
        </div>
            </div>
          </div>
          
     
      </div>
    </div>

    <div class="card px-2 pt-2 mt-2 border border-0 shadow-lg" id="yourProtocols_div">
        <div class="row mt-1 px-2">
        <div class="col-6 col-lg-2">
            <form id="data_form" action="" method="get">
    
        
                <div class="px-1 mt-1" id="entriesDiv">Show 
                <select name="data" id="data" style="height: 30px">
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="45">45</option>
                </select>  
                Entries</div>
           
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="sort" value="<?php echo $sort ?>">
                <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">

            </form>

                <?php
                    echo "<script>
                    document.getElementById('data').value = '$data';
                    </script>";
                ?>
        </div>

        <div class="col-12 col-lg-3 mt-2 mt-lg-0" id="torDiv">
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
                    <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
        
            
            </form>
            <?php
            echo "<script>
            document.getElementById('tor').value = '$tor';
            </script>";
            ?>
        
        </div>


      @if($protocol=='firstDecision')
        <div class="col-12 col-lg-4 mt-lg-0 mt-2">
        
        <form id="access_form" action="" method="get">
            <div class="d-flex align-items-center">
                <label for="access" class="me-2 mt-2">Protocol:</label>
                <select id="access" name="access" class="form-select text-start">
                    <option value="forAccess">For Initial Certificate Access</option>
                    <option value="granted">Access Already Granted</option>

            
                </select>
            </div>
         <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
            <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
            <input type="hidden" name="data" value="<?php echo $data ?>">
            <input type="hidden" name="sort" value="<?php echo $sort ?>">
            
            
        </form>
        <?php
            echo "<script>
            document.getElementById('access').value = '$access';
            </script>";
        ?>
        
        </div>
      @endif
    
      @if($user->role=="Admin")
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
               <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
                <input type="hidden" name="data" value="<?php echo $data ?>">
                <input type="hidden" name="sort" value="<?php echo $sort ?>">
        
            
            </form>
            <?php
            echo "<script>
            document.getElementById('reviewer').value = '$reviewer';
            </script>";
            ?>
        
        </div>
    @endif
        
        <div class="col-12 col-lg-2 mt-lg-0 mt-2" id="sortDiv">
            <div>
            <form id="sort_form" action="" method="get" class="d-flex justify-content-end">
          
         <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="data" value="<?php echo $data ?>">
                <input type="hidden" name="reviewer" value="<?php echo $reviewer ?>">
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>">
             

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

        </div>

        @include('livewire.protocols.protocols')


  

</div>

</body>

</div>
@include('livewire.protocols.js.js-protocols')