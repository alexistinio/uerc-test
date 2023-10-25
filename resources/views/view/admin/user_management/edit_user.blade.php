@extends('layouts.base')

@section('content')
<style>
        a{
        text-decoration:none;
        font-family: inherit;
    }
    select, input{
    height:50px;
  
    }
    
    label{
    font-weight:bold;
    font-size:16px
}
</style>
<div class="content">
<div class="container-fluid">
<div class="card text-start py-3 px-3 mb-3 mt-3 shadow" style="border: none">
                    <div style="line-height: normal">
                    
                        <h3 class="pt-1" style="font-family: 'Inter Tight', sans-serif;">{{ __('Edit Account') }}</h3>
                        <div style="font-family: Inter, sans-serif; font-size: 16px"><a href="/user_management">User Management</a>&nbsp;&nbsp;/&nbsp;&nbsp;<span class="text-dark">Account Portal</span></div>
                     
                    </div>
                </div>
    <div class="row justify-content-center">
  
    <div class="col-lg-4 mb-3 px-2">
        <div class="card shadow py-4" style="border: none">
        <div class="text-center">
                    <img src="{{ $user->profile_image == null ? 'profile/default-profile.jpeg' : $user->profile_image }}" style="border-radius: 50%" width="200" height="200" alt="">
                 
                    <form id="selectform" method="POST" enctype="multipart/form-data" action="/update/{{ $user->id }}">
                  
                        @csrf
                        @method('PUT')
                    <div class="px-5">
                       <button class="btn btn-warning mt-3 d-none" style="width: 180px; height: 45px">Change profile picture</button>
                     
                        <input type="file" name="profile_image" class="mt-3 form-control" style="height: 100%">
                       
                    </div>
                  
                    <div class="mt-4 fw-bold text-dark" style="font-size: 18px; font-family: Open Sans, sans-serif">{{ $user->firstname }} {{ $user->lastname }}</div>
                    @if($user->role=="Admin")
                    <div class="text-muted" style="font-size: 16px; font-family: Open Sans, sans-serif">{{ $user->colleges }}</div>
                    @else
                    <div style="line-height: normal">
                        <div class="text-muted" style="font-size: 16px; font-family: Open Sans, sans-serif">{{  (str_contains($user->courses, "College")) ? '' : 'BS' }} {{ $user->courses }}</div>
                        <div class="text-muted" style="font-size: 16px; font-family: Open Sans, sans-serif">{{ $user->colleges }}</div>
                    </div>
              
                    @endif
                </div>
                <hr class="mx-4" style="color: gray">
                    <div class="px-4">
                        <div class="text-primary d-flex justify-content-between align-items-center" style="font-size: 18px; font-family: Open Sans, sans-serif; font-weight: 800">
                          <div class="">Contact Information</div>
                         
                        </div>
                        <div class="text-primary text-start mt-4" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 600">Email Address:</div>

                        <div class="text-dark text-start" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 400">{{ $user->email }}</div>

                        <div class="text-primary text-start mt-4" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 600">Phone Number:</div>
                        <div class="text-dark text-start" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 400">{{ $user->phone_number }}</div>

                        <div class="text-primary text-start mt-4" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 600">Account Created:</div>
                        <div class="text-dark text-start" style="font-size: 14px; font-family: Open Sans, sans-serif; font-weight: 400">{{ date('M d, Y', strtotime($user->created_at)) }}</div>
                    </div>
        </div>
    </div>
        <div class="col">
            <div class="card shadow" style="border: none">
                <div id="card_body" class="card-body py-4">
             
                 
                        <div class="row mb-2">
                          <div class="col">
                             <h4 class="" style="font-family: BlinkMacSystemFont;">Account Details</h4>
                          </div>
                        </div> 

                     <input type="hidden" name="id" value="{{ $user->id }}">
                     
                        <div class="row mb-3">
                            <div class="col-md-6">
                            <label class="px-2 mb-1" for="firstname">First name</label>
                                <input id="firstname" type="text" class="mb-3 form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                             </div>
                       
                                
                             <div class="col-md-6">
                                      
                                      <label class="px-2 mb-1" for="lastname">Last name</label>
                                      <input id="lastname" type="text" class="mb-3 form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </col>
                            </div> 

                          
                            </div>  

                            <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                    <label class="px-2 mb-1" for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="px-2 mb-1" for="email">Phone Number</label>
                                    <input id="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}" autocomplete="phone_number">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                    <hr> 
                            
                                   
                        <div class="row mb-3 mt-4">
                    @if($user->role=="CERC")
                            <div class="col-6">
                            <label class="px-2 mb-1" for="courses">Course <span style="color:red">*</span></label>

                                <select data-style="btn-outline-dark" name="courses" data-live-search="true" class="form-select @error('courses') is-invalid @enderror" id="courses" value="{{ old('courses') }}" autocomplete="courses">
                                    <option disabled selected>Nothing selected.</option>
                                    <option value="Admin">Admin</option>
                                    <option value="College of Architecture">College of Architecture</option>
                                        <optgroup value="BUS" label="College of Business Administration">
                                            <option value="Accountancy">Accountancy</option> 
                                            <option value="Customs Administration">Customs Administration</option> 
                                            <option value="Finance & Economic">Finance & Economic</option> 
                                            <option value="Hospitality Management">Hospitality Management</option> 
                                            <option value="Management & Marketing">Management & Marketing</option> 
                                        </optgroup>

                                        <optgroup value="CELA" label="College of Education and Liberal Arts">
                                            <option value="Communication">Communication</option> 
                                            <option value="Education">Education</option> 
                                            <option value="Languages">Languages</option> 
                                            <option value="Physical Education">Physical Education</option> 
                                            <option value="Social Sciences">Social Sciences</option> 
                                        </optgroup>

                                        <optgroup value="ENG" label="College of Engineering">
                                            <option value="Chemical">Chemical</option>
                                            <option value="Civil">Civil</option> 
                                            <option value="Computer">Computer</option> 
                                            <option value="Electrical">Electrical</option> 
                                            <option value="Electronics Communication">Electronics Communication</option> 
                                            <option value="Mining & Geology">Mining & Geology</option> 
                                            <option value="Industrial">Industrial</option> 
                                            <option value="Mechanical">Mechanical</option> 
                                        </optgroup>
                                        <option value="College of Law">College of Law</option>
                                        <option value="College of Nursing">College of Nursing</option>
                                        <option value="College of Pharmacy">College of Pharmacy</option>
                            

                                        <optgroup value="SCI" label="College of Science">
                                            <option value="Chemistry">Chemistry</option> 
                                            <option value="Computer Science">Computer Science</option> 
                                            <option value="Information Technology & Information Systems">Information Technology & Information Systems</option> 
                                            <option value="Math & Physics">Math & Physics</option> 
                                            <option value="Biology">Biology</option> 
                                            <option value="Psychology">Psychology</option> 
                                        </optgroup>
                                    </select>
                                    <?php echo "<script>document.getElementById('courses').value = '$user->courses';</script>";?>
                                    @error('courses')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                       <div id="colleges_div" class="col">
                        <label class="px-2 mb-1" for="courses">Department</label>
                        <input readonly type="text" name="colleges" id="colleges" value="<?php echo $user->colleges ?>" class="form-control px-3" style="font-size: 16px;">
                        <input type="hidden" name="role" id="role">
                     </div>
                     @endif
                     @if($user->role=='Admin')
                     <div class="col-6">
                        <label class="px-2 mb-1" for="role">Role</label>
                        <input readonly type="text" name="role" id="role" value="<?php echo $user->role ?>" class="form-control px-3" style="font-size: 16px;">
                     </div>
                     <div class="col-6">
                            <label class="px-2 mb-1" for="position">Position <span style="color:red">*</span></label>
                            <select data-style="btn-outline-dark" name="position" data-live-search="true" class="form-select @error('position') is-invalid @enderror" id="position" value="{{ old('position') }}" autocomplete="position">
                                <option disabled selected>Nothing selected.</option>
                                <option value="Chairperson">Chairperson</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Member">Member</option>
                                <option value="Non-Affiliate Member">Non-Affiliate Member</option>
                                <option value="External Lay Member">External Lay Member</option>
                            </select>
                            @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <?php echo "<script>document.getElementById('position').value = '$user->position'</script>"; ?>
                        </div>
                     @endif
                     
              
                    </div>
              

         
                            <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="px-2">Password :</label>
                                    <div class="d-flex">
                                        <input disabled id="password" name="password" type="password" placeholder="**********" class="form-control" autocomplete="off">
                                        <button type="button" id="password_edit" class="btn btn-dark ms-1" style="width: 18%; height: 51px">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" onclick="show_password()">
                                        <label class="px-2" for="show_password" style="font-size: 14px; margin-top: 15px">Show Password</label><br>
                                    </div>	
                                    
                                </div>
                        </div>
                            </div>
    
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                <button type="button" style=" width:100%; height:60px" onclick="history.back()" class="btn btn-outline-primary">
                                    {{ __('Back') }}
                                </button>
                            </div>

                         <div class="col-12 col-lg-6">
             
                            <button type="submit" style=" width:100%; height:60px" class="btn btn-primary">
                                    {{ __('Update') }}
                            </button>
                     
                         </div>
                    </div>
                
                </div>
                
             </form>
      
            </div>
        </div>
    </div>
