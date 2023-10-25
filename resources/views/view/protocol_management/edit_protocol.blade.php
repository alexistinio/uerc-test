<style>
  span{
    display: none
  }
</style>
<form id="form_u" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
<div class="modal fade" data-bs-backdrop="static" id="edit_modal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

   
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Protocol</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.reload()" aria-label="Close"></button>
      </div>
      <div class="modal-body px-3 px-lg-5">
      
      <div class="row">
        <div class="col">
        <label class="px-2 mb-1 mt-3" for="title" style="font-size: 18px">Title: <span style="color:red">*</span></label>  
        <input id="role" name="role" type="hidden">
        <input id="edit_title" type="text" class="form-control border border-secondary" name="edit_title" autocomplete="title" placeholder="Enter Title">

      <span class="invalid-title" style="color:red">
                Title is required
              </span>
        </div>
      </div>

     
        <div class="row">
          <div class="col-6">
          <label class="px-2 mb-1 mt-3" for="protocol_code">Protocol Code   <span style="color:red">*</span></label>
            <select name="edit_protocol_code" title="Nothing Selected" class="form-control selectpicker border border-secondary border border-secondary" id="edit_protocol_code" data-live-search="true">
              <option value="" disabled>Select Protocol Code</option>
              @foreach($protocolCode as $protocol)
              <option value="{{ $protocol->protocol_code }}">{{ $protocol->protocol_code }}</option>
              @endforeach
            </select>
            <span class="invalid-protocol-code" style="color:red">
                Protocol Code is required
              </span>
          </div>
     
          <div class="col-6">
          <label class="px-2 mb-1 mt-3" for="status_of_submission">Status of Submission   <span style="color:red">*</span></label>
              <select name="edit_status_of_submission" title="Nothing Selected" class="form-control selectpicker border border-secondary border border-secondary" id="edit_status_of_submission" >
                <option value="" disabled>Select Status of Submission</option>
                <option value="Initial Submission">Initial Submission</option>
                <option value="Re-Submission">Re-Submission</option>
              </select>
              <span class="invalid-status" style="color:red">
                  Status of Submission is required
                </span>
          </div>
        </div>
                 

          <h4 class="mt-5">Researchers</h4>

                
                  <div class="row">
                    <div class="col-12 col-xl-6 align-items-center">
                         <label class="px-2 mb-1 mt-3" for="p_researcher">Principal Investigator  <span style="color:red">*</span></label>
                        <select name="edit_p_researcher" title="Nothing Selected" class="form-control selectpicker border border-secondary" id="edit_p_researcher" data-live-search="true">
                            <option value="" disabled>Select Principal Investigator</option>
                   
                            @foreach($researchers as $researcher)
                            <option value="{{ $researcher->title }} {{ $researcher->firstname }} {{ $researcher->lastname }}" data-id="{{ $researcher->id }}">{{ $researcher->title }} {{ $researcher->firstname }} {{ $researcher->lastname }}</option>
                            @endforeach
                     
                   
                          </select>
                            <span class="invalid-p" style="color:red">
                                Principal Investigator is required
                              </span>
                      </div>
                      

                <div wire:ignore class="col-12 col-xl-6 align-items-center">
               <label class="px-2 mb-1 mt-3" for="c_researcher">Co-Researchers (Optional)<span style="color:red">*</span></label>
                <select data-live-search="true" class="form-control selectpicker border border-secondary" name="edit_c_researcher" id="edit_c_researcher" multiple>
                  @foreach($researchers as $researcher)
                    <option value="{{ $researcher->title }} {{ $researcher->firstname }} {{ $researcher->lastname }}">{{ $researcher->title }} {{ $researcher->firstname }} {{ $researcher->lastname }}</option>
                  @endforeach
                </select>
                <span class="invalid-c" style="color:red">
                    Co-Researcher is required
                  </span>
                </div>
          </div>
          
       
          <div class="row showDetails"> 
            <h4 class="mt-5">Details of Principal Investigator</h4>
              <div class="col-6">
                <label class="px-2 mt-3" for="email">Email</label>
                <input type="hidden" name="edit_email" id="editEmail" class="form-control">
                <input type="text" name="email" id="showEmail" class="form-control" disabled>
              </div>
          
              <div class="col-6">
                <label class="px-2 mt-3" for="phone_number">Phone Number</label>
                <input type="hidden" name="edit_phone_number" id="edit_phone_number" class="form-control">
                <input type="text" name="phone_number" id="show_phone_number" class="form-control" disabled>
              </div> 
          </div>
        </div>
     
        <hr style="border:3px solid orange">
        <div class="row pb-3 px-4">
        
          <div class="col offset-md-4 text-center">
            <div class="pt-1">1 / 2</div>
          </div>
          <div class="col text-end">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="location.reload()">Back</button>
            <button id="edit_next_button" type="button" class="btn btn-warning">Next</button>
          </div>
      </div>
      </div>
    </div>
  </div>



