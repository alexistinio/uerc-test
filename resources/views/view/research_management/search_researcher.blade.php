@extends('layouts.base')

@section('content')
<style>
thead{
    font-size: 18px;
    
}
</style>
<div class="content">
<a href="/research_management"><h6 class="pt-3"><< Researcher Management</h6></a>
<div id="usermanagement" class="container">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="card mb-5">
                            <div class="card-header text-start">
                                <div class="row">
                                    <div class="col-6">
                                    <h3 class="pt-3" style="font-family: 'Inter Tight', sans-serif;">{{ __('Search') }}</h3>
                                    </div>
                                  
                                </div>
                            </div>


                  <div class="card-body mt-2">

                  <div class="row">
                    <div class="col-11 mx-auto mb-5">

                    <form type="get" action="{{ url('/research_management/search') }}">
                        @csrf
                    <div class="input-group">
                            <input type="search" class="form-control" value="{{ $_GET['query'] }}"name="query" style="border: 1px solid gray; background-color: transparent; height:55px" placeholder="Search">
                            <button type="submit" class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg></button>
                        </div>
                        </form>
                    </div>
 
                  </div>
                  
                  @if(count($researchers)!=0)
                  <div class="text-center"style="overflow-x:scroll; white-space:nowrap">
                  <table style="width:100%">
                            <tr>
                                <thead>
                                    <th>First Name </th>
                                    <th>Last Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </thead>
                            </tr>
                            <tr> 
                   @endif
                            @forelse($researchers as $researcher)
                                <tbody>

                      
                                <td data-label="Firstname">{{ $researcher->firstname }}</td>
                                <td data-label="Lastname">{{ $researcher->lastname }}</td>
                                <td data-label="Email Address">{{ $researcher->email }}</td>
                                <td data-label="Account Created">{{ $researcher->phone_number }}</td>
                                <td data-label="Account Created">{{ $researcher->department }}</td>

                                <td data-label="#"><a href=""><button class="btn btn-warning mx-2" id="edit_button"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg> Edit</button></a>
                               <button type="button" class="btn btn-outline-danger deleteUserBtn" value=""><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg> Delete</button>
                                  
                                </td>    
                                </tbody>       
                            </tr>
                            @empty
                            <h1 class="text-center py-5 text-muted">No results found.</h1>
                            @endforelse  
                        </table>
                        </div>           
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
