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
 
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
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
                    
                        <h3 class="pt-1" style="font-family: 'Inter Tight', sans-serif;">{{ __('Edit Researcher') }}</h3>
                        <div style="font-family: Inter, sans-serif; font-size: 16px"><a href="/researcher_management">Researcher Management</a>&nbsp;&nbsp;/&nbsp;&nbsp;<span class="text-dark">Researcher Portal</span></div>
                     
                    </div>
                </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow" style="border: none">
                <div id="card_body" class="card-body mt-4">
                <form id="selectform" method="POST" action="/researcher_management/update_researcher/{{ $researcher->id }}">
                        @csrf
                        @method('PUT')
                    <div class="px-3">
                        <div class="row mb-2">
                          <div class="col">
                             <h4 class="pb-2" style="font-family: BlinkMacSystemFont;">Researcher Details</h4>
                          </div>
                        </div> 

                        <div class="row mb-3">
                            <div class="col-12 col-md-4">
                            <label class="px-2 mb-1" for="firstname">First name</label>
                                <input id="firstname" type="text" class="mb-3 form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $researcher->firstname }}" autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                             </div>
                       
                                
                             <div class="col-12 col-md-4">
                                      
                                      <label class="px-2 mb-1" for="lastname">Last name</label>
                                      <input id="lastname" type="text" class="mb-3 form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $researcher->lastname }}" autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          
                            </div> 

                            <div class="col-12 col-md-4">
                                    <label class="px-2 mb-1" for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $researcher->email }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>  

                            <div class="row mb-5">
                             

                                <div class="col-12 col-md-4">
                     
                                <label class="px-2 mb-1" for="phone_number">Phone Number<span style="color:red">*</span></label>
                                    <input id="phone_number" type="number" placeholder="93989*****" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $researcher->phone_number }}" autocomplete="phone_number">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                           
                          
                                </div>

                                <div class="col-lg-4 mt-lg-0 mt-2">
                       
                       <label class="px-2 mb-1" for="courses">Course <span style="color:red">*</span></label>

                       <select data-style="btn-outline-dark" name="courses" data-live-search="true" class="form-select @error('courses') is-invalid @enderror" id="courses" value="{{ old('courses') }}" autocomplete="courses">
                        <option disabled selected>Nothing selected.</option>
                        @if(Auth::user()->role=="Admin")  
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
                            @endif
                            @if(Auth::user()->colleges == 'College of Architecture')
                            <option value="College of Architecture">College of Architecture</option>
                            @endif
                            @if(Auth::user()->colleges == 'BUS')
                            <optgroup value="BUS" label="College of Business Administration">
                               <option value="Accountancy">Accountancy</option> 
                                <option value="Customs Administration">Customs Administration</option> 
                                <option value="Finance & Economic">Finance & Economic</option> 
                                <option value="Hospitality Management">Hospitality Management</option> 
                                <option value="Management & Marketing">Management & Marketing</option> 
                            </optgroup>
                            @endif
                            @if(Auth::user()->colleges == 'CELA')
                            <optgroup value="CELA" label="College of Education and Liberal Arts">
                                <option value="Communication">Communication</option> 
                                <option value="Education">Education</option> 
                                <option value="Languages">Languages</option> 
                                <option value="Physical Education">Physical Education</option> 
                                <option value="Social Sciences">Social Sciences</option> 
                            </optgroup>
                            @endif
                            @if(Auth::user()->colleges == 'ENG')
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
                            @endif
                            @if(Auth::user()->colleges == 'College of Law')
                            <option value="College of Law">College of Law</option>
                            @endif
                            @if(Auth::user()->colleges == 'College of Nursing')
                            <option value="College of Nursing">College of Nursing</option>
                            @endif
                            @if(Auth::user()->colleges == 'College of Pharmacy')
                            <option value="College of Pharmacy">College of Pharmacy</option>
                            @endif
                            @if(Auth::user()->colleges == 'COS')
                            <optgroup value="SCI" label="College of Science">
                                <option value="Chemistry">Chemistry</option> 
                                <option value="Computer Science">Computer Science</option> 
                                <option value="Information Technology & Information Systems">Information Technology & Information Systems</option> 
                                <option value="Math & Physics">Math & Physics</option> 
                                <option value="Biology">Biology</option> 
                                <option value="Psychology">Psychology</option> 
                            </optgroup>
                            @endif
                          </select>
                         <?php echo "<script>document.getElementById('courses').value = '$researcher->courses';</script>";?>
                         @error('courses')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                               </span>
                               @enderror
                       </div>

                       <div class="col-4" id="colleges_div" style="display: none">
                        <label class="px-2 mb-1" for="courses">Department</label>
                        <input readonly type="text" name="colleges" id="colleges" value="<?php echo $researcher->colleges ?>" class="form-control px-3" style="font-size: 16px;">
                       </div>
                            </div>
                            
                
                       
                                    
                        <div class="row pb-4">
                            <div class="col-12 col-lg-6 mt-2">
                                <button type="button" style="width:100%; height:60px" onclick="history.back()" class="btn btn-outline-primary">
                                    {{ __('Back') }}
                                </button>
                            </div>

                         <div class="col-12 col-lg-6 mt-2">
                             <button type="submit" style="width:100%; height:60px" class="btn btn-primary">
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

</div>
<script>


$(document).ready(function () {
    
    $('#courses').change(function (e) { 
        e.preventDefault();

        if($('#courses option:selected').val()=='College of Architecture'){
         $('#colleges_div').hide()
         $('#colleges').val('ARC')
        }
        else if($('#courses option:selected').val()=='Accountancy' || $('#courses option:selected').val()=='Customs Administration' 
        || $('#courses option:selected').val()=='Finance & Economic' || $('#courses option:selected').val()=='Hospitality Management'
        || $('#courses option:selected').val()=='Management & Marketing'){
            $('#colleges_div').show()
            $('#colleges').val('BUS')
        }
        else if($('#courses option:selected').val()=='Communication' || $('#courses option:selected').val()=='Education' 
        || $('#courses option:selected').val()=='Languages' || $('#courses option:selected').val()=='Physical Education'
        || $('#courses option:selected').val()=='Social Sciences'){
            $('#colleges_div').show()
            $('#colleges').val('CELA')
        }
        else if($('#courses option:selected').val()=='Chemical' || $('#courses option:selected').val()=='Civil' 
        || $('#courses option:selected').val()=='Computer' || $('#courses option:selected').val()=='Electrical'
        || $('#courses option:selected').val()=='Electronics Communication' || $('#courses option:selected').val()=='Mining & Geology'
        || $('#courses option:selected').val()=='Industrial' || $('#courses option:selected').val()=='Mechanical'){
            $('#colleges_div').show()
            $('#colleges').val('ENG')
        }
        else if($('#courses option:selected').val()=='College of Law'){
            $('#colleges_div').hide()
            $('#colleges').val('LAW')
        }
        else if($('#courses option:selected').val()=='College of Nursing'){
            $('#colleges_div').hide()
            $('#colleges').val('NUR')
        }
        else if($('#courses option:selected').val()=='College of Pharmacy'){
            $('#colleges_div').hide()
            $('#colleges').val('PHA')
        }
        else if($('#courses option:selected').val()=='Chemistry' || $('#courses option:selected').val()=='Computer Science' 
        || $('#courses option:selected').val()=='Biology' || $('#courses option:selected').val()=='Psychology'
        || $('#courses option:selected').val()=='Information Technology & Information Systems' 
        || $('#courses option:selected').val()=='Math & Physics'){
            $('#colleges_div').show()
            $('#colleges').val('COS')
        }
    });
});
</script>
@endsection
