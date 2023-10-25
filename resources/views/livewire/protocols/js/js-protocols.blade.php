<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  function complete(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, mark this protocol as completed.'
    }).then((result) => {
        if (result.isConfirmed) {
        $.ajax({
            type: "get",
            url: "/complete/"+id,
            success: function (response) {
                Swal.fire(
                'Completed!',
                'The protocol has been completed.',
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

function reset(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Return to previous state.'
    }).then((result) => {
        if (result.isConfirmed) {
        $.ajax({
            type: "get",
            url: "/reset/"+id,
            success: function (response) {
                Swal.fire(
                'Reset!',
                'The protocol completion was reset.',
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

function sendBack(id){
Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, send this protocol back for approval.'
    }).then((result) => {
        if (result.isConfirmed) {
        $.ajax({
            type: "get",
            url: "/sendBack/"+id,
            success: function (response) {
                Swal.fire(
                'Sent Back for Approval!',
                'The protocol has been sent back for approval.',
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

function load_files(form){

  $(form).submit() 
}  


function all_protocols(){
  $("#all_form").submit();
}
function on_going(){
  $("#ongoing_form").submit();
}
function approved(){
  $("#approved_form").submit();
}
function returned(){
  $("#returned_form").submit();
}
function terminated(){
  $("#terminated_form").submit();
}
function completed(){
  $("#completed_form").submit();
}



$('#data').change(function (e) { 
  e.preventDefault();

  $('#data_form').submit();
});

$('#access').change(function (e) { 
  e.preventDefault();

  $('#access_form').submit();
});

$('#sort').change(function (e) { 
  e.preventDefault();

  $('#sort_form').submit();
});

$('#colleges').change(function (e) { 
  e.preventDefault();

  $('#collegesFilter_form').submit();
});


$('#tor').change(function (e) { 
  e.preventDefault();

  $('#tor_form').submit();
});

$('#reviewer').change(function (e) { 
  e.preventDefault();

  $('#reviewer_form').submit();
});

$('#approval').change(function (e) { 
  e.preventDefault();

  $('#dropdownForm').submit();
});


function firstDecision_access(id, status){
Swal.fire({
title: 'Initial Certificate Access',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: ((status==null) ? 'Grant Access' : 'Reset')
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
type: "get",
url: "/setFirstDecision_access/"+id,
success: function (response) {
    Swal.fire(
    ((status==null) ? 'Success!' : 'Reset Successful'),
    ((status==null) ? 'Initial Certificate Access Has Been Granted.' : 'Access Closed.'),
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
  
  
function firstDecision_function(id, value){
Swal.fire({
title: 'Decision',
text: (value=='') ? 'Decision will be reset to none.' : 'Decision will be assigned as '+value,
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Proceed'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
  type: "get",
  url: "/setFirstDecision/"+id,
  data: {
          value: value // Include the 'value' variable as data
        },
  success: function (response) {
      Swal.fire(
      'Success',
      (value=='') ? 'Decision has been reset.' : 'Decision has been assigned as '+value,
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
const edit_details = (id) => {
  this.id = id
  
  $.ajax({
      type: "get",
      url: "/edit_protocol/"+this.id,
      dataType: "json",
      success: function (data) {
        $('#role').val(data.uploader_role);
        $('#edit_title').val(data.protocols.title);
         
     
    
      let protocol_codes = (<?php echo json_encode($protocolCode) ?>)
      let x = protocol_codes.some((item) => {
    
        return item.protocol_code == data.protocols.protocol_code
      })
      
      if(x==true){
      $('#edit_protocol_code').selectpicker('val',data.protocols.protocol_code);
      }
      else{
        $('#edit_protocol_code').append('<option>'+data.protocols.protocol_code+'</option>');
        $('#edit_protocol_code').selectpicker('val',data.protocols.protocol_code);
      }

     if(data.protocols.type_of_review!='EX' && data.protocols.approval!='Terminated'){
       $('#hideReviewers').show();
       $('#hideHr').show();
     }
      $('#edit_status_of_submission').selectpicker('val',data.protocols.status_of_submission);
    
      $('#edit_p_researcher').selectpicker('val',data.protocols.p_researcher);
      $('#edit_c_researcher').selectpicker('val', data.protocols.c_researcher.split(','));

      $('.showDetails #showEmail, #editEmail').val(data.protocols.email);
      $('.showDetails #show_phone_number, #edit_phone_number').val(data.protocols.phone_number);


  
      $('#edit_primary_reviewer').val(data.protocols.primary_reviewer);
      $('#edit_other_reviewers').val(data.protocols.other_reviewers);

   
  
      
      $('#edit_research_type').selectpicker('val',data.protocols.research_type);
      $('#edit_status_of_protocol').val(data.protocols.status_of_protocol);
      $('#edit_funding').selectpicker('val',data.protocols.funding);
      $('#edit_reviewers_report').val(data.protocols.reviewers_report);
      $('#edit_or_number').val(data.protocols.or_number);
    
      
      }
  });

}
  
$('#form_u').submit(() => { 
    let c = $("#edit_c_researcher").val()
      if(c==''){
        c = 'None'
      }
    

    let o = $("#edit_other_reviewers").val()
  
      if(o==''){
        o = 'None'
      }  
      
    $('#form_u').attr('action', "/protocol_management/update/"+this.id+"/"+c+"/"+o).submit();
});



function terminate(id){
  Swal.fire({
  title: 'Are you sure?',
  text: "This Protocol will be Withdrawn/Terminated.",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, terminate this protocol.'
  }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
          type: "get",
          url: "/terminate/"+id,
          success: function (response) {
              Swal.fire(
              'Terminated!',
              'The Protocol has been terminated/withdrawn.',
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

function unterminate(id){
  Swal.fire({
  title: 'Are you sure?',
  text: "This Protocol will be returned to its previous state.",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, unterminate this protocol.'
  }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
          type: "get",
          url: "/unterminate/"+id,
          success: function (response) {
              Swal.fire(
              'Success!',
              'The Protocol has been returned to process flow.',
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

let retrieveId = sessionStorage.getItem('key')
let divTrigger = []
let openClickDivs = retrieveId.split(',')

openClickDivs.forEach((items) => {
  $('#expandDiv'+items).show()
  $('#actionButtons'+items).hide()
})

function toggleDiv(id)
{

  let expandDiv = $('#expandDiv'+id)
  let actionButtons = $('#actionButtons'+id)
    expandDiv.toggle()
    actionButtons.toggle()

    if(expandDiv.is(':visible')){
      divTrigger.push(id)
      sessionStorage.setItem('key' , divTrigger)
    }
    else{
      let index = divTrigger.findIndex((item) => {
        return item == id
      })
      divTrigger.splice(index, 1)
      sessionStorage.setItem('key' ,divTrigger)
    }
}
</script>
