<div>
<style>
        thead {
            font-size: 13px
        }
        th, td{
         
            padding: 2px 6px;
            border-collapse: collapse;
        }

        th{
            border-bottom: 1px solid black;
        }

        table{
            width: 100%;            
            padding: 2px 6px;
            border-collapse: collapse;
            font-size: 13px
        }
        p, .font-black{
           color: black
        }
        #boardCard .card{
        overflow-y: scroll;
        scrollbar-width: thin; /* For Firefox */
        scrollbar-color: darkgray lightgray; /* For Firefox */
        }

        /* For Webkit-based browsers (Chrome, Safari) */
        #boardCard .card::-webkit-scrollbar {
        width: 8px; /* Adjust as needed */
        }

        #boardCard .card::-webkit-scrollbar-thumb {
        background-color: darkgray; /* Adjust as needed */
        }

        #boardCard .card::-webkit-scrollbar-track {
        background-color: lightgray; /* Adjust as needed */
        }

        tr:nth-child(even) {background-color: #f2f2f2;}
    .content{
        font-family: 'Inter',sans-serif;
    }

    @media only screen and (max-width: 800px) {
    .header {
        display: none
    }
  }
</style>

    <div class="px-1 px-md-5">
 
    <div class="header card p-4 mt-4 shadow-lg" style="border: none">
            <div class="d-flex align-items-center">
                <img src="/images/banner-img.png" width="340px" height="220px" alt="">
                <div class="ps-4">
                    <div style="font-size: 24px">Welcome back,</div>
                    <div class="fw-bold text-primary" style="font-size: 28px">{{ auth()->user()->firstname.' '.auth()->user()->lastname }}!</div>
                </div>
            </div>
        </div>
        <section class="pt-5 pb-5">
    <div class="">
        <div class="row">
            <div class="col-6 font-black">
            <div class="fw-bold" style="font-size: 24px;">Step by Step Guide:</div>
            </div>
            <div class="col-6 text-right">
                <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            <div class="col-12">
                <div id="carouselExampleIndicators2" class="carousel slide">

                    <div class="carousel-inner">
                        <div style="background-color: white;" class="carousel-item active p-3">
                            <div class="row">

                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                     
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532771098148-525cefe10c23?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3f317c1f7a16116dec454fbc267dd8e4">
                                        <div class="card-body">
                                        <div class="fw-bold mb-2 font-black font-black" style="font-size: 21px">Step 1</div>
                                        <p class="card-text">From the Sidebar, Go to Protocols and Click on Upload Protocols. Make sure to fill out all required fields. Once done, protocol will be uploaded as 'On-going Review'.</p>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1517760444937-f6397edcbbcd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=42b2d9ae6feb9c4ff98b9133addfb698">
                                        <div class="card-body">
                                        <div class="fw-bold mb-2 font-black" style="font-size: 21px">Step 2</div>
                                            <p class="card-text">Since your protocol has been uploaded, it will automatically be sent to UERC for the assignment of Type of Review (Full Board, Exempted, Expedited). While waiting, you may send the Acknowledgement Form to the Researchers. </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                    <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ee8417f0ea2a50d53a12665820b54e23">
                                        <div class="card-body">
                                        <div class="fw-bold mb-2 font-black" style="font-size: 21px">Step 3</div>
                                            <p class="card-text">Once Type of Review is assigned. You are now allowed to Assign the Reviewers. Once assigned, You must send the Notice of Review & Non-disclosure Form to the assigned Reviewer. If protocol is declared as Full Board, UERC will take full control of the protocol.</p>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div style="background-color: white;" class="carousel-item p-3">
                            <div class="row">

                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532771098148-525cefe10c23?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3f317c1f7a16116dec454fbc267dd8e4">
                                        <div class="card-body">
                                        <div class="fw-bold mb-2 font-black" style="font-size: 21px">Step 4</div>
                                            <p class="card-text">Once Reviewers are declared, you will be required to attach the Reviewer's Report. Once attached and reviewed, you may now select the Decision.</p>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532715088550-62f09305f765?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ebadb044b374504ef8e81bdec4d0e840">
                                        <div class="card-body">
                                        <div class="fw-bold mb-2 font-black" style="font-size: 21px">Step 5</div>
                                            <p class="card-text">If the protocol has been approved, UERC will review the protocol and will give access to CERC for the Initial Certificate. This certificate is to be sent to the Researchers.</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=0754ab085804ae8a3b562548e6b4aa2e">
                                        <div class="card-body">
                                        <div class="fw-bold mb-2 font-black" style="font-size: 21px">Step 6</div>
                                            <p class="card-text">After sending the Initial Certificate to the Researchers, you may now attach all required documents as instructed on the protocol. Once all the requirements are attached, protocol will automatically be sent to UERC for Final Approval.</p>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div style="background-color: white;" class="carousel-item p-3">
                            <div class="row">

                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532763303805-529d595877c5?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=5ee4fd5d19b40f93eadb21871757eda6">
                                        <div class="card-body">
                                        <div class="fw-bold mb-2 font-black" style="font-size: 21px">Step 7 (Completion)</div>
                                            <p class="card-text">If rejected, UERC will return the protocol and will place the protocol under Returned Protocols, instructions will be included. If approved, UERC will send the Final Certificate to Researchers and mark the protocol as Completed.</p>

                                        </div>

                                    </div>
                                </div>
                  

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <div class="d-flex justify-content-between align-items-baseline">
            <div class="fw-bold" style="margin-top: 30px; font-size: 24px">Data Information</div>
            <!---
            <div id="nextButton" onclick="showTerminated()" style="font-size: 20px; cursor: pointer">>></div>
            <div id="prevButton" onclick="showOthers()" style="font-size: 20px; cursor: pointer; display: none"><<</div>
            --->
            <div class="pe-3">
                <button class="btn btn-primary mb-3 mr-1" onclick="showOthers()" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left"></i>
                </button>
                <button class="btn btn-primary mb-3 " onclick="showTerminated()" role="button" data-slide="next">
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
      
     
        <div class="row">
        <div id="terminatedCol" class="col-md-12 mt-2 mt-lg-1 col-lg-6 col-xl-3 px-lg-1 px-xl-2" style="display: none">
            <div class="card shadow" style="height: 110px; border-right: 15px solid gray; background-color: silver;">
            <div class="d-flex px-3 justify-content-between align-items-center w-100 h-100">
                <div>
                    <div style="font-size: 24px; font-weight: 700">{{ count($terminatedProtocols) }}</div>
                    <div style="font-size: 14px; font-weight: 500">Terminated</div> 
                </div>
                <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-exclamation-square-fill me-2" viewBox="0 0 16 16">
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                </div>
            </div>
            </div>
        </div>

            <div id="underCol" class="col-md-12 mt-2 mt-lg-1 col-lg-6 col-xl-3 px-lg-1 px-xl-2">
            <div class="card shadow" style="height: 110px; border-right: 15px solid #e6e600; background-color: yellow;">
            <div class="d-flex px-3 justify-content-between align-items-center w-100 h-100">
                <div>
                    <div style="font-size: 24px; font-weight: 700">{{ count($underApprovalProtocols) }}</div>
                    <div style="font-size: 14px; font-weight: 500">On-going Review</div> 
                </div>
                <div>
                <?php include('svg/on-going-icon.svg')?>
                </div>
            </div>
            </div>
            </div>
            <div id="approvedCol" class="col-md-12 mt-2 mt-lg-1 col-lg-6 col-xl-3 px-lg-1 px-xl-2">
            <div class="card shadow" style="height: 110px; border-right: 15px solid green; background-color: #00e600;">
            <div class="d-flex px-3 justify-content-between align-items-center w-100 h-100">
                <div>
                    <div style="font-size: 24px; font-weight: 700">{{ count($approvedProtocols) }}</div>
                    <div style="font-size: 14px; font-weight: 500">Approved & On-going</div> 
                </div>
                <div class="px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg>
                </div>
            </div>
            </div>
            </div>

            <div id="returnedCol" class="col-md-12 mt-2 mt-lg-1 col-lg-6 col-xl-3 px-lg-1 px-xl-2">
            <div class="card shadow" style="height: 110px;  border-right: 15px solid red; background-color: #ff9999;">
            <div class="d-flex px-3 justify-content-between align-items-center w-100 h-100">
                <div>
                    <div style="font-size: 24px; font-weight: 700">{{ count($returnedProtocols) }}</div>
                    <div style="font-size: 14px; font-weight: 500">Returned</div> 
                </div>
                <div class="px-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
            </div>
            </div>
            </div>
            

            
            <div id="completedCol" class="col-md-12 mt-2 mt-lg-1 col-lg-6 col-xl-3 px-lg-1 px-xl-2">
                
            <div class="card shadow" style="height: 110px; border-right: 15px solid black">
            <div class="d-flex ps-3 pe-4 justify-content-between align-items-center w-100 h-100">
                <div>
                    <div style="font-size: 24px; font-weight: 700">{{ count($completedProtocols) }}</div>
                    <div class="text-secondary" style="font-size: 14px; font-weight: 500">Completed</div> 
                </div>
                <div>
                    <?php include('svg/completed-icon.svg')?>
                </div>
            </div>
            </div>
            </div>
           
        </div>
  
       
     
      
      
        <div id="boardCard" class="row" style="margin-top: 35px">


            <div class="col-lg-6 col-xxl-4 mt-3">
            <div class="card border border-0 shadow" style="height: 480px; overflow-y: scroll">
                <div class="d-flex justify-content-between pt-3 px-4">
                        <div style="font-size: 18px" class="fw-bold">
                            UERC Board Members
                        </div>
                        <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-disc" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 4a4 4 0 0 0-4 4 .5.5 0 0 1-1 0 5 5 0 0 1 5-5 .5.5 0 0 1 0 1zm4.5 3.5a.5.5 0 0 1 .5.5 5 5 0 0 1-5 5 .5.5 0 0 1 0-1 4 4 0 0 0 4-4 .5.5 0 0 1 .5-.5z"/>
                        </svg>
                        </div>
                </div>
                <div class="p-3">
                    @forelse($board_members as $board_members)
                    <div class="row">
                        <div class="col">
                            <div class="d-flex align-items-center py-2">
                              
                                <div class="ps-1">
                                    <div style="font-weight: 600">{{ $board_members->title.' '.$board_members->firstname.' '.$board_members->lastname }}</div>
                                    <div style="line-height: 115%">
                                        <div class="text-secondary" style="font-size: 13px">{{ $board_members->email }}</div>
                                        <div class="text-primary" style="font-size: 13px">{{ $board_members->phone_number}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    @empty
                    <h3 class="text-muted text-center mt-5">No Data Found.</h3>  
                    @endforelse
                </div>
            </div>
            </div>

            <div class="col-lg-6 col-xxl-4 mt-3">
            <div class="card shadow" style="height: 480px; overflow-y: scroll">
                <div class="d-flex justify-content-between pt-3 px-4">
                    <div style="font-size: 18px" class="fw-bold">
                        UERC
                    </div>
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-disc" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 4a4 4 0 0 0-4 4 .5.5 0 0 1-1 0 5 5 0 0 1 5-5 .5.5 0 0 1 0 1zm4.5 3.5a.5.5 0 0 1 .5.5 5 5 0 0 1-5 5 .5.5 0 0 1 0-1 4 4 0 0 0 4-4 .5.5 0 0 1 .5-.5z"/>
                    </svg>
                    </div>
                </div>
                <div class="p-3">
                    @forelse($uerc as $uerc)
                    @if($uerc->id!=2)
                    <div class="row">
                        <div class="col">
                            <div class="d-flex align-items-center py-2">
                                <img src="{{ $uerc->profile_image == null ? 'profile/default-profile.jpeg' : $uerc->profile_image }}" style="border-radius: 50%" width="50" height="50" alt="">
                                <div class="ps-3">
                               
                                    <div style="font-weight: 600">{{ $uerc->title.' '.$uerc->firstname.' '.$uerc->lastname }}</div>
                                    <div style="line-height: 115%">
                                        <div class="text-secondary" style="font-size: 13px">{{ $uerc->email }}</div>
                                        <div class="text-primary" style="font-size: 13px">{{ $uerc->phone_number}}</div>
                                    </div>
                              
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    @endif
                    @empty
                    <h3 class="text-muted text-center mt-5">No user under UERC.</h3> 
                    @endforelse
                </div>
            </div>
            </div>
          
         <div class="col mt-3">
         <div class="card border border-0 shadow" style="height: 480px">
                <div class="d-flex justify-content-between pt-3 px-4">
                    <div style="font-size: 18px" class="fw-bold">
                        CERC
                    </div>
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-disc" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 4a4 4 0 0 0-4 4 .5.5 0 0 1-1 0 5 5 0 0 1 5-5 .5.5 0 0 1 0 1zm4.5 3.5a.5.5 0 0 1 .5.5 5 5 0 0 1-5 5 .5.5 0 0 1 0-1 4 4 0 0 0 4-4 .5.5 0 0 1 .5-.5z"/>
                    </svg>
                    </div>
                </div>
                <div class="p-3">
                    @forelse($cerc as $cerc)
                    <div class="row">
                        <div class="col">
                            <div class="d-flex align-items-center py-2">
                            <img src="{{ $cerc->profile_image == null ? 'profile/default-profile.jpeg' : $cerc->profile_image }}" style="border-radius: 50%" width="50" height="50" alt="">
                                <div class="ps-3">
                                    <div style="font-weight: 600">{{ $cerc->title.' '.$cerc->firstname.' '.$cerc->lastname }}</div>
                                    <div style="line-height: 115%">
                                        <div class="text-secondary" style="font-size: 13px">{{ $cerc->email }}</div>
                                        <div class="text-primary" style="font-size: 13px">{{ $cerc->phone_number}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                      <h3 class="text-muted text-center mt-5">No user under CERC.</h3>  
                    @endforelse
                </div>
            </div>
         </div>
        </div>

    <div class="fw-bold mt-5" style="font-size: 24px">Latest Uploads:</div>
    <div class="card mt-3 border border-0 shadow-lg">
   
    
     <div style="font-size: 18px; background-color: #2d486c" class="fw-bold ps-3 py-2 text-white">UERC</div>
     <div style="overflow-x: scroll; white-space: nowrap">

        <table class="mt-2">
        
        @if(count($uerc_protocols)!=0)
        <thead>
            <tr>
            <th>Protocol Code</th>
            <th>Protocol Title</th>
            <th>Researchers</th>
            <th>Funding</th>
            <th>Research Type</th>
            <th>Date Received</th>
            <th>Review Type</th>
            <th>Date of Meeting</th>
            <th>Primary Reviewer</th>
            <th>Decision</th>
            <th>Date of First Decision</th>
            <th>Status</th>
            <th>User</th>
            <tr>
        </thead>
        <tbody>
        @endif
    
        @forelse($uerc_protocols as $protocol)
     
         <tr class="">
    
                <td class="py-3">{{ $protocol->protocol_code }}</td>
                <td>{{ $protocol->title }}</td>
                <td>{{ $protocol->p_researcher }}<?php echo $protocol->c_researcher!='None' ? '/'.$protocol->c_researcher : '' ?></td>
                <td>
                    <?php 
                    if($protocol->funding=='R - Researcher-funded'){
                        echo 'R';
                    }
                    else if($protocol->funding=='I - Institution-funded'){
                        echo 'I';
                    }
                    else if($protocol->funding=='A - Agency other than institutuion'){
                        echo 'A';
                    }
                    else if($protocol->funding=='D - Pharmaceutical companies'){
                        echo 'D';
                    }
                    else{
                        echo 'O';
                    }
                    ?>
                </td>
                <td>{{ $protocol->research_type }}</td>
                <td>{{ date('M d, Y', strtotime($protocol->date_of_receipt)) }}</td>
                <td>
                <?php 
                    if($protocol->type_of_review=='FR - Full Review'){
                        echo 'FR';
                    }
                    else if($protocol->type_of_review=='ER - Expedited Review'){
                        echo 'ER';
                    }
                    else{
                        echo 'EX';
                    }
                    ?>
                </td>
                <td>{{ date('M d, Y', strtotime($protocol->date_of_receipt)) }}</td>
                <td>{{ $protocol->primary_reviewer }}</td>
                <td>{{ $protocol->first_decision }}</td>
                <td>
                    <?php
                       if($protocol->first_decision_access==null){
                        echo 'NA';
                       }
                       else{
                        echo date('M d, Y', strtotime($protocol->first_decision_access));
                       }
                    ?>
                </td>
                <td class="{{ $protocol->approval=='On-going Review' ? 'bg-warning' : '' }}
                {{ $protocol->approval=='Approved & On-going' ? 'bg-success text-white' : '' }}
                {{ $protocol->approval=='Returned' ? 'bg-danger text-white' : '' }}
                {{ $protocol->approval=='Terminated' ? 'bg-secondary text-white' : '' }}
                {{ $protocol->approval=='Completed' ? 'bg-dark text-white' : '' }}
                ">
                <?php 
                    if($protocol->approval=='On-going Review'){
                        echo 'OR';
                    }
                    else if($protocol->approval=='Approved & On-going'){
                        echo 'A';
                    }
                    else if($protocol->approval=='Completed'){
                        echo 'C';
                    }
                    else if($protocol->approval=='Returned'){
                        echo 'R';
                    }
                    else{
                        echo 'T';
                    }
                    ?>
                </td>
                <td>{{ $protocol->user->firstname.' '.$protocol->user->lastname}}</td>
            </tr>  
       
        @empty
        <h4 class="text-muted text-center my-3">No Data Found.</h4>
        @endforelse
     
        </tbody>
        </table>
        </div>
        <div style="font-size: 18px" class="fw-bold ps-3 mt-2 py-2 bg-secondary text-white">CERC</div>
                       
            <div style="overflow-x: scroll; white-space: nowrap">
                       <table class="mt-2">
                       
                       @if(count($cerc_protocols)!=0)
                       <thead>
                           <tr>
                           <th>Protocol Code</th>
                           <th>Protocol Title</th>
                           <th>Researchers</th>
                           <th>Funding</th>
                           <th>Research Type</th>
                           <th>Date Received</th>
                           <th>Review Type</th>
                           <th>Date of Meeting</th>
                           <th>Primary Reviewer</th>
                           <th>Decision</th>
                           <th>Date of First Decision</th>
                           <th>Status</th>
                           <th>User</th>
                           <tr>
                       </thead>
                       <tbody>
                       @endif
                   
                       @forelse($cerc_protocols as $protocol)
                        
                        <tr class="">
                   
                               <td class="py-3">{{ $protocol->protocol_code }}</td>
                               <td>{{ $protocol->title }}</td>
                               <td>{{ $protocol->p_researcher }}<?php echo $protocol->c_researcher!='None' ? '/'.$protocol->c_researcher : '' ?></td>
                               <td>
                                   <?php 
                                   if($protocol->funding=='R - Researcher-funded'){
                                       echo 'R';
                                   }
                                   else if($protocol->funding=='I - Institution-funded'){
                                       echo 'I';
                                   }
                                   else if($protocol->funding=='A - Agency other than institutuion'){
                                       echo 'A';
                                   }
                                   else if($protocol->funding=='D - Pharmaceutical companies'){
                                       echo 'D';
                                   }
                                   else{
                                       echo 'O';
                                   }
                                   ?>
                               </td>
                               <td>{{ $protocol->research_type }}</td>
                               <td>{{ date('M d, Y', strtotime($protocol->date_of_receipt)) }}</td>
                               <td>{{ $protocol->type_of_review }}</td>
                               <td>{{ date('M d, Y', strtotime($protocol->date_of_receipt)) }}</td>
                               <td>{{ $protocol->primary_reviewer }}</td>
                               <td>{{ $protocol->first_decision }}</td>
                               <td>
                                   <?php
                                      if($protocol->first_decision_access==null){
                                       echo 'NA';
                                      }
                                      else{
                                       echo date('M d, Y', strtotime($protocol->first_decision_access));
                                      }
                                   ?>
                               </td>
                               <td class="{{ $protocol->approval=='On-going Review' ? 'bg-warning' : '' }}
                                {{ $protocol->approval=='Approved & On-going' ? 'bg-success text-white' : '' }}
                                {{ $protocol->approval=='Returned' ? 'bg-danger text-white' : '' }}
                                {{ $protocol->approval=='Terminated' ? 'bg-secondary text-white' : '' }}
                                {{ $protocol->approval=='Completed' ? 'bg-dark text-white' : '' }}
                                ">
                                <?php 
                                if($protocol->approval=='On-going Review'){
                                    echo 'OR';
                                }
                                else if($protocol->approval=='Approved & On-going'){
                                    echo 'A';
                                }
                                else if($protocol->approval=='Completed'){
                                    echo 'C';
                                }
                                else if($protocol->approval=='Returned'){
                                    echo 'R';
                                }
                                else{
                                    echo 'T';
                                }
                                ?>
                               </td>
                               <td>{{ $protocol->user->firstname.' '.$protocol->user->lastname}}</td>
                           </tr>  
                      
                       @empty
                        <h4 class="text-muted text-center my-3">No Data Found.</h4>
                       @endforelse
                    
                       </tbody>
                       </table>
                       </div>
       
        </div>

       
<div class="card shadow px-4 px-lg-5 py-4 mt-3" style="border-top: 10px solid gray">
<div class="mt-4 fw-bold"> Legend:</div>
    <div class="row py-4">
        <div class="col-lg-3 card p-3 p-3">
        *Funding<br><br>
        R - Researcher Funded<br>
        I - Institution Funded<br>
        A - Agency other than institution<br>
        D - Pharmaceutical companies<br>
        O - Others
        </div>

        <div class="col-lg-3 card p-3 mx-lg-1 mx-0 mt-lg-0 mt-2">
        *Research Type<br><br>
        - Biomedical Studies<br>
        - Health Operations Research<br>
        - Social Research<br>
        - Public Health Research<br>
        - Clinical Trials
        </div>

        <div class="col-lg-3 card p-3 me-lg-1 me-0 mt-lg-0 mt-2">
        *Review Type<br><br>
        FR - Full Review<br>
        ER - Expedited Review<br>
        EX - Exempt from Review
        </div>

        <div class="col card p-3 mt-lg-0 mt-2">
        *Decision<br><br>
        A - Approved<br>
        MN - Minor Modification<br>
        MJ - Major Modification<br>
        D - Disapproved
        </div>
        
    

    </div>
    <div class="row">
        <div class="col card p-3">
        *Status<br><br>
        OR - On-going Review<br> 
        A - Approved & On-going<br>
        C - Completed<br>
        T - Terminated<br>
        W - Withdrawn
        </div>
    </div>

</div>



        <div class="footer card p-3 mt-5 shadow-lg" style="border: none">
                 <div>
                  <div style="font-size: 16px" class="text-center text-primary fw-bold">UERC</div>
                </div>
        </div>
        </div>
    </div>
</div>
<script>

   
    function showTerminated(){
        $('#terminatedCol').show();
        $('#prevButton').show();

        $('#nextButton').hide();
        $('#underCol').hide();
        $('#approvedCol').hide();
        $('#returnedCol').hide();
        $('#completedCol').hide();
    }

    function showOthers(){
        $('#terminatedCol').hide();
        $('#prevButton').hide();

        $('#nextButton').show();
        $('#underCol').show();
        $('#approvedCol').show();
        $('#returnedCol').show();
        $('#completedCol').show();
    }
</script>