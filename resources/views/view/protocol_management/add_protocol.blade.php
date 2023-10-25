<style>
  span{
    display: none
  }
</style>

<form id="form_s" enctype="multipart/form-data" method="POST">
    @csrf
<div class="modal fade" data-bs-backdrop="static" id="modal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

   
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Protocol</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-3 px-lg-5">
      
      <div class="row">
        <div class="col">
        <label class="px-2 mb-1 mt-3" for="title" style="font-size: 18px">Title: <span style="color:red">*</span></label>  
        <input id="title" type="text" class="form-control border border-secondary" name="title" placeholder="Enter Title" value="{{ old('title') }}" autocomplete="title">

      <span class="invalid-title" style="color:red">
                Title is required
              </span>
        </div>
      </div>

     
        <div class="row">
          <div wire:ignore class="col-6">
          <label class="px-2 mb-1 mt-3" for="protocol_code">Protocol Code   <span style="color:red">*</span></label>
            <select name="protocol_code" title="Nothing Selected" class="form-control selectpicker border border-secondary" id="protocol_code" data-live-search="true">
              <option value="" disabled>Select Protocol Code</option>
              @foreach($protocolCode as $protocol)
              <option value="{{ $protocol->protocol_code }}">{{ $protocol->protocol_code }}</option>
              @endforeach
            </select>
            <span class="invalid-protocol-code" style="color:red">
                Protocol Code is required
              </span>
          </div>
     
          <div wire:ignore class="col-6">
          <label class="px-2 mb-1 mt-3" for="status_of_submission">Status of Submission   <span style="color:red">*</span></label>
              <select name="status_of_submission" title="Nothing Selected" class="form-control selectpicker border border-secondary" id="status_of_submission" >
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
                    <div wire:ignore class="col-12 col-xl-6 align-items-center">
                          <label class="px-2 mb-1 mt-3" for="p_researcher">Principal Investigator  <span style="color:red">*</span></label>
                        <select title="Nothing Selected" name="p_researcher" class="form-control selectpicker border border-secondary" id="p_researcher"  single data-live-search="true">
                            <option value="" disabled>Select Primary Researcher</option>
                 
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
                <select class="form-control selectpicker border border-secondary" name="c_researcher" id="c_researcher" single data-live-search="true" multiple="multiple">
                <option value="" disabled>Select Co-Researcher/s</option>
     
                  @foreach($researchers as $researcher)
                    <option value="{{ $researcher->title }} {{ $researcher->firstname }} {{ $researcher->lastname }}">{{ $researcher->title }} {{ $researcher->firstname }} {{ $researcher->lastname }}</option>
                  @endforeach
         

      
                </select>
                <span class="invalid-c" style="color:red">
                    Co-Researcher is required
                  </span>
                </div>
          </div>
          
       
          <div class="row showDetails" style="display: none"> 
            <h4 class="mt-5">Details of Principal Investigator</h4>
              <div class="col-6">
                <label class="px-2 mt-3" for="email">Email</label>
                <input type="hidden" name="email" id="email" class="form-control">
                <input type="text" name="email" id="showEmail" class="form-control" disabled>
              </div>
          
              <div class="col-6">
                <label class="px-2 mt-3" for="phone_number">Phone Number</label>
                <input type="hidden" name="phone_number" id="phone_number" class="form-control">
                <input type="text" name="phone_number" id="show_phone_number" class="form-control" disabled>
              </div> 
          </div>
        </div>
     
        <hr>
        <div class="row pb-3">
          <div class="col offset-0 offset-md-4 text-center">
            <div class="pt-1">1 / 2</div>
          </div>
          <div class="col text-end me-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Back</button>
            <button id="next_button" type="button" class="btn btn-primary">Next</button>
          </div>
      </div>
      </div>
    </div>
  </div>



<!--------------------------------------------------Modal 2-------------------------------------------------->
<!--------------------------------------------------Modal 2-------------------------------------------------->


