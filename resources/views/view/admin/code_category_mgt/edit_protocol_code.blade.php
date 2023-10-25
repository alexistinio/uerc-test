<div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1000" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Protocol Code:</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pe-4">
                                <div class="mb-2">
                        <form id="update_form" method="post">
                        @csrf
                      <div class="row px-3">
                        <div class="col-lg-3 p-2">
                        <label class="d-flex justify-content-lg-center ms-2" for="year">Year</label>               
                        <select name="edit_year" id="edit_year" style="height: 50px" class="form-select @error('edit_year') is-invalid @enderror mx-2 text-center"  autofocus>  
                       
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                            <option value="2033">2033</option>
                        
                        </select>
                        @error('edit_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>
                        <div class="col-lg-3 p-2">
                        <label class="d-flex justify-content-lg-center ms-2" for="category_codes">Category Code</label>
                        <select name="edit_category_codes" id="edit_category_codes" class="form-select @error('edit_category_codes') is-invalid @enderror mx-2 text-center" value="{{ old('edit_category_codes') }}"  autocomplete="edit_category_codes" autofocus>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                    
                        </select>
                        @error('edit_category_codes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>
                        <div class="col-lg-4 p-2">
                        <label class="d-flex justify-content-lg-center ms-2" for="edit_program_codes">Program Code</label>
                        <select id="edit_program_codes" class="form-select @error('edit_program_codes') is-invalid @enderror mx-2" name="edit_program_codes" value="{{ old('edit_program_codes') }}" autocomplete="edit_program_codes" autofocus>
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
                        @error('edit_program_codes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>
                        <div class="col-lg-2 p-2">
                        <label class="d-flex justify-content-lg-center ms-2" for="category_codes">Sequence Code</label>
                        <input id="edit_sequence_codes" name="edit_sequence_codes" class="text-center mx-2" type="text" readonly> 
                        </div>
                      </div>
              
                       
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>