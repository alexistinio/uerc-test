<!------------------------------Under Approval Protocols------------------------------>
<!------------------------------Under Approval Protocols------------------------------>
<style>
    /* Custom CSS for a 4.5 column width */
    .col-4-5 {
        flex: 0 0 calc(37.5% - 15px); /* 4.5 columns out of 12 */
        max-width: calc(37.5% - 15px);
        padding-right: 15px;
        padding-left: 15px;
    }
    @media only screen and (min-width: 1300px) { 
    #col-4-5 {
        
    }
}
</style>
<div class="row {{ (str_contains(request()->path(), 'protocols')) ? '' : 'mb-4'}}" id="header_ongoing">
  <div class="col mt-1">

  <?php
  $displayedOngoingReview = false;
  $displayedApprovedOngoing = false;
  $displayedReturned = false;
  $displayedTerminated = false;
  $displayedCompleted = false;
  ?>
    @forelse($protocols as $protocol)
    @if($protocol->approval === 'On-going Review' && !$displayedOngoingReview) 
        <div class="ms-2 mt-5" style="
        font-size: 20px; font-weight: 500; font-family: -apple-system, BlinkMacSystemFont, sans-serif;">
        <?php echo (!isset($protocolsDropdown)) ? 'On-going Review' : 'For Approval' ?>
        </div>
        <?php
        $displayedOngoingReview = true;
        ?>
    @endif

    @if($protocol->approval === 'Approved & On-going' && !$displayedApprovedOngoing) 
        <div class="ms-2 mt-5" style="
        font-size: 20px; font-weight: 500; font-family: -apple-system, BlinkMacSystemFont, sans-serif;">Approved & On-going
        </div>
        <?php
        $displayedApprovedOngoing = true;
        ?>
    @endif

    @if($protocol->approval === 'Returned' && !$displayedReturned) 
        <div class="ms-2 mt-5" style="
        font-size: 20px; font-weight: 500; font-family: -apple-system, BlinkMacSystemFont, sans-serif;">Returned
        </div>
        <?php
        $displayedReturned = true;
        ?>
    @endif

    @if($protocol->approval === 'Terminated' && !$displayedTerminated) 
        <div class="ms-2 mt-5" style="
        font-size: 20px; font-weight: 500; font-family: -apple-system, BlinkMacSystemFont, sans-serif;">Terminated
        </div>
        <?php
        $displayedTerminated = true;
        ?>
    @endif

    @if($protocol->approval === 'Completed' && !$displayedCompleted) 
        <div class="ms-2 mt-5" style="
        font-size: 20px; font-weight: 500; font-family: -apple-system, BlinkMacSystemFont, sans-serif;">Completed
        </div>
        <?php
        $displayedCompleted = true;
        ?>
    @endif
    <!-- Modal -->
        <div class="modal fade" id="staticBackdrop{{ $protocol->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit History</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-y: auto; max-height: 550px">
                @forelse($protocol->edits->sortByDesc('created_at') as $edit)
                <div class="card mt-2 p-2 shadow-lg border-0">
                <div class="fw-bold">{{ $edit->process }}</div>
                @php
                    $date = \Carbon\Carbon::parse($edit->created_at)->timezone('Asia/Manila');
                    $formattedDate = $date->format('M d, Y g:ia');
                @endphp
                    <div style="font-size: 12px">{{ $formattedDate }}</div>
                </div>
                @empty
                <div class="text-muted">Such empty.</div>
                @endforelse
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
           </div>
          </div>
        </div>
    <!-- End Modal -->

    <div class="py-2">
       <div class="header px-3 mt-1"
          style="
            border: 1px solid silver; 
            border-left:10px solid 
            <?php 
             if($protocol->approval=='On-going Review'){
               echo '#f1c40f';
             }
             else if($protocol->approval=='Approved & On-going'){
              echo 'green';
             }
             else if($protocol->approval=='Returned'){
                echo 'red';
             }
             else if($protocol->approval=='Terminated'){
                echo 'gray';
             }
             else{
                echo 'black';
             }
            ?>; 
            background-color: white; 
            ">
    
       <div class="row" style="<?php echo $protocol->type_of_review=='FR' && Auth::user()->role=='CERC' ? 'opacity: 50%' : '' ?>">
        <div onclick="toggleDiv(<?php echo json_encode($protocol->id) ?>)" style="cursor: pointer" class="col-12 col-lg-5 py-2" style="min-height: 120px">
          <div class="d-flex">
            @php
                $date = \Carbon\Carbon::parse($protocol->created_at)->timezone('Asia/Manila');
                $date_of_receipt = $date->format('M d, Y g:ia');
            @endphp
            <div style="font-weight: 400; color: #696969" class="mt-1">Date of Receipt: {{ $date_of_receipt }}</div>
            @if(Auth::user()->role == 'Admin')
            <div class="d-flex mx-2" style="color: silver; margin-top: 3px">|</div><div style=" font-weight: 400; color: #696969" class="d-flex align-items-center mt-1 pb-2">{{ $protocol->user->role=="CERC" ? $protocol->user->colleges : $protocol->user->role }}</div>
            @endif
            </div>
                <div class="d-flex align-items-center" style="font-size: 16px">
                    <div style="font-weight: 600">{{ $protocol->title }}</div>
      
                </div>
                <div style=" font-weight: 400; font-size: 13px" class="mt-1">Primary Researcher: {{ $protocol->p_researcher }}</div>
        </div>

         
            <div onclick="toggleDiv(<?php echo json_encode($protocol->id) ?>)" style="cursor: pointer" class="col-4 pt-4 ps-0 d-none d-lg-block text-primary">
            @if($protocol->type_of_review=='FR')
                        <div class="fw-bold text-danger">({{ $protocol->type_of_review }}-Full Review)</div>
                        <div></div>
                    @endif
                        <h6>{{ $protocol->status }}</h6>
            </div>
            <div onclick="toggleDiv(<?php echo json_encode($protocol->id) ?>)" style="cursor: pointer" class="col text-end d-none d-lg-flex flex-column pt-1 pb-2 justify-content-between">

                @if(Auth::user()->role == 'CERC')
                    <div class="font-italic fw-bold {{ ($protocol->user->firstname.' '.$protocol->user->lastname == auth()->user()->firstname.' '.auth()->user()->lastname) ? 'text-decoration-underline' : '' }}">{{ ($protocol->user->firstname.' '.$protocol->user->lastname == auth()->user()->firstname.' '.auth()->user()->lastname) ? 'Your Protocol' : 'Uploaded By: '.$protocol->user->firstname.' '.$protocol->user->lastname}}</div>
                @else
                        @if($protocol->user->firstname.' '.$protocol->user->lastname == auth()->user()->firstname.' '.auth()->user()->lastname)
                        <a href="/myprotocols" class="font-italic fw-bold text-decoration-underline text-primary">Your Protocol</a>
                        @else
                      
                        <div onclick="formTrigger(<?php echo json_encode($protocol->id) ?>)" class="font-italic fw-bold text-primary">
                            Uploaded By: {{ $protocol->user->firstname.' '.$protocol->user->lastname }}</div>
                        @endif
                @endif
                  <form id="userProtocols_form{{ $protocol->id }}" method="get" action="/user_protocols">
                    <input type="hidden" name="id" value="{{ $protocol->user->id }}">
                </form>
                    
            

                <div id="actionButtons{{ $protocol->id }}">
                @if(Auth::user()->role=='Admin' || $protocol->user_id==Auth::user()->id)
                <button style="pointer-events: <?php echo $protocol->type_of_review=='FR' && Auth::user()->role!='Admin' ? 'none' : '' ?>;" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'<?php echo $protocol->title.' will be deleted' ?>','/delete/','Protocol')" class="btn btn-outline-danger">Delete <i class="fa-solid fa-trash"></i></button>
                @endif
                </div>
            </div>
            </div>
       </div>

       <div class="px-3 pb-5 pt-3" id="expandDiv{{ $protocol->id }}" 
        style="
          border: 1px solid silver; 
          pointer-events: <?php echo $protocol->type_of_review=='FR' && Auth::user()->role!='Admin' ? 'none' : '' ?>;
          border-top:none; 
          border-left: 10px solid gray;
          background-color: white; 
          display: none; <?php echo $protocol->type_of_review=='FR' && Auth::user()->role=='CERC' ? 'opacity: 50%' : '' ?>">
          <div class="row">
        
            <div class="col">
                <div id="expandedActionButtons" class="mt-2 d-block d-md-flex justify-content-between">
                    <div class="d-flex align-items-start">
                        @if ($protocol->approval !== 'Terminated' && $protocol->approval !== 'Returned' && $protocol->approval !== 'Completed')
                        <button data-bs-toggle="modal" data-bs-target="#terminateModal{{ $protocol->id }}" class="btn btn-danger">Terminate</button>
                        @if(Auth::user()->role=='Admin')
                        <button data-bs-toggle="modal" data-bs-target="#returnModal{{ $protocol->id }}" class="btn btn-outline-secondary ms-2">Return to Uploader</button>
                        @endif
                        @endif
                        @if ($protocol->approval == 'Terminated')
                            <div>
                                <button onclick="unterminate(<?php echo json_encode($protocol->id) ?>)" class="btn btn-dark">Unterminate</button>
                            </div>
                      
                        @endif
                      
                        @if ($protocol->approval == 'Returned')
                            <button onclick="sendBack(<?php echo json_encode($protocol->id) ?>)" class="btn btn-secondary mx-1 px-3">Send Back to UERC</button>
                        @endif
                       
                        @if ($protocol->approval == 'Completed')
                        @php
                            $d = \Carbon\Carbon::parse($protocol->final_decision_access)->timezone('Asia/Manila');
                            $date_of_completion = $date->format('M d, Y g:ia');
                        @endphp
                       <h4>Date of Completion: {{ $date_of_completion }}</h4>
                        @endif

                    </div>
             
                    <div class="mt-3 mt-md-0">    
                        <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $protocol->id }}">Edit History</button>
                        @if(Auth::user()->role=='Admin' || $protocol->user_id==Auth::user()->id)
                        <button onclick="edit_details(<?php echo json_encode($protocol->id) ?>)" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit_modal_1">Edit <i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
                        @endif
                        <button onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'<?php echo $protocol->title.' will be deleted' ?>','/delete/','Protocol')" class="btn btn-outline-danger">Delete <i class="fa-solid fa-trash"></i></button>
                    </div>

                    
                      
                </div>
                <div class="mt-2">
                    @if (count($protocol->t_note)!=0)
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#terminateNoteModal{{ $protocol->id }}">Termination Notes</button>
                    @endif
                    @if (count($protocol->return_note)!=0)
                        <button class="btn btn-dark ms-1" data-bs-toggle="modal" data-bs-target="#commentModal{{ $protocol->id }}">Return Notes</button>
                    @endif
                </div>
            </div>
        </div>
     
        <div class="row">
            <div class="col-lg-6 col-xl-4 mt-3 mt-3">
            <div class="card py-3 shadow" style="height: 100%">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Protocol Code: </div>
                    <div>{{ $protocol->protocol_code }}</div>
                    </div>
               
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Status of Submission: </div>
                    <div>{{ $protocol->status_of_submission }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Primary Researcher: </div>
                    <div>{{ $protocol->p_researcher }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Email: </div>
                    <div>{{ $protocol->email }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Phone-number: </div>
                    <div>{{ $protocol->phone_number }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Co-researcher/s: </div>

                    @if(substr_count($protocol->c_researcher, ",") > 2)
                    <div class="font-italic text-primary" style="cursor: pointer"
                        tabindex="0"
                        data-placement="left" 
                        data-bs-toggle="popover" 
                        data-bs-trigger="focus"
                        data-html="true" 
                        title="Co-researchers"
                        data-content="<a href=''><?php echo str_replace(",","<br>",$protocol->c_researcher) ?></a>" 
                        ><u>View Co-researchers</u>
                    </div>
                    @else
                    <div class="text-end"><?php echo str_replace(",","<br>",$protocol->c_researcher) ?></div>
                    @endif
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Chapter 1-3: </div>
                    @if($protocol->doc1==null)
                        <form class="ps-3" action="/u_doc1/{{ $protocol->id }}" enctype="multipart/form-data" id="u_doc1{{ $protocol->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="form-control" onchange="load_files('#u_doc1{{ $protocol->id }}')" type="file" name="doc1" id="doc1">
                        </form>
                        @else
                        <div class="d-flex">
                            <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Chapter 1-3 will be deleted.','/delete_doc1/','Chapter 1-3')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/doc1/{{ $protocol->doc1 }}" target='_blank'><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->doc1 }}</u></div></a>
                       </div>
                       @endif
                    </div>
                    @if($protocol->doc1_2_access)
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div class="text-danger" style="font-family: 'Roboto', sans-serif;">Chapter 1-3 (2): </div>
                    @if($protocol->doc1_2==null)
                        <form class="ps-3" action="/u_doc1_2/{{ $protocol->id }}" enctype="multipart/form-data" id="u_doc1_2{{ $protocol->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="form-control" onchange="load_files('#u_doc1_2{{ $protocol->id }}')" type="file" name="doc1_2" id="doc1_2">
                        </form>
                        @else
                        <div class="d-flex">
                            <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Chapter 1-3 (2) will be deleted.','/delete_doc1_2/','Chapter 1-3 (2)')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/doc1_2/{{ $protocol->doc1_2 }}" target='_blank'><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->doc1_2 }}</u></div></a>
                       </div>
                       @endif
                    </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Ammendment Form: </div>
                    
                        @if($protocol->ammendment_form == null)
                      
                      <form action="/s_ammendment/{{ $protocol->id }}" enctype="multipart/form-data" id="s_ammendment{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_files('#s_ammendment{{ $protocol->id }}')" type="file" name="ammendment_form" id="ammendment_form">
                      </form>
                      @else
                      <div class="d-flex">
                     
                      <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Ammendment Form will be deleted.','/delete_ammendment/','Ammendment Form')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/ammendment_form/{{ $protocol->ammendment_form }}"><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->ammendment_form }}</u></div></a>
                  
                     
                    
                      </div>
                      @endif
                 
                    </div>
                    @if($protocol->ammendment_form2_access)
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Ammendment Form 2: </div>
                    
                        @if($protocol->ammendment_form2 == null)
                      
                      <form action="/s_ammendment2/{{ $protocol->id }}" enctype="multipart/form-data" id="s_ammendment2{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_files('#s_ammendment2{{ $protocol->id }}')" type="file" name="ammendment_form2" id="ammendment_form2">
                      </form>
                      @else
                      <div class="d-flex">
                     
                      <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Ammendment Form 2 will be deleted.','/d_ammendment2/','Ammendment Form')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/ammendment_form2/{{ $protocol->ammendment_form2 }}"><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->ammendment_form2 }}</u></div></a>
                  
                     
                    
                      </div>
                      @endif
                 
                    </div>
                    @endif
                    
          
            </div>
            </div>
            </div>

            <div class="col-lg-6 col-xl-4 mt-3">
            <div class="card py-3 shadow" style="height: 100%">
                <div class="card-body">
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Date of Receipt: </div>
                    <div>{{ date('M d, Y', strtotime($protocol->date_of_receipt)) }}</div>
                    </div>
             
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Primary Reviewer: </div>
                    <div class="{{ $protocol->primary_reviewer=='EXEMPTED' ? 'text-danger' : '' }}">{{ $protocol->primary_reviewer }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Co-reviewer/s: </div>

                    @if(substr_count($protocol->other_reviewers, ",") > 2)
                    <div class="font-italic text-primary {{ $protocol->primary_reviewer=='EXEMPTED' ? 'text-danger' : '' }}" style="cursor: pointer"
                        tabindex="0"
                        data-placement="left" 
                        data-bs-toggle="popover" 
                        data-bs-trigger="focus"
                        data-html="true" 
                        title="Co-researchers"
                        data-content="<a href=''><?php echo str_replace(",","<br>",$protocol->other_reviewers) ?></a>" 
                        ><u>View Co-researchers</u>
                    </div>
                    @else
                    <div class="text-end {{ $protocol->primary_reviewer=='EXEMPTED' ? 'text-danger' : '' }}"><?php echo str_replace(",","<br>",$protocol->other_reviewers) ?></div>
                    @endif
                    </div>
          
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Research Type: </div>
                    <div>{{ $protocol->research_type }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Status of the Protocol: </div>
                    <div>{{ $protocol->status_of_protocol }}</div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Funding: </div>
                        <div>{{ $protocol->funding }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">OR Number: </div>
                        <div>{{ $protocol->or_number }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">OR Receipt: </div>
                        @if($protocol->or_receipt==null)
                        <form class="ps-3" action="/u_orreceipt/{{ $protocol->id }}" enctype="multipart/form-data" id="u_orreceipt{{ $protocol->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="form-control" onchange="load_files('#u_orreceipt{{ $protocol->id }}')" type="file" name="or_receipt" id="or_receipt">
                        </form>
                        @else
                        <div class="d-flex">
                            <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'OR Receipt will be deleted.','/delete_or/','OR Receipt')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/or_receipt/{{ $protocol->or_receipt }}" target='_blank'><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->or_receipt }}</u></div></a>
                       </div>
                       @endif
                    </div>
                    @if($protocol->or_receipt2_access)
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                        <div class="text-danger" style="font-family: 'Roboto', sans-serif;">OR Receipt (2): </div>
                        @if($protocol->or_receipt2==null)
                        <form class="ps-3" action="/u_orreceipt_2/{{ $protocol->id }}" enctype="multipart/form-data" id="u_orreceipt_2{{ $protocol->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="form-control" onchange="load_files('#u_orreceipt_2{{ $protocol->id }}')" type="file" name="or_receipt2" id="or_receipt2">
                        </form>
                        @else
                        <div class="d-flex">
                            <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'OR Receipt (2) will be deleted.','/delete_or_2/','OR Receipt')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/or_receipt2/{{ $protocol->or_receipt2 }}" target='_blank'><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->or_receipt2 }}</u></div></a>
                       </div>
                       @endif
                    </div>
                    @endif
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Progress Report: </div>
                        @if($protocol->progress_report==null)
                        <form class="ps-3" action="/u_progress/{{ $protocol->id }}" enctype="multipart/form-data" id="u_progress{{ $protocol->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="form-control" onchange="load_files('#u_progress{{ $protocol->id }}')" type="file" name="progress_report" id="progress_report">
                        </form>
                        @else
                        <div class="d-flex">
                            <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Progress report will be deleted.','/delete_progress/','Progress Report')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/progress_report/{{ $protocol->progress_report }}" target='_blank'><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->progress_report }}</u></div></a>
                       </div>
                       @endif
                    </div>
                    @if($protocol->progress_report2_access)
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                        <div class="text-danger" style="font-family: 'Roboto', sans-serif;">Progress Report (2): </div>
                        @if($protocol->progress_report2==null)
                        <form class="ps-3" action="/u_progress_2/{{ $protocol->id }}" enctype="multipart/form-data" id="u_progress_2{{ $protocol->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="form-control" onchange="load_files('#u_progress_2{{ $protocol->id }}')" type="file" name="progress_report2" id="progress_report2">
                        </form>
                        @else
                        <div class="d-flex">
                            <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Progress report (2) will be deleted.','/delete_progress_2/','Progress Report')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/progress_report2/{{ $protocol->progress_report2 }}" target='_blank'><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->progress_report2 }}</u></div></a>
                       </div>
                       @endif
                    </div>
                    @endif
                           
              
          
                    @if($protocol->terminate_attachment)
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Termination Attachment: </div>
                        @if($protocol->terminate_attachment==null)
                        <form class="ps-3" action="/u_terminateattach/{{ $protocol->id }}" enctype="multipart/form-data" id="u_terminateattach{{ $protocol->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="form-control" onchange="load_files('#u_terminateattach{{ $protocol->id }}')" type="file" name="terminate_attachment" id="terminate_attachment">
                        </form>
                        @else
                        <div class="d-flex">
                            @if(Auth::user()->role=="Admin")
                            <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Terminate Attachment will be deleted.','/delete_terminateattach/','Terminate Attachment')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            @endif
                            <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/terminate_attachment/{{ $protocol->terminate_attachment }}" target='_blank'><div class="font-italic text-primary" style="cursor: pointer"><u>{{ $protocol->terminate_attachment }}</u></div></a>
                       </div>
                       @endif
                    </div>
                    @endif

     
                 
                <!--
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                      <div style="font-family: 'Roboto', sans-serif;">Reviewer's Report: </div>
                        <div class="font-italic text-primary" style="cursor: pointer" 
                        tabindex="0"
                        data-placement="left" 
                        data-bs-toggle="popover" 
                        data-bs-trigger="focus"
                        data-html="true" 
                        title="Report File Attachment" 
                        data-content="<a href='/{{ $protocol->reviewers_report }}' target=”_blank”>{{ $protocol->reviewers_report }}</a>">
                        <u>attachment</u></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                      <div style="font-family: 'Roboto', sans-serif;">Protocol Attachments: </div>
                        <div class="font-italic text-primary" style="cursor: pointer" 
                        tabindex="0"
                        data-placement="left" 
                        data-bs-toggle="popover" 
                        data-bs-trigger="focus"
                        data-html="true" 
                        title="Protocol Attachments" 
                        data-content="
                        @foreach(explode('/', $protocol->protocol_attachments) as $n)
                            <div class='mb-2'><a href='/uploads/{{ $n }}' target='_blank'>{{ $n }}</a></div>
                        @endforeach">
                        <u>attachment</u>
                    </div>
                    </div>
                -->
                   
            </div>
            </div>
            </div>

            <div class="col col-xl-4 mt-3">
            <div class="card py-3 shadow" style="height: 100%; pointer-events: <?php echo $protocol->approval=='Terminated' ? 'none' : '' ?>;
               opacity: <?php echo $protocol->approval=='Terminated' ? '50%' : '' ?>">
                <div class="card-body">
                       
                   
                    <div class="py-1" style="border-bottom: 1px solid silver">
                        <div class="" style="font-family: 'Roboto', sans-serif">Type of Review: </div>
                        <div>
                          @if(Auth::user()->role!="Admin")
                          <div class="text-primary">
                            
                          <?php 
                            if($protocol->type_of_review==null) {
                                echo 'Currently being reviewed by UERC.';
                            }
                            else{
                                if($protocol->type_of_review=='ER'){
                                    echo 'ER - Expedited Review';
                                }
                                else if($protocol->type_of_review=='EX'){
                                    echo 'EX - Exempted Review';
                                }
                                else{
                                    echo 'FR - Full Board Review';
                                }
                            }
                            ?>
                            </div>
                      
                          @else
                       
                                <select <?php echo $protocol->approval=='Returned' ? 'disabled' : '' ?> title="Select Type of Review" onchange="reviewType_function(<?php echo json_encode($protocol->id) ?>, this.value)" 
                                name="type_of_review" id="type_of_review{{ $protocol->id }}" 
                                class="form-control selectpicker border border-dark">
                                    <option value="">Select Type of Review</option>
                                    <option value="FR">Full Board</option>
                                    <option value="EX">Exempted</option>
                                    <option value="ER">Expedited</option>
                                </select>
                        
                    
                            <?php
                                echo "<script>
                                $('#type_of_review'+$protocol->id).selectpicker('val', '$protocol->type_of_review')
                              
                                </script>";
                            ?>
                           @endif 
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                      <div style="font-family: 'Roboto', sans-serif;">Reviewer's Report: </div>
      
                     @if($protocol->primary_reviewer != null) 
                      @if($protocol->reviewers_report == null )
                            @if($protocol->type_of_review != 'EX' )
                            <form class="ps-3" action="/s_revreport/{{ $protocol->id }}" enctype="multipart/form-data" id="s_revreport{{ $protocol->id }}" method="post">
                                @csrf
                                @method('PUT')
                                <input class="form-control" onchange="load_files('#s_revreport{{ $protocol->id }}')" type="file" name="reviewers_report" id="reviewers_report">
                            </form>
                            @else
                            <div>NA</div>
                            @endif
                      @else
                      <div class="d-flex">
              
                      @if(Auth::user()->role=="Admin")
                      <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Reviewers report will be deleted.','/delete_report/','Reviewers Report')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      @endif
                      <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/reviewers_report/{{ $protocol->reviewers_report }}" target='_blank'><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->reviewers_report }}</u></div></a>
                       
                      </div>
                      @endif
                    @else
                   
                        <div class="text-end text-primary">Attachment of Report will be opened once Primary Reviewer is assigned.</div>
                    @endif  
                    </div>
                    @if($protocol->reviewers_report2_access)
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                      <div class="text-danger" style="font-family: 'Roboto', sans-serif;">Reviewer's Report (2): </div>
      
                     @if($protocol->primary_reviewer != null) 
                      @if($protocol->reviewers_report2 == null )
                            @if($protocol->type_of_review != 'EX' )
                            <form class="ps-3" action="/s_revreport_2/{{ $protocol->id }}" enctype="multipart/form-data" id="s_revreport_2{{ $protocol->id }}" method="post">
                                @csrf
                                @method('PUT')
                                <input class="form-control" onchange="load_files('#s_revreport_2{{ $protocol->id }}')" type="file" name="reviewers_report2" id="reviewers_report2">
                            </form>
                            @else
                            <div>NA</div>
                            @endif
                      @else
                      <div class="d-flex">
              
                      <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Reviewers report (2) will be deleted.','/delete_report_2/','Reviewers Report')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/reviewers_report/{{ $protocol->reviewers_report2 }}" target='_blank'><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->reviewers_report2 }}</u></div></a>
                       
                      </div>
                      @endif
                    @else
                   
                        <div class="text-end text-primary">Attachment of Report will be opened once Primary Reviewer is assigned.</div>
                    @endif  
                    </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                      <div style="font-family: 'Roboto', sans-serif;">Protocol Attachments: </div>
                    @if($protocol->type_of_review != null)  
                      @if($protocol->protocol_attachments != null)
                      <div class="d-flex">
                      <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Attachments will be deleted.','/delete_attachments/','Attachments')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div>
                      <div class="font-italic text-primary d-flex" style="cursor: pointer" 
                        tabindex="0"
                        data-placement="left" 
                        data-bs-toggle="popover" 
                        data-bs-trigger="focus"
                        data-html="true" 
                        title="Protocol Attachments" 
                        data-content="
                        @foreach(explode('/', $protocol->protocol_attachments) as $filename)
                            <div class='mb-2'><a href='/protocols/{{ $protocol->college }}/{{ $protocol->title }}/attachments/{{ $filename }}' target='_blank'>{{ $filename }}</a></div>
                        @endforeach">
                       
                        <u>attachment</u>
                        
                    </div>
                      </div>
                      
                     @else
                      <form action="/s_attachments/{{ $protocol->id }}" enctype="multipart/form-data" id="s_attachments{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_files('#s_attachments{{ $protocol->id }}')" type="file" name="protocol_attachments[]" id="protocol_attachments" multiple>
                     </form>
                     @endif
                    @else
                    <div class="text-end text-primary">Multiple attachments will be opened once Type of Review is assigned.</div>
                    @endif 
                    </div>
               
                    <div class="d-flex justify-content-between align-items-center mt-2 pb-1" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Decision: </div>
                        @if($protocol->type_of_review!='EX')
                        <select <?php echo $protocol->reviewers_report==null || $protocol->approval=='Returned' ? 'disabled' : '' ?> <?php echo $protocol->approval=='Completed' &&  Auth::user()->role!='Admin' ? 'disabled' : '' ?> onchange="firstDecision_function(<?php echo json_encode($protocol->id) ?>, this.value)" title="Select Decision" class="form-control selectpicker border border-secondary ms-2" name="first_decision" id="first_decision{{ $protocol->id }}">
                            <option value="">Reset</option>
                            <option value="Approved">Approved</option>
                            <option value="Declined">Declined</option>
                        </select>
                        <?php
                                echo "<script>
                                $('#first_decision'+$protocol->id).selectpicker('val', '$protocol->first_decision')
                                </script>";
                            ?>
                        @else
                        <div>Approved</div>
                        @endif
                    </div>
                    
                
                    @if($protocol->first_decision=='Approved')
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Final Report: </div>
                       @if($protocol->first_decision_access) 
                        @if($protocol->final_report_form == null)
                      
                      <form action="/s_finalreport/{{ $protocol->id }}" enctype="multipart/form-data" id="s_finalreport{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_files('#s_finalreport{{ $protocol->id }}')" type="file" name="final_report_form" id="final_report_form">
                      </form>
                      @else
                      <div class="d-flex">
                     
                      <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Final report will be deleted.','/delete_finalreport/','Final Report')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/final_report_form/{{ $protocol->final_report_form }}"><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->final_report_form }}</u></div></a>
                  
                     
                    
                      </div>
                      @endif
                     @else
                     <div class="text-end text-primary">Attachment of Final Report will be opened once Initial Certificate is issued.</div>
                     @endif 
                    </div>
                    @if($protocol->final_report_form2_access)
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                        <div class="text-danger" style="font-family: 'Roboto', sans-serif;">Final Report (2): </div>
                       @if($protocol->first_decision_access) 
                        @if($protocol->final_report_form2 == null)
                      
                      <form action="/s_finalreport_2/{{ $protocol->id }}" enctype="multipart/form-data" id="s_finalreport_2{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_files('#s_finalreport_2{{ $protocol->id }}')" type="file" name="final_report_form2" id="final_report_form2">
                      </form>
                      @else
                      <div class="d-flex">
                     
                      <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Final report (2) will be deleted.','/delete_finalreport_2/','Final Report')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/final_report_form2/{{ $protocol->final_report_form2 }}"><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->final_report_form2 }}</u></div></a>
                  
                     
                    
                      </div>
                      @endif
                     @else
                     <div class="text-end text-primary">Attachment of Final Report will be opened once Initial Certificate is issued.</div>
                     @endif 
                    </div>
                    @endif
                    @endif
                    @if($protocol->first_decision=='Approved')
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Final Manuscript: </div>
                       @if($protocol->first_decision_access) 
                        @if($protocol->final_manuscript == null)
                      
                      <form action="/s_finalmanu/{{ $protocol->id }}" enctype="multipart/form-data" id="s_finalmanu{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_files('#s_finalmanu{{ $protocol->id }}')" type="file" name="final_manuscript" id="final_manuscript">
                      </form>
                      @else
                      <div class="d-flex">
                     
                      <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Final Manuscript will be deleted.','/delete_finalmanu/','Final Manuscript')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/final_manuscript/{{ $protocol->final_manuscript }}"><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->final_manuscript }}</u></div></a>
                      </div>
                      @endif
                     @else
                     <div class="text-end text-primary">Attachment of Final Manuscript will be opened once Initial Certificate is issued.</div>
                     @endif 
                    </div>
                    @if($protocol->final_manuscript2_access)
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                        <div class="text-danger" style="font-family: 'Roboto', sans-serif;">Final Manuscript (2): </div>
                       @if($protocol->first_decision_access) 
                        @if($protocol->final_manuscript2 == null)
                      
                      <form action="/s_finalmanu_2/{{ $protocol->id }}" enctype="multipart/form-data" id="s_finalmanu_2{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_files('#s_finalmanu_2{{ $protocol->id }}')" type="file" name="final_manuscript2" id="final_manuscript2">
                      </form>
                      @else
                      <div class="d-flex">
                     
                      <div style="cursor: pointer" onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'Final Manuscript (2) will be deleted.','/delete_finalmanu_2/','Final Manuscript')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2 {{ Auth::user()->role!='Admin' ? 'd-none' : '' }}" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/protocols/{{ $protocol->college }}/{{ $protocol->title }}/final_manuscript2/{{ $protocol->final_manuscript2 }}"><div class="font-italic text-primary insert-line-breaks" style="cursor: pointer"><u>{{ $protocol->final_manuscript2 }}</u></div></a>
                      </div>
                      @endif
                     @else
                     <div class="text-end text-primary">Attachment of Final Manuscript will be opened once Initial Certificate is issued.</div>
                     @endif 
                    </div>
                    @endif
                    @endif
            
               
                 
            </div>
            </div>
            </div>
            </div>

          <div class="row mt-5">
            <div class="col-md-6">
            <div class="card bg-light py-3" style="min-height: 187px">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Acknowledgement Form: </div>
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Acknowledgement Form Attachment"
                    data-content="
                    <div><a href='/acknowledgement_form/{{ $protocol->id }}'>acknowledgement form.pdf</a></div>
                    <div><a href='/acknowledgement_receipt/{{ $protocol->id }}'>acknowledgement receipt (report form).pdf</a></div>
                    " 
                    ><u>attachment</u></div>
                    </div>
            
                    <div class="d-flex justify-content-between my-3" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Notice of Review: </div>
                    @if($protocol->type_of_review != null && $protocol->type_of_review != 'EX')
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Notice of Review Form Attachment"
                    data-content="<a href='/notice_of_review/{{ $protocol->id }}'>notice of review.pdf</a>" 
                    ><u>attachment</u></div>
                    @else
                    <div class="font-italic text-secondary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Notice of Review"
                    data-content="<?php echo $protocol->type_of_review=='EX' ? 'This form is not required for Exempted Reviews.' : 'Currently Unavailable. Notice of Review will only be issued once Type of Review is assigned.' ?>">
                        <u>attachment</u>
                    </div>
                    @endif
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Non-disclosure & Confidentiality Agreement: </div>
                    @if($protocol->type_of_review != null && $protocol->type_of_review != 'EX')
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus" 
                    data-html="true"
                    title='Non-disclosure Approval Form'
                    data-content="<a href='/ndc_agreement/{{ $protocol->id }}'>ndc_agreement.pdf</a>" 
                    ><u>attachment</u></div>
                    @else
                    <div class="font-italic text-secondary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Non-disclosure Approval Form"
                    data-content="<?php echo $protocol->type_of_review=='EX' ? 'This form is not required for Exempted Reviews.' : 'Currently Unavailable. Non-disclosure & Confidentiality Agreement Form will only be issued once Type of Review is assigned.' ?>">
                        <u>attachment</u>
                    </div>
                    @endif
                    </div>

                  
            </div>
            </div>
            </div>

            <div class="col-md-6 mt-3 mt-md-0">
            <div class="card bg-light py-3" style="min-height: 187px">
                <div class="card-body">
                 
                    <div class="d-flex justify-content-between py-1" style="border-bottom: 1px solid silver">
                    <div class="d-flex" style="font-family: 'Roboto', sans-serif;">
                    <div>Initial Certificate of Approval:</div>  
                        @if(Auth::user()->role=='Admin' && $protocol->first_decision=='Approved' && $protocol->type_of_review!='EX')
                        <button <?php echo $protocol->approval=='Terminated' ? 'disabled' : '' ?> 
                        onclick='firstDecision_access(<?php echo json_encode($protocol->id) ?>,
                        <?php echo json_encode($protocol->first_decision_access) ?>)' 
                        class="btn btn-<?php echo $protocol->first_decision_access==null ? 'primary' : 'dark' ?>">
                        <?php echo $protocol->first_decision_access==null ? 
                        'Grant Access' : date('M d, Y', strtotime($protocol->first_decision_access))  ?></button>
                        @else
                        <div class="text-primary ms-2 <?php echo $protocol->first_decision_access==null ? 'd-none' : '' ?>">{{ date('M d, Y', strtotime($protocol->first_decision_access)) }}</div>
                        @endif
                    </div>
                    @if($protocol->first_decision_access != null)
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Initial Certificate of Approval Form Attachment"
                    data-content="<a href='/initial/{{ $protocol->id }}'>initial certificate.pdf</a>">
                        <u>attachment</u>
                    </div>
                    @else
                    <div class="font-italic text-secondary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Initial Certificate of Approval Form Attachment"
                    data-content="Currently Unavailable. Initial Certificate will only be issued once First Decision is Approved.">
                        <u>attachment</u>
                    </div>
                    @endif
                    </div>
                    <div class="d-flex justify-content-between mt-2 py-1" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Final Certificate of Approval: 
                       
                    </div>
                    
                    @if($protocol->final_decision_access != null)
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Initial Certificate of Approval Form Attachment"
                    data-content="<a href='/final/{{ $protocol->id }}'>final certificate.pdf</a>">
                        <u>attachment</u>
                    </div>
                    @else     <div class="font-italic text-secondary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Final Certificate of Approval Form Attachment"
                    data-content="Currently Unavailable. Final Certificate will only be issued once Final Decision is Approved.">
                        <u>attachment</u>
                    </div>
                    @endif
                    </div>
                    <div class="d-flex mt-2 justify-content-between" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Notice of Decision & Action Taken: </div>
                    @if($protocol->type_of_review != null)
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Notice of Decision & Action Form Attachment"
                    data-content="<a href='/nda_taken/{{ $protocol->id }}'>notice of decision & action taken.pdf</a>" 
                    ><u>attachment</u></div>
                    @else
                    <div class="font-italic text-secondary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Notice of Decision/Action Taken"
                    data-content="Currently Unavailable. Creation of Notice of Decision/Action Taken will only be opened once Type of Review is assigned.">
                        <u>attachment</u>
                    </div>
                    @endif
                    </div>
               
               

            </div>
            </div>
            
            </div>
         
          </div>
 
          @include('livewire.protocols.modals.return_modal')
          @include('livewire.protocols.modals.returnNote_modal')
          @include('livewire.protocols.modals.terminate_modal')
          @include('livewire.protocols.modals.terminateNote_modal')

          @if(Auth::user()->role=="Admin" && $protocol->first_decision_access && $protocol->approval!='Completed')
          <div class="row mt-5 pt-4">
            <div class="col text-center">
                <button <?php echo ($protocol->or_receipt && $protocol->progress_report && $protocol->final_manuscript && 
                $protocol->final_report_form && $protocol->first_decision_access)  ? '' : 'disabled' ?> 
                onclick="complete(<?php echo json_encode($protocol->id) ?>)" 
                class="btn btn-success mx-2 px-3" style="height: 50px">Mark as Complete</button>
            </div>
          </div>
          @endif
          @if(Auth::user()->role=="Admin" && $protocol->approval=='Completed')
          <div class="row mt-5 pt-4">
            <div class="col text-center">
                <button 
                onclick="reset(<?php echo json_encode($protocol->id) ?>)" 
                class="btn btn-dark mx-2 px-3" style="height: 50px">Reset Completion</button>
            </div>
          </div>
          @endif
     
       </div>
       
       </div>
  
       @empty
        @if($query!='')
        <h1 class="text-center mt-5 pt-5 text-muted">No results found on search '{{ $query }}'.</h1>
        @else
       <h1 class="text-center mt-5 pt-5 text-muted">No protocol found.</h1>
       @endif
       @endforelse
        <div class="px-4 mt-3">
        @if(str_contains(request()->path(), "protocol_management/search") || $tor!='all')
             
        @else
            {{ $protocols->links() }}
        @endif
        </div>
      
</div>
</div>
<script>
$('[data-bs-toggle="popover"]').popover({
trigger: 'focus'
})

function insertLineBreaks() {
        var elements = document.querySelectorAll('.insert-line-breaks');
        elements.forEach(function (element) {
            var text = element.textContent;
            var newText = '';

            for (var i = 0; i < text.length; i += 30) {
                newText += text.slice(i, i + 30);
                if (i + 30 < text.length) {
                    newText += '<br>';
                }
            }

            element.innerHTML = newText;
        });
    }

    // Call the function when the page loads
    window.onload = insertLineBreaks;

function reviewType_function(id, value){
Swal.fire({
title: 'Type of Review',
text: 'Type of Review will be assigned as '+value,
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Proceed'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
  type: "put",
  url: "/assign_reviewType/"+id,
  data: {
          value: value // Include the 'value' variable as data
        },
  success: function (response) {
      Swal.fire(
      'Success',
      'Type of Review has been assigned as '+value,
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

function approve(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve this protocol.'
    }).then((result) => {
        if (result.isConfirmed) {
        $.ajax({
            type: "get",
            url: "/approve/"+id,
            success: function (response) {
                Swal.fire(
                'Approved!',
                'The protocol has been approved.',
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