@extends('layouts.base')
@section('content')
<div class="content">
                  @if(session()->get('message'))
                    <div class="alert alert-success" id="alert_close">
                        <div class="row py-2">
                            <div class="col-10">
                            <h5 class="pt-1 ps-2" style="font-family: BlinkMacSystemFont;"><strong>{{ session()->get('message') }}</strong></h5>
                            </div>     
                        
                        <div class="col-2 text-end">
                            <button onclick="close_alert()" class="text-muted" type="button" style="border:none; background-color:transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                                </button>
                        </div>
                        </div>
                    
                    </div>
                @endif
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
a, a:hover{
  color:inherit;
  text-decoration: inherit;
}
#meetingsBtn:hover{
    background-color: #e6e6e6;
  
}



</style>

  <div class="pt-3 ps-1">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center">
            <a href="/drive"><div id="meetingsBtn" style="font-size: 25px; font-family: 'Inter Tight', sans-serif; border-radius: 25px; cursor: pointer" class="py-0 px-3">
                Meetings 
            </div>
            </a>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
            <div class="dropdown">
      <button id="meetingsBtn" style="font-size: 20px; font-family: 'Inter Tight', sans-serif; border-radius: 25px; font-weight: 300" class="btn-lg dropdown-toggle py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $folder->folder_name }}
      </button>
      <ul class="dropdown-menu py-3">
  
        <li>
          <a class="dropdown-item" href="#" id="uploadBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
              <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z"/>
              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
            </svg>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;File Upload
          </a>
          <form action="/drive/f_store/{{ $folder->id }}" enctype="multipart/form-data" id="upload_form" method="post">
            @csrf
            <input onchange="upload()" type="file" name="uploadInput" id="uploadInput" class="d-none">
          </form>
        
        </li>
      </ul>
    </div>
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

  </div>

<div class="px-4 d-flex mt-3">
  <form id="sort_form" action="" method="get">
    <select id="sort" name="sort" class="form-select text-start" style="width: 100%">
          <option value="DESC">Latest</option>
          <option value="ASC">Oldest</option>
    </select>
    <script>document.getElementById('sort').value="<?php echo $sort?>"</script>
  </form>
  
</div>
<hr>

<body>
@if(count($data)==0)
<h1 class="text-center mt-5 text-muted">Empty Folder.</h1>
<div class="text-center">
           
<button onclick="history.back()" class="btn btn-primary mt-4 p-3">Back to UERC Meetings</button>
</div>

@endif  
@if(count($data)!=0)
  <div style="overflow-x:scroll; white-space:nowrap">
   <table class="mt-3 mx-auto">
      <tr style="background-color: #e6e6e6">
        <th>Name</th>
        <th>Owner</th>
        <th>Uploaded At</th>
        <th>Action</th>
      </tr>
      
      @foreach($data as $file)
      <tr>
        <td>
         
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill pb-1" viewBox="0 0 16 16">
              <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
            </svg>&nbsp;&nbsp;&nbsp;&nbsp;<a href='/meetings/fileFolders/{{ $folder->folder_name }}/{{ $file->file_name }}' target='_blank'>{{ $file->file_name }}
          </a>
        </td>
        <td>{{ ($file->user->firstname==auth()->user()->firstname) ? 'Me' : $file->user->firstname.' '.$file->user->lastname }}</td>
        <td>{{ date('M d, Y', strtotime($file->created_at)) }}</td>
        <td>
      

                <button onclick="delete_function(<?php echo json_encode($file->id) ?>,'<?php echo $file->file_name ?>', '/meetings/delete/{{ $folder->folder_name }}/', 'File')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
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
$('.navProfile').hide()
function delete_function(id, fileName){
Swal.fire({
title: 'Are you sure?',
text: '"'+fileName+'" will be deleted.',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
  type: "get",
  url: "/meetings/delete/"+id,
  success: function (response) {
      Swal.fire(
      'Deleted!',
      'The file has been deleted.',
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

  $("#uploadBtn").click(function (e) { 
    e.preventDefault();
    
    $("#uploadInput").click() 
  });

  function upload(){
    $("#upload_form").submit()

  }

  $("#sort").change(function (e) { 
    e.preventDefault();
    
    $("#sort_form").submit();
  });
</script>
@endsection