<!--------------------------------------------------Modal 2-------------------------------------------------->
<!--------------------------------------------------Modal 2-------------------------------------------------->


<div class="modal fade" data-bs-backdrop="static" id="edit_modal_2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Edit Protocol</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-3 px-lg-5">
    
    
    <div id="hideReviewers" style="display: none">
    <h4 class="mt-3 font-weight-bold">Reviewers</h4>
      
      <div class="row mt-3">
        <div class="col-lg-6">
          <label class="px-2" for="edit_primary_reviewer">Primary <span style="color:red">*</span></label>
          <input list="reviewers" type="text" id="edit_primary_reviewer" name="edit_primary_reviewer" class="form-control border border-secondary" placeholder="Enter Full Name of Primary Reviewer" autocomplete="off">
            <datalist id="reviewers">
                @foreach($board_members as $b)
                    <option data-attr="{{ $b->id }}" value="{{ $b->title }} {{ $b->firstname }} {{ $b->lastname }}">{{ $b->title }} {{ $b->firstname }} {{ $b->lastname }}</option>
                @endforeach
            </datalist>

            <span class="invalid-primary" style="color:red">
                    Primary reviewer is required
            </span>
        </div>

        <div class="col-lg-6 mt-3 mt-lg-0">
            <label class="px-2"for="edit_other_reviewers">Other Reviewers (Optional)</label>
           <input type="text" name="edit_other_reviewers" id="edit_other_reviewers" class="form-control border border-secondary" placeholder="Enter Full Name of Other Reviewer/s" autocomplete="off">
         
            <span class="invalid-other" style="color:red">
                    Other reviewer is required
                  </span>
            </div>
            </div>
    </div>


     
      <hr style="display: none" id="hideHr" class="mt-5 mb-4">

        <div class="row">
          <div class="col-lg-6">
            <label class="px-2 mb-1 mt-3" for="research_type">Research Type <span style="color:red">*</span></label>
            <select name="edit_research_type" title="Nothing Selected" class="form-control selectpicker border border-secondary" id="edit_research_type">
                <option value="" disabled>Select Research Type</option>
                <option value="Biomedical Studies">Biomedical Studies</option>
                <option value="Health Operations Research">Health Operations Research</option>
                <option value="Social Research">Social Research</option>
                <option value="Public Health Research">Public Health Research</option>
                <option value="Clinical Trials">Clinical Trials</option>
              </select>
              <span class="invalid-research" style="color:red">
                      Research type is required
                    </span>
          </div>
          <div class="col-lg-6">
            <label class="px-2 mb-1 mt-3" for="funding">Funding <span style="color:red">*</span></label>
              <select name="edit_funding" title="Nothing Selected" class="form-control selectpicker border border-secondary" id="edit_funding">
                  <option value="" disabled>Select Fundings</option>
                  <option value="R - Researcher-funded">R - Researcher-funded</option>
                  <option value="I - Institution-funded">I - Institution-funded</option>
                  <option value="A - Agency other than institutuion">A - Agency other than institutuion</option>
                  <option value="D - Pharmaceutical companies">D - Pharmaceutical companies</option>
                  <option value="O - Others">O - Others</option>
                </select>
                <span class="invalid-funding" style="color:red">
                    Funding is required
                </span>
          </div>
        </div>

        <hr class="mt-5 mb-4">

<div class="row">
  <div class="col-lg-6">
    <label class="px-2 mb-1 mt-3" for="or_number">OR Number <span style="color:red">*</span></label>
      <input type="text" class="form-control border border-secondary" name="edit_or_number" id="edit_or_number" placeholder="Enter OR Number">
      <span class="invalid-research" style="color:red">
              Research type is required
            </span>
  </div>

</div>

      
      </div>
    

      <hr style="border:3px solid orange">
        <div class="row pb-3">
          <div class="col offset-md-4 text-center">
            <div class="pt-1">2 / 2</div>
          </div>
          <div class="col text-end me-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-target="#edit_modal_1" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
            <button type="submit" class="btn btn-warning">Edit</button>
          </div>
      </div>
     
    </div>
  </div>
</div>
</form>

<script>

$('#edit_p_researcher').change((e) => {
  e.preventDefault();

  let user_id = $('#edit_p_researcher option:selected').attr('data-id');
  $.ajax({
    type: "get",
    url: "/fetch_id/"+user_id,
    dataType: "json",
    success: function (data) {
    
      $('.showDetails #showEmail, #editEmail').val(data.selectedResearcher.email);
      $('.showDetails #show_phone_number, #edit_phone_number').val(data.selectedResearcher.phone_number);
      }
    });
  });


$('#edit_next_button').click((e) => {
  e.preventDefault()

   $('#edit_modal_1').modal('hide')
   $('#edit_modal_2').modal('show')
})

</script>