<div class="modal fade" data-bs-backdrop="static" id="modal_2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Add Protocol</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-3 px-lg-5">

        <div class="row">
          <div wire:ignore class="col-md-6">
            <label class="px-2 mb-1 mt-3" for="research_type">Research Type <span style="color:red">*</span></label>
            <select name="research_type" title="Nothing Selected" class="form-control selectpicker border border-secondary" id="research_type">
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
          <div wire:ignore class="col-md-6">
          <label class="px-2 mb-1 mt-3" for="funding">Funding <span style="color:red">*</span></label>
          <select name="funding" title="Nothing Selected" class="form-control selectpicker border border-secondary" id="funding">
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
        <div wire:ignore class="col-md-6">
          <label class="px-2 mb-1 mt-3" for="qrcode">OR Number <span style="color:red">*</span></label>
          <input type="text" class="form-control border border-secondary" id="or_number" name="or_number" placeholder="Enter QR Number">
            <span class="invalid-or_number" style="color:red">
                    OR Number is required
                  </span>
          </div>

          <div wire:ignore class="col-md-6">
          <label class="px-2 mb-1 mt-3" for="qrreceipt">OR Receipt <span style="color:red">*</span></label>
            <input type="file" name="or_receipt" id="or_receipt" class="form-control border border-secondary">
            <span class="invalid-or_receipt" style="color:red">
                    OR Receipt is required
            </span>
            <span class="invalid-ext-or_receipt" style="color:red">
                    Invalid File. Please attach '.jpeg,.png,.docx,.doc,.pdf' files.
            </span>
          </div>
        </div>

        <hr class="mt-5 mb-4">

        <div class="row">
          <div wire:ignore class="col-md-6">
          <label class="px-2 mb-1 mt-3" for="qrreceipt">Research Documentation (Chapter 1-3) <span style="color:red">*</span></label>
            <input type="file" name="doc1" id="doc1" class="form-control border border-secondary">
            <span class="invalid-doc1" style="color:red">
                    Chapter 1-3 is required
            </span>
            <span class="invalid-ext-doc1" style="color:red">
                    Invalid File. Please attach '.docx,.doc,.pdf' files.
            </span>
          </div>
          <div wire:ignore class="col-md-6">
          <label class="px-2 mb-1 mt-3" for="qrreceipt">Progress Report <span style="color:red">*</span></label>
            <input type="file" name="progress_report" id="progress_report" class="form-control border border-secondary">
            <span class="invalid-progress" style="color:red">
                    Progress Report is required
            </span>
            <span class="invalid-ext-progress" style="color:red">
                    Invalid File. Please attach '.docx,.doc,.pdf' files.
            </span>
          </div>
        </div>
      </div>
    

      <hr>
        <div class="row pb-3">
          <div class="col offset-0 offset-md-4 text-center">
            <div class="pt-1">2 / 2</div>
          </div>
          <div class="col text-end me-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-target="#modal_1" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
            <button type="button" id="submit_button" class="btn btn-success">Add</button>
          </div>
      </div>
     
    </div>
  </div>
</div>
</form>

<script>

function otherOption(value){

    $('#hideSelectMultiple').hide();
    $('#otherCustom').show(); 

    $('#otherBtn').hide(); 
    $('#dropdownBtn').show(); 
}

function dropdownOption(value){

    $('#hideSelectMultiple').show();
    $('#otherCustom').hide();

    $('#otherBtn').show(); 
    $('#dropdownBtn').hide(); 

}
function rev(){
  var selectElement = document.getElementById('primary_reviewer');
  var selectedOption = selectElement.options[selectElement.selectedIndex];
  var dataAttrValue = selectedOption.getAttribute('data-attr');
  
  $("#assigned_id").val(dataAttrValue)
}  
$('#p_researcher').change((e) => {
  e.preventDefault();

  let user_id = $('#p_researcher option:selected').attr('data-id');
  $.ajax({
    type: "get",
    url: "/fetch_id/"+user_id,
    dataType: "json",
    success: function (data) {
      $('.showDetails').show();
      $('#email, #showEmail').val(data.selectedResearcher.email);
      $('#phone_number, #show_phone_number').val(data.selectedResearcher.phone_number);
      }
    });
  });
//--------------------------1st Modal--------------------------//
//--------------------------1st Modal--------------------------//

const vTitle = () => {
    let title = $("#title").val();
    if (title.length == "") {
      $('.invalid-title').show();

    } else {
      $(".invalid-title").hide();
     return true;
    }
  }

const vProtocolCode = () => {
    let protocol = $("#protocol_code").val();
    if (protocol.length == "") {
      $('.invalid-protocol-code').show();

    } else {
      $(".invalid-protocol-code").hide();
     return true;
    }
  }
 
const vStatusOfSubmission = () => {
  let status = $("#status_of_submission option:selected").val();
  if (status.length == "") {
    $('.invalid-status').show();

  } else {
    $(".invalid-status").hide();
    return true;
  }
}

