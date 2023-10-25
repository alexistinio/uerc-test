<!------------------------------Completed Protocols------------------------------>
<!------------------------------Completed Protocols------------------------------>

<div class="row" id="header_completed">
    
    <div class="col 
    
    ">
  
   
    <div class="d-flex align-items-end justify-content-between mb-2">
        <div class="ms-2" style="
        font-size: 20px; font-weight: 500; font-family: -apple-system, BlinkMacSystemFont, sans-serif;">Completed
        </div>
    </div>
    
    
    @foreach($completedProtocols as $protocol)
  
  <div class="py-2">
     <div class="header px-3 mt-1" 
        style="
          border: 1px solid silver; 
          border-left:10px solid black;
          background-color: white; 
          ">
  
     <div class="row">
     <div onclick="toggleDiv(<?php echo json_encode($protocol->id) ?>)" style="cursor: pointer" class="col-12 col-md-8 py-2" style="min-height: 120px">
          <div class="d-flex">
            <div style="font-weight: 400; color: #696969" class="mt-1">Date of Receipt: {{ date('M d, Y', strtotime($protocol->date_of_receipt)) }}</div>
            @if(Auth::user()->role == 'Admin')
            
            <div class="d-flex mx-2" style="color: silver; margin-top: 3px">|</div><div style=" font-weight: 400; color: #696969" class="d-flex align-items-center mt-1 pb-2">{{ $protocol->user->role=="CERC" ? $protocol->user->colleges : $protocol->user->role }}</div>
            @endif
            </div>
     
                <div style="font-weight: 600;font-size: 16px">{{ $protocol->title }}</div>
                <div style=" font-weight: 400; font-size: 13px" class="mt-1">Primary Investigator: {{ $protocol->p_researcher }}</div>
    </div>

               <!------------------------------------Comment Modal----------------------------------------------->  
                  <div class="modal fade" id="commentModal{{ $protocol->id }}" data-bs-backdrop="static" tabindex="-1000" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Comments:</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <div class="mb-2">{{ $protocol->comment }}</div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                          </div>
                      </div>
                      </div>
                  <!------------------------------------------------------------------------------------------------>
              <div class="col text-end py-2 d-none d-md-block">
                  <div class="d-flex justify-content-end">
                  @if($protocol->comment != null)
                      <svg data-bs-toggle="modal" data-bs-target="#commentModal{{ $protocol->id }}" style="cursor: pointer" class="me-2" width="35px" height="35px" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M21 6H3C2.72 6 2.5 6.22 2.5 6.5V14.5C2.5 14.78 2.72 15 3 15H5.5V19L9.5 15H21C21.28 15 21.5 14.78 21.5 14.5V6.5C21.5 6.23 21.27 6 21 6Z" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M5 8.5H19" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M5 10.5H19" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M5 12.5H11" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                  @endif
                      <div class="font-italic">{{ $protocol->approval }}</div>
                  </div>
              

                  <div id="actionButtons{{ $protocol->id }}" class="mt-4">
                  @if(Auth::user()->role == 'Admin')
                  <a href="/export_pdf/{{ $protocol->id }}" class="btn btn-outline-dark">Download <i class="fa-sharp fa-solid fa-download"></i></a>
                  @endif
                  <button onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'<?php echo $protocol->title ?>')" class="btn btn-outline-danger">Delete <i class="fa-solid fa-trash"></i></button>
                  </div>
              </div>
          </div>
     </div>

     <div class="px-3 pt-3" id="expandDiv{{ $protocol->id }}" 
     style="
        border: 1px solid silver; 
        min-height: 620px; 
        border-top:none; 
        border-left: 10px solid gray;
        background-color: white; 
        display: none">
          <div class="row">
            <div class="col">
                <h1 class="mt-4" style="font-size: 18px; font-family: 'Noto Sans JP', sans-serif;">{{ $protocol->title }}</h1>
                <div class="font-italic">Uploaded By: {{ $protocol->user->firstname }} {{ $protocol->user->lastname }}</div>
            </div>
            <div class="col-md-6 text-md-end">
                <div id="expandedActionButtons" class="mt-4">
                        @if(Auth::user()->role=='Admin')
                        <a href="/export_pdf/{{ $protocol->id }}" class="btn btn-outline-dark">Download <i class="fa-sharp fa-solid fa-download"></i></a>
                        @endif
                        <button onclick="edit_details(<?php echo json_encode($protocol->id) ?>)" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit_modal_1">Edit <i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
                        <button onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'<?php echo $protocol->title ?>')" class="btn btn-outline-danger">Delete <i class="fa-solid fa-trash"></i></button>
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
                    <div style="font-family: 'Roboto', sans-serif;">Date of Receipt: </div>
                    <div>{{ date('M d, Y', strtotime($protocol->date_of_receipt)) }}</div>
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
                            <input class="form-control" onchange="load_doc1(<?php echo json_encode($protocol->id) ?>)" type="file" name="doc1" id="doc1">
                        </form>
                        @else
                        <div class="d-flex">
                            <div style="cursor: pointer" onclick="delete_doc1(<?php echo json_encode($protocol->id) ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            <a href="/storage/protocols/{{ $protocol->title }}/doc1/{{ $protocol->doc1 }}" target='_blank'><div class="font-italic text-primary" style="cursor: pointer"><u>{{ $protocol->doc1 }}</u></div></a>
                       </div>
                       @endif
                    </div>
            </div>
            </div>
            </div>
            <div class="col-lg-6 col-xl-4 mt-3">
            <div class="card py-3 shadow" style="height: 100%">
                <div class="card-body">
                   
                  
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Primary Reviewer: </div>
                    <div>{{ $protocol->primary_reviewer }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Other Reviewer/s:  </div>
                    <div>{{ $protocol->other_reviewers }}</div>
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
                            <input class="form-control" onchange="load_or(<?php echo json_encode($protocol->id) ?>)" type="file" name="or_receipt" id="or_receipt">
                        </form>
                        @else
                        <div class="d-flex">
                            <div style="cursor: pointer" onclick="delete_or(<?php echo json_encode($protocol->id) ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            <a href="/storage/protocols/{{ $protocol->title }}/or_receipt/{{ $protocol->or_receipt }}" target='_blank'><div class="font-italic text-primary" style="cursor: pointer"><u>{{ $protocol->or_receipt }}</u></div></a>
                       </div>
                       @endif
                    </div>
                    @if($protocol->terminate_attachment)
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Termination Attachment: </div>
                        @if($protocol->terminate_attachment==null)
                        <form class="ps-3" action="/u_terminateattach/{{ $protocol->id }}" enctype="multipart/form-data" id="u_terminateattach{{ $protocol->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="form-control" onchange="load_terminateattach(<?php echo json_encode($protocol->id) ?>)" type="file" name="terminate_attachment" id="terminate_attachment">
                        </form>
                        @else
                        <div class="d-flex">
                            @if(Auth::user()->role=="Admin")
                            <div style="cursor: pointer" onclick="delete_terminateattach(<?php echo json_encode($protocol->id) ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg></div> 
                            @endif
                            <a href="/storage/protocols/{{ $protocol->title }}/terminate_attachment/{{ $protocol->terminate_attachment }}" target='_blank'><div class="font-italic text-primary" style="cursor: pointer"><u>{{ $protocol->terminate_attachment }}</u></div></a>
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
                        data-content="<a href='/storage/{{ $protocol->reviewers_report }}' target=”_blank”>{{ $protocol->reviewers_report }}</a>">
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
                            <div class='mb-2'><a href='/storage/uploads/{{ $n }}' target='_blank'>{{ $n }}</a></div>
                        @endforeach">
                        <u>attachment</u>
                    </div>
                    </div>
                -->
                   
            </div>
            </div>
            </div>

            <div class="col col-xl-4 mt-3">
            <div class="card py-3 shadow" style="height: 100%">
                <div class="card-body">
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Type of Review: </div>
                        <div>{{ $protocol->type_of_review }}</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                      <div style="font-family: 'Roboto', sans-serif;">Reviewer's Report: </div>
      
                      @if($protocol->reviewers_report == null)
                      
                      <form action="/s_revreport/{{ $protocol->id }}" enctype="multipart/form-data" id="s_revreport{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_report(<?php echo json_encode($protocol->id) ?>)" type="file" name="reviewers_report" id="reviewers_report">
                      </form>
                      @else
                      <div class="d-flex">
                     
                      <div style="cursor: pointer" onclick="delete_report(<?php echo json_encode($protocol->id) ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/storage/{{ $protocol->title }}/{{ $protocol->reviewers_report }}"><div class="font-italic text-primary" style="cursor: pointer"><u>{{ $protocol->reviewers_report }}</u></div></a>
                  
                     
                    
                      </div>
                      @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                      <div style="font-family: 'Roboto', sans-serif;">Protocol Attachments: </div>
                      @if($protocol->protocol_attachments != null)
                      <div class="d-flex">
                      <div style="cursor: pointer" onclick="delete_attachments(<?php echo json_encode($protocol->id) ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
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
                            <div class='mb-2'><a href='/storage/{{ $protocol->title }}/{{ $filename }}' target='_blank'>{{ $filename }}</a></div>
                        @endforeach">
                       
                        <u>attachment</u>
                        
                    </div>
                      </div>
                      
                    @else
                      <form action="/s_attachments/{{ $protocol->id }}" enctype="multipart/form-data" id="s_attachments{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_attachments(<?php echo json_encode($protocol->id) ?>)" type="file" name="protocol_attachments[]" id="protocol_attachments" multiple>
                     </form>
                     @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2 pb-1" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">First Decision: </div>
                    <button id="firstDecision" onclick='firstDecision_function(<?php echo json_encode($protocol->id) ?>,<?php echo json_encode($protocol->first_decision) ?>)' 
                    class="btn btn-<?php echo ($protocol->first_decision==null) ? 'primary' : 'dark' ?>">
                    @if($protocol->first_decision==null)
                    {{ $protocol->first_decision }}
                    @else
                    {{ date('M d, Y', strtotime($protocol->first_decision)) }}
                    @endif
                        <span style="display: <?php echo ($protocol->first_decision==null) ? 'block' : 'none' ?>">Approve</span></button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Progress Report: </div>
                      @if($protocol->first_decision_access != null)  
                        @if($protocol->progress_report == null)
                      
                      <form action="/s_progress/{{ $protocol->id }}" enctype="multipart/form-data" id="s_progress{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_progress(<?php echo json_encode($protocol->id) ?>)" type="file" name="progress_report" id="progress_report">
                      </form>
                      @else
                      <div class="d-flex">
                     
                      <div style="cursor: pointer" onclick="delete_progress(<?php echo json_encode($protocol->id) ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/storage/{{ $protocol->title }}/{{ $protocol->progress_report }}"><div class="font-italic text-primary" style="cursor: pointer"><u>{{ $protocol->progress_report }}</u></div></a>
              
                      </div>
                      @endif
                     @else
                     <div class="text-end text-primary">Attachment of Progress Report will be opened once Initial Certificate is issued.</div>
                     @endif 
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2" style="border-bottom: 1px solid silver">
                        <div style="font-family: 'Roboto', sans-serif;">Final Manuscript: </div>
                       @if($protocol->first_decision_access) 
                        @if($protocol->final_manuscript == null)
                      
                      <form action="/s_finalmanu/{{ $protocol->id }}" enctype="multipart/form-data" id="s_finalmanu{{ $protocol->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-control" onchange="load_finalmanu(<?php echo json_encode($protocol->id) ?>)" type="file" name="final_manuscript" id="final_manuscript">
                      </form>
                      @else
                      <div class="d-flex">
                     
                      <div style="cursor: pointer" onclick="delete_finalmanu(<?php echo json_encode($protocol->id) ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                      </svg></div> 
                      <a href="/storage/{{ $protocol->title }}/{{ $protocol->final_manuscript }}"><div class="font-italic text-primary" style="cursor: pointer"><u>{{ $protocol->final_manuscript }}</u></div></a>
                  
                     
                    
                      </div>
                      @endif
                     @else
                     <div class="text-end text-primary">Attachment of Final Manuscript will be opened once Initial Certificate is issued.</div>
                     @endif 
                    </div>
              
               
                 
            </div>
            </div>
            </div>
            </div>

          <div class="row mt-5 {{ Auth::user()->role == 'User' ? 'pb-5' : '' }}">
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
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Transmittal Form:  </div>
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Transmittal Form Attachment"
                    data-content="
                    <div><a href='/transmittal_form/{{ $protocol->id }}'>transmittal form.pdf</a></div>
                    <div><a href='/transmittal_form_log/{{ $protocol->id }}'>transmittal form log.pdf</a></div>
                    " 
                    ><u>attachment</u></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Notice of Review: </div>
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Notice of Review Form Attachment"
                    data-content="<a href='/notice_of_review/{{ $protocol->id }}'>notice of review.pdf</a>" 
                    ><u>attachment</u></div>
                    </div>
                    <div class="d-flex mt-2 justify-content-between" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Notice of Decision & Action Taken: </div>
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Notice of Decision & Action Form Attachment"
                    data-content="<a href='/nda_taken/{{ $protocol->id }}'>notice of decision & action taken.pdf</a>" 
                    ><u>attachment</u></div>
                    </div>
                  
            </div>
            </div>
            </div>

            <div class="col-md-6 mt-3 mt-md-0 mb-5">
            <div class="card bg-light py-3" style="min-height: 187px">
                <div class="card-body">
                 
                    <div class="d-flex justify-content-between" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Initial Certificate of Approval:  </div>
                    @if($protocol->first_decision != null)
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
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Final Certificate of Approval: </div>
                    
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus"
                    data-html="true" 
                    title="Final Certificate of Approval Form Attachment"
                    data-content="<a href='/final/{{ $protocol->id }}'>final certificate.pdf</a>">
                        <u>attachment</u>
                    </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid silver">
                    <div style="font-family: 'Roboto', sans-serif;">Non-disclosure & Confidentiality Agreement: </div>
                    <div class="font-italic text-primary" style="cursor: pointer"
                    tabindex="0"
                    data-placement="left" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="focus" 
                    data-html="true"
                    title='Non-disclosure Approval Form'
                    data-content="<a href='/ndc_agreement/{{ $protocol->id }}'>ndc_agreement.pdf</a>" 
                    ><u>attachment</u></div>
                    </div>
               

            </div>
            </div>
            </div>
          </div>
 
          <!----------------------------Return to Uploader Modal----------------------------->

        <div class="modal fade" id="returnModal{{ $protocol->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Return to Uploader</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2">Are you sure? You may leave a note below.</div>
                <form wire:submit.prevent="return({{ $protocol->id }})">
                   @csrf
                    <textarea wire:model.defer="comment" style="resize: none; width: 100%; height: 120px"></textarea>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Return Protocol</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <!----------------------------------------------------------------------------------->

     
       </div>
     </div>
     @endforeach
     <div class="px-4 mt-3">
     @if(str_contains(request()->path(), "protocol_management/search"))
             
             @else
             {{ $completedProtocols->links() }}
             @endif
       </div>
 
  </div>
</div>
<script>

$('[data-bs-toggle="popover"]').popover({
trigger: 'focus'
})

</script>