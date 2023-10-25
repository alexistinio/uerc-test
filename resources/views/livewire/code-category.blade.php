<div>
@include('view.admin.code_category_mgt.edit_protocol_code')
<style>
    th{
        background-color: whitesmoke;
        color: black;

    }
  
    input, select{
        position: relative;
        width:100%;
        height:50px;
        border-radius:6px;
        border: 1px solid silver;
        padding: 0px 8px;
        color:gray
    }

    #category_code option{
        width:20px
    }

    i{
        cursor: pointer;
    }

    h5{
        font-family: BlinkMacSystemFont;
    }
  
    .select-items {
 
  background-color: DodgerBlue;

}
</style>
    <div class="row">
        <div class="col pt-4 px-4">
            <h3 style="font-family: 'Inter Tight', sans-serif;">Protocol Code Management</h3>
            <div>Admin Access</div>
        </div>
    </div>

    <hr class="mt-4">

    <div class="row">
    <div class="col-lg-5">
            <div class="card shadow-lg ps-2 pe-4" style="border: none">
                    <form action="/protocol_code/store" method="POST">
                        @csrf
                      <div class="row">
                        <div class="">
                        <div class="mt-4 mb-1 ms-3" style="font-size: 16px">Year:</div>             
                        <select name="year" id="year" style="height: 50px" class="form-select @error('year') is-invalid @enderror mx-2" value="{{ old('year') }}">
                            <option value="" selected>Nothing selected.</option>
                            @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
                                <option value="{{$year}}">
                                    {{$year}}
                                </option>
                            @endfor
                        </select>
                            @error('year')
                                    <span class="invalid-feedback ms-3 ms-3" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>
                        <div class="">
                        <div class="mt-4 ms-3 mb-1" style="font-size: 16px" style="font-size: 16px">Category Code:</div>      
                        <select name="category_codes" id="category_codes" class="form-select @error('category_codes') is-invalid @enderror mx-2 " value="{{ old('category_codes') }}">
                        <option selected value="">Nothing selected.</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                    
                        </select>
                        @error('category_codes')
                                    <span class="invalid-feedback ms-3" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>
                        <div class="">
                        <div class="mt-4 ms-3 mb-1" style="font-size: 16px">Program Code:</div>      
                        <select id="program_codes" class="form-select @error('program_codes') is-invalid @enderror mx-2" name="program_codes" value="{{ old('program_codes') }}">
                        <option selected value="">Nothing selected.</option>
                        <option value="ARC">College of Architecture</option>
                            <optgroup value="BUS" label="College of Business Administration">
                               <option value="ACC">Accountancy</option> 
                                <option value="CUS">Customs Administration</option> 
                                <option value="FIN">Finance & Economic</option> 
                                <option value="HOS">Hospitality Management</option> 
                                <option value="MGT">Management & Marketing</option> 
                            </optgroup>

                            <optgroup value="CELA" label="College of Education and Liberal Arts">
                                <option value="COM">Communication</option> 
                                <option value="EDU">Education</option> 
                                <option value="LANG">Languages</option> 
                                <option value="PHY">Physical Education</option> 
                                <option value="SOC">Social Sciences</option> 
                            </optgroup>

                            <optgroup value="ENG" label="College of Engineering">
                                <option value="CEE">Chemical</option>
                                <option value="CIV">Civil</option> 
                                <option value="COE">Computer</option> 
                                <option value="ELE">Electrical</option> 
                                <option value="ELC">Electronics Communication</option> 
                                <option value="MIN">Mining & Geology</option> 
                                <option value="IND">Industrial</option> 
                                <option value="MEC">Mechanical</option> 
                            </optgroup>
                            <option value="LAW">College of Law</option>
                            <option value="NUR">College of Nursing</option>
                            <option value="PHA">College of Pharmacy</option>
                

                            <optgroup value="SCI" label="College of Science">
                                <option value="CHE">Chemistry</option> 
                                <option value="COS">Computer Science</option> 
                                <option value="ITM">Information Technology & Information Systems</option> 
                                <option value="MAT">Math & Physics</option> 
                                <option value="BIO">Biology</option> 
                                <option value="PSY">Psychology</option> 
                            </optgroup>
                        </select>
                        @error('program_codes')
                                    <span class="invalid-feedback ms-3" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>
                        <div class="">
                        <div class="mt-4 ms-3 mb-1" style="font-size: 16px">Sequence Code:</div>      
                        <input id="sequence_codes" name="sequence_codes" class="mx-2" type="text" value="{{ $sequence_codes }}" readonly> 
                        </div>
                      </div>
                      <div class="row pb-4 ps-3" style="margin-top: 60px">
                            <div class="col-12 col-lg-6 mb-2">
                                <button type="button" style="width:100%; height:60px" class="btn btn-outline-primary" onclick="document.getElementById('codeForm').reset()">
                                    {{ __('Clear All Fields') }}
                                </button>
                            </div>
                         <div class="col-12 col-lg-6">
                                <button type="submit" style="width:100%; height:60px" class="btn btn-primary">
                                   Add
                                </button>
                         </div>
                        </div>
                        </form>
            </div>
        </div>
        <div class="col-lg-7 mt-4 mt-lg-0">
           <div class="card shadow-lg" style="border: none">
           <div class="d-flex m-4 justify-content-between">
                <h5 class="">Protocol Codes</h5>
                <div class="d-flex align-items-center">
                    <form id="collegesFilter_form" action="" method="get">

                        <select id="colleges" name="colleges" style="height: inherit" class="form-select text-start">
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
                       <?php 
                         echo "<script>document.getElementById('colleges').value = '$colleges'; </script>";
                       ?>
                    </form>
                </div>
           </div>
         
           <table class="mx-auto mt-3 mt-md-4">
                 @if(count($protocolCode)!=0)
                    <tr>         
                    <form id="sort_form" action="" method="get">
                        <th class="px-4">Protocol Code 
                                <span onclick="sort()" class="ms-2" style="font-size:12px;cursor: pointer">
                                    <i class="fa-sharp fa-solid fa-arrow-up {{ ($sort=='ASC') ? '' : 'text-muted' }}"></i>
                                    <i class="fa-sharp fa-solid fa-arrow-down {{ ($sort=='DESC') ? '' : 'text-muted' }}"></i>
                                </span> 
                                <input type="hidden" name="colleges" value="<?php echo $colleges ?>">
                                @if($sort=='DESC')
                                <input type="hidden" name="sort" value="ASC">
                                @else
                                <input type="hidden" name="sort" value="DESC">
                                @endif
                        
                        </th>
                    </form>
                        <th>Actions</th>
                    </tr>
                    @endif
                    <?php $i=1 ?>
                    @forelse($protocolCode as $protocol)
                    <?php $i++;
                    ?>
                    <tr style="background-color: <?php echo ($i %2!=1) ? '#DCDCDC' : '' ?>">
                        <td class="px-4">{{ $protocol->protocol_code }}</td>
                   
                        <td style="width: 220px"><button class="btn btn-warning mx-2" onclick="edit_code(<?php echo json_encode($protocol->id) ?>)" style="font-family: inherit" id="edit_button" data-bs-toggle="modal" data-bs-target="#editModal"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg> Edit</button>

                        <button onclick="delete_function(<?php echo json_encode($protocol->id) ?>,'<?php echo $protocol->protocol_code. ' will be deleted.' ?>', 'protocol_code/delete/' ,'Protocol Code' )"type="button" class="btn btn-outline-danger" value=""><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                            </svg> Delete</button>
                        </td>
                    </tr>
                 @empty
                <div class="col-12">
                     <h2 class="text-center py-5 my-5 text-muted">No protocol code found under {{ $colleges=='all' ? 'All Protocols ' : $colleges }}.</h2>
                </div>
        @endforelse
        </table>
        <div class="mt-5 px-3">{{ $protocolCode->links() }}</div>
           </div>
        </div>

    </div>
<script>

function sort(){

    $('#sort_form').submit()
}

$('#colleges').change(function (e) { 
    e.preventDefault();

    $('#collegesFilter_form').submit()
    
});

function edit_code(id)
{
    $.ajax({
        type: "get",
        url: "/edit_code/"+id,
        dataType: "json",

        success: function (data) {
            $('#edit_year').val(data.protocol_code.year);
            $('#edit_category_codes').val(data.protocol_code.category_codes);
            $('#edit_program_codes').val(data.protocol_code.program_codes);
            $('#edit_sequence_codes').val(data.protocol_code.sequence_codes);
            $('#update_form').attr('action', "/update_code/"+id)
           
        }
    });
}  
</script>
</div>

    
