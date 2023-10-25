<div>
    <style>
           th{
        background-color: whitesmoke;
        color: black;

    }
    </style>

    <div class="container-fluid mt-3 px-0 px-md-2">
        <div class="row justify-content-center">
            <div class="col-12">

            
            <div class="card text-start py-3 px-3 mb-3" style="border: 1px solid silver; box-shadow: 0px 3px 5px gray">
                        <div class="row">
                            <div class="col-12 col-sm-6 d-flex align-items-center">
                            <h3 style="font-family: 'Inter Tight', sans-serif;">{{ __('Researcher Management') }}</h3>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-end px-4">
                                <a id="add_researcher" href="/add_researcher" class="btn btn-primary" style="font-family: inherit; padding: 13px">Add New Researcher <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -3px"width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                <div class="card">
                    <div class="card-body px-0 mt-2 pb-0">
               
                    <div class="row px-1 px-md-3">
                  

                        @if(Auth::user()->role == 'Admin')
                        <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                        <form id="colleges_form" action="" method="get"> 
                        <select name="colleges" class="form-select text-start" id="colleges">
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
                        <?php echo "<script>document.getElementById('colleges').value = '$colleges'; </script>"?>
                        <input type="hidden" name="sortDirection" value="<?php echo $sortDirection ?>">
                        <input type="hidden" name="sortColumn" value="<?php echo $sortColumn ?>">
                        </form>   
                        </div>
                        @endif

                    </div>

                 
                    @if(count($researchers)!=0)  
                <div class="mt-3" style="overflow-x:scroll; white-space:nowrap">
                    <table class="mTable">
                                <tr>
                                    <thead>
                                    <form id="sort_form" action="" method="get">
                                  
                                    <th class="">Full Name
                                            <span onclick="sort_name()" class="ms-2" style="font-size:12px;cursor: pointer">
                                                <i class="fa-sharp fa-solid fa-arrow-up {{ ($sortColumn=='lastname' && $sortDirection=='ASC') ? '' : 'text-muted' }}"></i>
                                                <i class="fa-sharp fa-solid fa-arrow-down {{ ($sortColumn=='lastname' && $sortDirection=='DESC') ? '' : 'text-muted' }}"></i>
                                            </span> 
                                          
                                            @if($sortDirection=='DESC')
                                            <input type="hidden" name="sortDirection" value="ASC">
                                            <input type="hidden" name="sortColumn" value="lastname">
                                            @else
                                            <input type="hidden" name="sortDirection" value="DESC">
                                            <input type="hidden" name="sortColumn" value="lastname">
                                            @endif
                                           
                                    </th>
                                </form>
                                    <th>Email Address</th>
                                    <th>Phone Number
                                    </th>
                                    <th>College</th>
                                    <th>Course</th>
                                    <th>Created by:</th>
                                    <form id="createdAt_form" action="" method="get">
                                    <th class="">Created at:
                                            <span onclick="sort_createdAt()" class="ms-2" style="font-size:12px;cursor: pointer">
                                                <i class="fa-sharp fa-solid fa-arrow-up {{ ($sortColumn=='created_at' && $sortDirection=='ASC') ? '' : 'text-muted' }}"></i>
                                                <i class="fa-sharp fa-solid fa-arrow-down {{ ($sortColumn=='created_at' && $sortDirection=='DESC') ? '' : 'text-muted' }}"></i>
                                            </span> 
                                          
                                            @if($sortDirection=='DESC')
                                            <input type="hidden" name="sortDirection" value="ASC">
                                            <input type="hidden" name="sortColumn" value="created_at">
                                            @else
                                            <input type="hidden" name="sortDirection" value="DESC">
                                            <input type="hidden" name="sortColumn" value="created_at">
                                            @endif
                                           
                                    </th>
                                </form>
                                    <th>Action</th>
                                    </thead>
                                </tr>
                      @endif
                      
                    <!----------------------- Admin ----------------------->
                    <!----------------------- Admin -----------------------> 
                    <?php $i=1; ?>
          
                            @forelse($researchers as $researcher)
                          <?php
                            $i++ 
                          ?>
                            <tr>
                                <tbody class="row-height table-border" style="background-color: <?php echo ($i %2==1) ? '#DCDCDC' : '' ?>">
                                <td data-label="fullname" style="font-weight: 900">{{ $researcher->title }} {{ $researcher->firstname }} {{ $researcher->lastname }}</td>
                                <td data-label="email">{{ $researcher->email }}</td>
                                <td data-label="phone_number">{{ $researcher->phone_number }}</td>
                                <td data-label="department">{{ $researcher->colleges }}</td>
                                <td data-label="department">{{ ($researcher->courses=='Information Technology & Information Systems')? 'IT & IS' : $researcher->courses }}</td>
                                <td data-label="created_by">{{ $researcher->user->firstname }} {{ $researcher->user->lastname }}  ({{ $researcher->user->role=="Admin" ? $researcher->user->role : $researcher->user->colleges }})</td>
                                <td class="px-3" data-label="Account Created">{{ date('M d, Y', strtotime($researcher->created_at)) }}</td>
                                <td data-label="#" class="d-flex">
                                    <form method="post" action="/edit_researcher">
                                     @csrf
                                      
                                    <input type="hidden" name="id" value="{{ $researcher->id }}">
                                
                                    <button type="submit" class="btn btn-warning mx-2" id="edit_button"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg> Edit
                                    </button>
                                </form>

                                <button onclick="delete_function(<?php echo json_encode($researcher->id)?>,'<?php echo $researcher->title.' '.$researcher->firstname.' '.$researcher->lastname.' will be deleted.'  ?>','/research/delete/','Researcher')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg> Delete</button>
                                </td>
                                </tbody>  
                            </tr>
                     
                            @empty
                               @if(Auth::user()->role == 'Admin')
                                    @if($colleges!='all')
                                    <h1 class="my-5 text-muted text-center">No researchers under {{ $colleges }}.</h1>
                                    @else
                                    <h1 class="my-5 text-muted text-center">No researchers found.</h1>
                                    @endif
                                @else
                                <h1 class="my-5 text-muted text-center">No researchers found.</h1>
                                @endif
                            @endforelse

                  

                                  
                </table>
       
                <div class="px-4 mt-4">
                   @isset($researchers) 
                    {{ $researchers->links() }}
                   @endisset 
                </div>
          
            </div> 
        </div>
    </div>
<script>
function sort_createdAt() { 

$('#createdAt_form').submit();
};
function sort_name() { 

  $('#sort_form').submit();
};


$('#colleges').change(function (e) { 
    e.preventDefault();
    
    $('#colleges_form').submit();
});
</script>