</div>
</div>
</div>


</div>
<script>



    const password_edit = document.getElementById('password_edit')
	const password = document.getElementById('password')
	password.disabled = true

	password_edit.addEventListener('click', (e) => {
		if(password.disabled == true){
			password.disabled = false
		}
		else{
			password.disabled = true
			password.value=""
		}
	})
	function show_password() {
		var x = document.getElementById("password");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
    $(document).ready(function () {
    

    $('#courses').change(function (e) { 
        e.preventDefault();

        if($('#courses option:selected').val()=='Admin'){
         $('#colleges_div').hide()
         $('#colleges').val('Admin')
         $('#role').val('Admin')
        }
        else if($('#courses option:selected').val()=='College of Architecture'){
         $('#colleges_div').hide()
         $('#colleges').val('ARC')
         $('#role').val('User')
        }
        else if($('#courses option:selected').val()=='Accountancy' || $('#courses option:selected').val()=='Customs Administration' 
        || $('#courses option:selected').val()=='Finance & Economic' || $('#courses option:selected').val()=='Hospitality Management'
        || $('#courses option:selected').val()=='Management & Marketing'){
            $('#colleges_div').show()
            $('#colleges').val('BUS')
            $('#role').val('User')
        }
        else if($('#courses option:selected').val()=='Communication' || $('#courses option:selected').val()=='Education' 
        || $('#courses option:selected').val()=='Languages' || $('#courses option:selected').val()=='Physical Education'
        || $('#courses option:selected').val()=='Social Sciences'){
            $('#colleges_div').show()
            $('#colleges').val('CELA')
            $('#role').val('User')
        }
        else if($('#courses option:selected').val()=='Chemical' || $('#courses option:selected').val()=='Civil' 
        || $('#courses option:selected').val()=='Computer' || $('#courses option:selected').val()=='Electrical'
        || $('#courses option:selected').val()=='Electronics Communication' || $('#courses option:selected').val()=='Mining & Geology'
        || $('#courses option:selected').val()=='Industrial' || $('#courses option:selected').val()=='Mechanical'){
            $('#colleges_div').show()
            $('#colleges').val('ENG')
            $('#role').val('User')
        }
        else if($('#courses option:selected').val()=='College of Law'){
            $('#colleges_div').hide()
            $('#colleges').val('LAW')
            $('#role').val('User')
        }
        else if($('#courses option:selected').val()=='College of Nursing'){
            $('#colleges_div').hide()
            $('#colleges').val('NUR')
            $('#role').val('User')
        }
        else if($('#courses option:selected').val()=='College of Pharmacy'){
            $('#colleges_div').hide()
            $('#colleges').val('PHA')
            $('#role').val('User')
        }
        else if($('#courses option:selected').val()=='Chemistry' || $('#courses option:selected').val()=='Computer Science' 
        || $('#courses option:selected').val()=='Biology' || $('#courses option:selected').val()=='Psychology'
        || $('#courses option:selected').val()=='Information Technology & Information Systems' 
        || $('#courses option:selected').val()=='Math & Physics'){
            $('#colleges_div').show()
            $('#colleges').val('COS')
            $('#role').val('User')
        }
    });
});

const input = document.getElementById("upload_profile");
function upload_function(){
    $(input).click()
    
}

input.addEventListener('change', () => {
const allowedExtensions = /(\.jpeg|\.jpg|\.png)$/i;
const input_value = input.value;

	if (!allowedExtensions.exec(input_value)) {
       alert('Invalid input. Please input a jpeg/png file.')
	}
	else{
		const fr = new FileReader()

		fr.readAsText(input.files[0])
		fr.addEventListener('load', () => {

            $.ajax({
					type: "post",
					url: "",
					data: {
						per_column: fr.result
					},
			
					success: function (data) {
					alert("Data Imported to Database.")
					}
				});
		})
	}

})

</script>
@endsection