const vTypeOfReview = () => {
  let type = $("#type_of_review option:selected").val();
  if (type.length == "") {
    $('.invalid-type').show();

  } else {
    $(".invalid-type").hide();
    return true;
  }
}

const vPrimaryInvestigator = () => {
  let p = $("#p_researcher option:selected").val();
  if (p.length == "") {
    $('.invalid-p').show();

  } else {
    $(".invalid-p").hide();
    return true;
  }
}


$('#next_button').click(function (e) { 
  e.preventDefault();
 

  vTitle()
  vProtocolCode()
  vStatusOfSubmission()
  vPrimaryInvestigator()

  if(vTitle() && vProtocolCode() && vStatusOfSubmission() && 
     vPrimaryInvestigator() == true){

        $('#modal_1').modal('hide');
        $('#modal_2').modal('show'); 

  }
  else{
    return false;
  }

});

//--------------------------2nd Modal--------------------------//
//--------------------------2nd Modal--------------------------//

const vResearchType = () => {
  let research = $("#research_type option:selected").val();
  if (research.length == "") {
    $('.invalid-research').show();

  } else {
    $(".invalid-research").hide();
    return true;
  }
}


const vFunding = () => {
  let funding = $("#funding option:selected").val();
  if (funding.length == "") {
    $('.invalid-funding').show();

  } else {
    $(".invalid-funding").hide();
    return true;
  }
}

const vOrNumber = () => {
  let or_number = $("#or_number").val();
  if (or_number.length == "") {
    $('.invalid-or_number').show();

  } else {
    $(".invalid-or_number").hide();
    return true;
  }
}


const vOrReceipt= () => {
  let r = $("#or_receipt").val();

  const allowedExtensions = /(\.doc|\.docx|\.pdf|\.jpeg|\.jpg|\.png)$/i;

  if (!allowedExtensions.exec(r) && r != "") {
    $(".invalid-ext-or_receipt").show();
    $(".invalid-or_receipt").hide();
  }
  else if(r.length == ""){
    $(".invalid-or_receipt").show();
  }
  else
  {
    $(".invalid-or_receipt").hide();
    $(".invalid-ext-or_receipt").hide();
    return true;
  }
}

const vDoc1= () => {
  let r = $("#doc1").val();

  const allowedExtensions = /(\.doc|\.docx|\.pdf)$/i;

  if (!allowedExtensions.exec(r) && r != "") {
    $(".invalid-ext-doc1").show();
    $(".invalid-doc1").hide();
  }
  else if(r.length == ""){
    $(".invalid-doc1").show();
  }
  else
  {
    $(".invalid-doc1").hide();
    $(".invalid-ext-doc1").hide();
    return true;
  }
}

const vProgress = () => {
  let r = $("#progress_report").val();

  const allowedExtensions = /(\.doc|\.docx|\.pdf)$/i;

  if (!allowedExtensions.exec(r) && r != "") {
    $(".invalid-ext-progress").show();
    $(".invalid-progress").hide();
  }
  else if(r.length == ""){
    $(".invalid-progress").show();
  }
  else
  {
    $(".invalid-progress").hide();
    $(".invalid-ext-progress").hide();
    return true;
  }
}

const vAttachments = () => {
  let p = $("#protocol_attachments").val();

  const allowedExtensions = /(\.doc|\.docx|\.pdf)$/i;

  if (!allowedExtensions.exec(p) && p != "") {
    $(".invalid-ext-attachments").show();
    $(".invalid-attachments").hide();
  }
  else if(p.length == ""){
    $(".invalid-attachments").show();
  }
  else
  {
    $(".invalid-attachments").hide();
    $(".invalid-ext-attachments").hide();
    return true;
  }
}



$('#submit_button').click(() => { 
  

  vResearchType() 
  vFunding()
  vOrNumber()
  vOrReceipt()
  vDoc1() 
  vProgress()


  if(vResearchType() && 
     vFunding() && vOrNumber() && vOrReceipt() && 
     vDoc1() && vProgress() == true){
    
      let c = $("#c_researcher").val()
      if(c==''){
        c = 'None'
      }

      let o = $("#other_reviewers").val()
      if(o==''){
        o = 'None'
      }
           showLoader();

            setTimeout(function () {
    $('#form_s').attr('action', "/protocol_management/store/"+c+"/"+o).submit();
    }, 0); // Adjust the delay as needed
    
     }

  else{
   return false
  }

});


</script>