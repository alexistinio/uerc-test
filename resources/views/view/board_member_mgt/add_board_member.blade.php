@extends('layouts.base')
@section('content')
<div class="content">
    
<style>
     a{
        text-decoration:none;
        font-family: inherit;
    }
    input, select{
        height: 50px
    }
    label{
        font-size: 15px
    }
</style>
<div class="container-fluid">
<div class="card text-start py-3 px-3 mb-3 mt-3 shadow" style="border: none">
                    <div style="line-height: normal">
                    
                        <h3 class="pt-1" style="font-family: 'Inter Tight', sans-serif;">{{ __('Add Board Member') }}</h3>
                        <div style="font-family: Inter, sans-serif; font-size: 16px"><a href="/board_member_mgt">Board Member Management</a>&nbsp;&nbsp;/&nbsp;&nbsp;<span class="text-dark">Board Member Portal</span></div>
                     
                    </div>
                </div>
                <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow" style="border: none">
                <div id="card_body" class="card-body mt-4">
                <form id="selectform" method="POST" action="/board_member_mgt/store">
                        @csrf
                    <div class="px-md-3">
                        <div class="row">
                            <div class="col">
                            <h4 class="pb-2" style="font-family: BlinkMacSystemFont">Board Member Details</h4>
                            </div>
                   </div>

                       
                        <div class="row mb-3">
                            <div class="col-md-2">
                            <select name="title" class="form-select @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" autocomplete="title" autofocus>
                            
                                <option value="Mr.">Mr.</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Fr.">Fr.</option>
                                <option value="Atty.">Atty.</option>
                            </select>
                            @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                        </div>
                       
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <label class="px-2 mb-1" for="firstname">First name <span style="color:red">*</span></label>
                                <input id="firstname" type="text" placeholder="John" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                            <div class="col-lg-4 mb-4">         
                                <label class="px-2 mb-1" for="lastname">Last name <span style="color:red">*</span></label>
                                <input id="lastname" type="text" placeholder="Doe" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror    
                            </div> 
                         

                             <div class="col-lg-4 mb-4">
                                      
                                <label class="px-2 mb-1" for="initial">Middle Initial</label>
                                <input style="width: 20%" id="initial" type="text" maxlength="1" placeholder="C" class="form-control @error('initial') is-invalid @enderror" name="initial" value="{{ old('initial') }}" autocomplete="initial" autofocus>

                                @error('initial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </col>
                            </div> 

                           
                        <div class="col-lg-4">
                       
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
                       </div>

                            <div class="col-lg-4 mb-4 mt-lg-0 mt-3">
                                    <label class="px-2 mb-1" for="email">Email <span style="color:red">*</span></label>
                                    <input id="email" type="email" placeholder="example@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="px-2 mb-1" for="phone_number">Phone Number</label>
                                    <input id="phone_number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            maxlength = "11" type="number" maxNumber="2" placeholder="093989*****" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" autocomplete="phone_number">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                            </div>  

                  
                         
                 
                
                  

                        <div class="row pb-4 mt-3">
                            <div class="col-12 col-lg-6 mb-2">
                                <button type="button" style="width:100%; height: 60px" class="btn btn-outline-primary" onclick="document.getElementById('selectform').reset()">
                                    {{ __('Clear All Fields') }}
                                </button>
                            </div>
                                    
                   

                         <div class="col-12 col-lg-6">
                                <button type="submit" style="width:100%; height: 60px" class="btn btn-primary ">
                                    {{ __('Add') }}
                                </button>
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
function resetForm(){
    document.getElementById('selectform').reset()
    $('#colleges_div').hide()
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
    
</script>
@endsection