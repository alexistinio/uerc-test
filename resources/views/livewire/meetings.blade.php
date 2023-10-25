<div>
<style>
table {
  font-family: arial, sans-serif;

  width: 97%;
}

th, td{
  border-bottom: 1px solid silver;

}
tr:hover{
  background-color: #e6e6e6
}
a{
  color:inherit
}

</style>

          <!----------------------------New Folder Modal----------------------------->

        <div class="modal fade" id="newFolder" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-2">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">New Folder</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
        
                <form id="uploadFolder_form" action="/meetings/createFolder" enctype="multipart/form-data" method="POST">
                   @csrf
               
                   <input type="text" name="folderName" id="folderName" style="height: 45px; border-radius: 4px" class="border-lg border-primary w-100 ps-3" placeholder="Untitled Folder">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button onclick="uploadFolder()" type="button" class="btn btn-primary" >Create</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <!----------------------------------------------------------------------------------->

     
<style>
    #meetingsBtn:hover{
        background-color: #e6e6e6
    }
</style>
<div class="pt-3 ps-1">
  <div class="d-flex justify-content-between align-items-center">
      <div class="dropdown">
      <button id="meetingsBtn" style="font-size: 25px; font-family: 'Inter Tight', sans-serif; border-radius: 25px" class="btn-lg dropdown-toggle py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Meetings
      </button>
      <div class="ms-3 mt-1">Admin Access</div>
      <ul class="dropdown-menu py-3">
        <li class="mb-2">
          <a data-bs-toggle="modal" data-bs-target="#newFolder" class="dropdown-item" href="#">
            <?php include('svg/folder-add.svg')?>    
            &nbsp;&nbsp;&nbsp;&nbsp;New Folder
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="#" id="uploadBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
              <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z"/>
              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
            </svg>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;File Upload
          </a>
          <form action="/meetings/store" enctype="multipart/form-data" id="upload_form" method="post">
            @csrf
            <input onchange="upload()" type="file" name="uploadInput" id="uploadInput" class="d-none">
          </form>
        
        </li>
      </ul>
    </div>
    <div class="pe-3">

      <!--
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-3x3-gap-fill" viewBox="0 0 16 16">
          <path d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z"/>
        </svg>
      -->
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg>

      
    </div>
  </div>

<div class="row mt-3">
  <div class="col-12 col-lg-4 mb-2 mb-lg-0">
      <form type="get" action="/drive">
       
          <div class="input-group rounded">
              <input type="search" class="form-control rounded" name="query" value="<?php echo $query ?>" placeholder="Search">
              <span class="input-group-text border-0" id="search-addon">
              <button type="submit"><i class="fas fa-search"></i></button>
              </span>
          </div>
      </form>
  </div>
  <div class="col-6 col-lg-2">
    <select wire:model="sort" id="sort" class="form-select text-start">
        <option value="DESC">Latest</option>
        <option value="ASC">Oldest</option>
    </select>
  </div>
  
</div>
<hr>

<body>

@if(count($folders)==0 && count($files)==0)
<h1 class="text-center mt-5 text-muted">No Data Found.</h1>
@else

<div class="ms-3 mt-4 fw-bold" style="font-size: 15px">Uploaded Files</div>
  <div style="overflow-x:scroll; white-space:nowrap">
   <table class="mt-3 mx-auto">
      <tr style="background-color: #e6e6e6">
        <th>Name</th>
        <th>Owner</th>
        <th>Uploaded At</th>
        <th>Action</th>
      </tr>
      @foreach($folders as $folder)

           <!----------------------------Edit Folder Modal----------------------------->

        <div class="modal fade" id="editFolder{{ $folder->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-2">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit Folder</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
        
                <form action="/meetings/editFolder/{{ $folder->id }}" enctype="multipart/form-data" method="POST">
                   @csrf
                   @method('PUT')
               
                   <input value="{{ $folder->folder_name }}" type="text" name="folderName" id="edit_folderName" style="height: 45px; border-radius: 4px" class="border-lg border-warning w-100 ps-3" autofocus>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning" >Edit</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <!----------------------------------------------------------------------------------->
      <tr>
        <td>
     
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-folder2" viewBox="0 0 16 16">
          <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5v-9zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5V7z"/>
        </svg>&nbsp;&nbsp;&nbsp;&nbsp; <a href='/drive/{{ $folder->folder_name }}'>{{ $folder->folder_name }}
          </a>
        </td>
        <td>{{ ($folder->user->firstname==auth()->user()->firstname) ? 'Me' : $folder->user->firstname.' '.$folder->user->lastname }}</td>
        <td>{{ date('M d, Y', strtotime($folder->created_at)) }}</td>
        <td>
    
              
          <button onclick="focusEdit(<?php echo json_encode($folder->id) ?>)" type="button" data-bs-toggle="modal" data-bs-target="#editFolder{{ $folder->id }}" class="btn btn-warning mx-2" id="edit_button">
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg> Edit
          </button>


          <button onclick="delete_function(<?php echo json_encode($folder->id)?>,'<?php echo $folder->folder_name.' will be deleted.' ?>','/meetings/delete_folder/','Folder')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
              </svg> Delete</button>
        </td>
      </tr>
   

      @endforeach
      @foreach($files as $file)
           
      <tr>
        <td>
         
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill pb-1" viewBox="0 0 16 16">
              <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
            </svg>&nbsp;&nbsp;&nbsp;&nbsp;<a href='/meetings/{{ $file->file_name }}' target='_blank'>{{ $file->file_name }}
          </a>
        </td>
        <td>{{ ($file->user->firstname==auth()->user()->firstname) ? 'Me' : $file->user->firstname.' '.$file->user->lastname }}</td>
        <td>{{ date('M d, Y', strtotime($file->created_at)) }}</td>
        <td>
     

                <button onclick="delete_function(<?php echo json_encode($file->id) ?>,'<?php echo $file->file_name.' will be deleted.' ?>','/meetings/delete/','File')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg> Delete</button>
        </td>
      </tr>
   

      @endforeach

    </table>
  </div>
@endif
</body>

</div>
</div>

<script>



  function focusEdit(id){
    $('#editFolder'+id).on('shown.bs.modal', function () {
        // When the modal is shown, focus on the input element and select its text
        var inputElement = document.getElementById('edit_folderName') // Get the DOM element
        inputElement.focus(); // Set focus

        // Set the cursor position to the end of the text
        var textLength = inputElement.value.length;
        inputElement.setSelectionRange(textLength, textLength);
    });
  }
    $('#newFolder').on('shown.bs.modal', function () {
        // When the modal is shown, focus on the input element and select its text
        $('#folderName').focus().select();
    });
  $("#uploadBtn").click(function (e) { 
    e.preventDefault();
    
    $("#uploadInput").click() 
  });

  function upload(){
    $("#upload_form").submit()

  }

  function uploadFolder(){
    $folderName = $("#folderName").val()

    if($folderName==''){
      alert('Please enter a folder name.')
    }
    else{
      $("#uploadFolder_form").submit()
    }
  }
</script>