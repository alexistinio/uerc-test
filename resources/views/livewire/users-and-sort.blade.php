
<div>
    <style>
           th{
        background-color: whitesmoke;
        color: black;

    }
    </style>

<div id="usermanagement" class="container-fluid mt-3 px-0 px-md-2">  
    <div class="row justify-content-center">
        <div class="col-12">

        </select>
                <div class="card text-start py-3 px-3 mb-3" style="border: 1px solid silver; box-shadow: 0px 3px 5px gray">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                             <h3 style="font-family: 'Inter Tight', sans-serif;">{{ __('User Management') }}</h3>
                             <div>Admin Access</div>
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end px-4">
                            <a id="add_user" href="/add_user" class="btn btn-primary" style="font-family: inherit; padding: 13px">Add New User <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -3px"width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg></a>
                        </div>
                    </div>
                </div>

              <div class="card">
                <div class="card-body mt-2">
                  <div class="row mb-5 mb-md-0">
                    <div class="col-12 col-md-6 col-lg-5 col-xl-2 mb-2 mb-lg-4">
                        <form id="userType_form" type="get" action="">
                            <select onchange="userType()" name="userType" class="form-select text-start" id="userType">
                                <option value="UERC">UERC</option>
                                <option value="CERC">CERC</option>
                            </select>
                          
                        </form>
                        <?php 
                            echo "<script>document.getElementById('userType').value = '$userType'</script>"
                        ?>
                    </div>
                   @if($userType=="UERC")
                    <div class="col-12 col-md-5 col-lg-4 col-xl-3 ps-md-0">
                        <form id="position_form" action="" method="get">
                            <select onchange="position_function()" name="position" class="form-select text-start" id="position">
                                <option value="All">All</option>
                                <option value="Chairperson">Chairperson</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Member">Member</option>
                                <option value="Non-Affiliate Member">Non-Affiliate Member</option>
                                <option value="External Lay Member">External Lay Member</option>
                            </select>
                            <?php echo "<script>document.getElementById('position').value = '$position'</script>"; ?>
                       
                            <input type="hidden" name="userType" value="<?php echo $userType ?>">
                            <input type="hidden" name="sortDirection" value="<?php echo $sortDirection ?>">
                            <input type="hidden" name="sortColumn" value="<?php echo $sortColumn ?>">
                        </form>
                        <?php echo "<script>document.getElementById('colleges').value = '$collegesFilter'</script>"; ?>
                    </div>
                    @endif

                    @if($userType=='CERC')
                    <div class="col-12 col-md-5 col-lg-4 col-xl-3 ps-md-0">
                        <form id="colleges_form" action="" method="get">
                            <select onchange="colleges_function()" name="colleges" class="form-select text-start" id="colleges">
                                <option value="All">All Colleges</option>
                                <option value="ARC">College of Architecture</option>
                                <option value="BUS">College of Business Administration</option>
                                <option value="CELA">College of Education and Liberal Arts</option>
                                <option value="ENG">College of Engineering</option>
                                <option value="LAW">College of Law</option>
                                <option value="NUR">College of Nursing</option>
                                <option value="PHA">College of Pharmacy</option>
                                <option value="COS">College of Science</option>
                            </select>
                            <input type="hidden" name="userType" value="<?php echo $userType ?>">
                            <input type="hidden" name="sortDirection" value="<?php echo $sortDirection ?>">
                            <input type="hidden" name="sortColumn" value="<?php echo $sortColumn ?>">
                        </form>
                        <?php echo "<script>document.getElementById('colleges').value = '$collegesFilter'</script>"; ?>
                    </div>
          
                    @endif
                  </div>

                </div>
                
        
                  @if($userType=="CERC")
                  <div style="overflow-x:scroll; white-space:nowrap">
                  <table>

                            <tr>
                                <thead class="{{ (count($users)==0) ? 'd-none': '' }}">
                                <form id="sort_form" action="" method="get">
                                    <input type="hidden" name="userType" value="CERC">
                                    <input type="hidden" name="colleges" value="<?php echo $collegesFilter ?>">
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
                                <th>Phone Number</th>
                                <th>College</th>
                                <th>Course</th>
                                <form id="createdAt_form" action="" method="get">
                                    <input type="hidden" name="userType" value="CERC">
                                    <input type="hidden" name="colleges" value="<?php echo $collegesFilter ?>">
                                    <th class="">Account Created
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
                         
                           <?php $i=1; ?>
                        @forelse($users as $user)
                           <?php 
                                $i++;
                           ?>
                            <tr>
                                <tbody class="row-height table-border" style="background-color: <?php echo ($i %2==1) ? '#DCDCDC' : '' ?>">
                                 <form id="userProtocols_form{{ $user->id }}" method="get" action="/user_protocols">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                </form>
                                <td onclick="formTrigger(<?php echo json_encode($user->id) ?>)" data-label="fullname" class="text-primary" style="font-weight: 900; cursor: pointer"><u>{{ $user->title }} {{ $user->firstname }} {{ $user->lastname }}</u></td>
                                <td data-label="Email Address">{{ $user->email }}</td>
                                <td data-label="Phone Number">{{ $user->phone_number }}</td>
                                <td data-label="Role">
                                
                                    <div class="bg-primary text-center py-2" style="border-radius: 6px; color:white">{{ $user->colleges }}</div>
                                   
                                </td>
                                <td data-label="Course">{{ ($user->courses=='Information Technology & Information Systems') ? 'IT & IS' : $user->courses }}</td>
                                  @php
                                    $date = \Carbon\Carbon::parse($user->created_at)->timezone('Asia/Manila');
                                    $formattedDate = $date->format('M d, Y g:ia');
                                @endphp
                                <td class="px-4" data-label="Account Created">{{ $formattedDate }}</td>

                                <td data-label="#" class="d-flex">
                                    
                                     <form method="get" action="/edit_user">

                                      
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                
                                    <button type="submit" class="btn btn-warning mx-2" id="edit_button"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg> Edit
                                    </button>
                                </form>

                                    <button onclick="delete_function(<?php echo json_encode($user->id) ?>,'<?php echo $user->firstname.' '.$user->lastname.' will be deleted.' ?>', '/user/delete/', 'User')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg> Delete</button>
                                </td>
                                </tbody>       
                            </tr>
                            @empty
                            <div class="col-12">
                                        <h1 wire:model="collegeFilter" class="text-center py-5 my-5 text-muted" style="font-family: 'Open Sans', sans-serif;">No user found under CERC.</h1>
                                    </div>
                            @endforelse

              
                        </table>
                        <div class="d-flex justify-content-end pe-4 mt-4">
                            {{ $users->links() }}
                        </div>
                        </div> 
                    @endif    



                    @if($userType=="UERC")
                  <div style="overflow-x:scroll; white-space:nowrap">
                  <table>

                            <tr>
                                <thead class="{{ (count($users)==0) ? 'd-none': '' }}">
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
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Position</th>
                                <form id="createdAt_form" action="" method="get">
                                    <th class="">Account Created
                                            <span onclick="sort_createdAt()" class="ms-2" style="font-size:12px;cursor: pointer">
                                                <i class="fa-sharp fa-solid fa-arrow-up {{ ($sortColumn=='created_at' && $sortDirection=='ASC') ? '' : 'text-muted' }}"></i>
                                                <i class="fa-sharp fa-solid fa-arrow-down {{ ($sortColumn=='created_at' && $sortDirection=='DESC') ? '' : 'text-muted' }}"></i>
                                            </span> 
                                          
                                            @if($sortDirection=='DESC')
                                               
                                               <input type="hidden" name="position" value="{{ $position }}">
                                      
                                            <input type="hidden" name="sortDirection" value="ASC">
                                            <input type="hidden" name="sortColumn" value="created_at">
                                            @else
                                              <input type="hidden" name="position" value="{{ $position }}">
                                            <input type="hidden" name="sortDirection" value="DESC">
                                            <input type="hidden" name="sortColumn" value="created_at">
                                            @endif
                                           
                                    </th>
                                </form>
                                <th>Action</th>
                                </thead>
                                
                            </tr>
                         
                           <?php $i=1; ?>
                        @forelse($users as $user)
                           <?php 
                                $i++;
                           ?>
                           @if($user->id!=2 || auth()->user()->id==2)
                            <tr>
                                <tbody class="row-height table-border" style="background-color: <?php echo ($i %2==1) ? '#DCDCDC' : '' ?>">
                               
                           
                                <form id="userProtocols_form{{ $user->id }}" method="get" action="/user_protocols">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                </form>
                                <td onclick="formTrigger(<?php echo json_encode($user->id) ?>)" data-label="fullname" class="text-primary" style="font-weight: 900; cursor: pointer"><u>{{ $user->title }} {{ $user->firstname }} {{ $user->lastname }}</u></td>
                             
                                <td data-label="Email Address">{{ $user->email }}</td>
                                <td data-label="Phone Number">{{ $user->phone_number }}</td>
                                <td data-label="Role">
                                
                                    <div class="{{ $user->id==1 ? 'bg-danger' : 'bg-dark' }} text-center p-2" style="border-radius: 6px; color:white">{{ $user->id==1 ? 'SuperAdmin' : $user->role }}</div>
                                   
                                </td>
                                <td>{{ $user->position }}</td>
                                @php
                                    $date = \Carbon\Carbon::parse($user->created_at)->timezone('Asia/Manila');
                                    $formattedDate = $date->format('M d, Y g:ia');
                                @endphp
                                <td class="px-4" data-label="Account Created">{{ $formattedDate }}</td>
                         
                                <td data-label="#" class="d-flex">
                               @if($user->id==auth()->user()->id || auth()->user()->id==1 || auth()->user()->id==2)
                                 <form method="get" action="/edit_user">
                                    
                                      
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                 
                                 
                                    <button type="submit" class="btn btn-warning mx-2" id="edit_button"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg> Edit
                                    </button>
                                </form>
                                @if($user->id!=1)
                                    <button onclick="delete_function(<?php echo json_encode($user->id) ?>,'<?php echo $user->firstname.' '.$user->lastname.' will be deleted.' ?>', '/user/delete/', 'User')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg> Delete</button>
                                    @endif
                               @endif
                                </td>
                                 
                                </tbody>       
                            </tr>
                            @endif
                            @empty
                            <div class="col-12">
                                        <h1 wire:model="collegeFilter" class="text-center py-5 my-5 text-muted" style="font-family: 'Open Sans', sans-serif;">No user found under UERC.</h1>
                                    </div>
                            @endforelse

              
                        </table>
                        <div class="d-flex justify-content-end pe-4 mt-4">
                            {{ $users->links() }}
                        </div>
                        </div> 
                    @endif    


                 
                </div>
                </div>
</div>
</div>
</div>
</div>
<script>
 function sort_name(){
    $("#sort_form").submit();
 }  

 function sort_createdAt(){
    $("#createdAt_form").submit();
 }    
 function colleges_function(){
    $("#colleges_form").submit();
 }
 
  function position_function(){
    $("#position_form").submit();
 }

    $("#userType").change(function (e) { 
        e.preventDefault();
        
        $("#userType_form").submit();
    });
 

</script>
