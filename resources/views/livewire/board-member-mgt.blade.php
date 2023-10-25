<div>
    <style>
        .container div{
            font-size: 16px;
            font-family: Open Sans, sans serif;
        }
        .container h1{
            font-family: Open Sans, sans serif;
            font-weight: 800;
        }
    </style>

    <div class="d-block d-md-flex justify-content-between px-3">
        <div class="py-4">
            <h3 style="font-family: 'Inter Tight', sans-serif;">Board Member Management</h3>
        </div>
        @if(Auth::user()->role=='Admin')
        <div class="py-md-3 py-0">
            <a href="/create_board_member" class="btn btn-primary p-3 text-light">Add Board Member <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -3px"width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg></a>
        </div>
        @endif
    </div>
    <hr>
    <h2 class="text-center mb-5 mt-4" style="font-family: 'Inter Tight', sans-serif;">UERC Board Members</h2>
    <div class="container-fluid" style="overflow-x:scroll; white-space:nowrap">
 
    <table class="table">
    @foreach($chairperson as $c)
	<tr>
		<td>{{ $c->position }}</td>
    	<td>{{ $c->title }} {{ $c->firstname }} {{ ($c->initial != '') ? $c->initial.'.' : ''}} {{ $c->lastname }}</td>
        <td>{{ $c->email }}</td>
        <td>{{ $c->phone_number }}</td>
        <td class="d-flex <?php echo Auth::user()->role!='Admin' ? 'd-none' : '' ?>">
             <form method="get" action="/edit_board_member">
                
                  
                <input type="hidden" name="id" value="{{ $c->id }}">
            
                <button type="submit" class="btn btn-warning mx-2" id="edit_button"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg> Edit
                </button>
            </form>
            <button onclick="delete_function(<?php echo json_encode($c->id) ?>, '<?php echo $c->firstname.' '.$c->lastname.' will be deleted as board member.' ?>','/board_member/delete/','Board Member')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg> Delete
            </button>
  
        </td>
	</tr>
    @endforeach
    @foreach($secretary as $s)
	<tr>
		<td>{{ $s->position }}</td>
    	<td>{{ $s->title }} {{ $s->firstname }} {{ ($s->initial != '') ? $s->initial.'.' : ''}} {{ $s->lastname }}</td>
        <td>{{ $s->email }}</td>
        <td>{{ $s->phone_number }}</td>
        <td class="d-flex <?php echo Auth::user()->role!='Admin' ? 'd-none' : '' ?>">
                <form method="get" action="/edit_board_member">
              
                  
                <input type="hidden" name="id" value="{{ $s->id }}">
            
                <button type="submit" class="btn btn-warning mx-2" id="edit_button"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg> Edit
                </button>
            </form>
            <button onclick="delete_function(<?php echo json_encode($s->id) ?>, '<?php echo $s->firstname.' '.$s->lastname.' will be deleted as board member.' ?>','/board_member/delete/','Board Member')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg> Delete
            </button>
        </td>
	</tr>
    @endforeach
    @foreach($member as $m)
	<tr>
		<td>{{ $m->position }}</td>
    	<td>{{ $m->title }} {{ $m->firstname }} {{ ($m->initial != '') ? $m->initial.'.' : ''}} {{ $m->lastname }}</td>
        <td>{{ $m->email }}</td>
        <td>{{ $m->phone_number }}</td>
        <td class="d-flex <?php echo Auth::user()->role!='Admin' ? 'd-none' : '' ?>">
             <form method="get" action="/edit_board_member">
               
                  
                <input type="hidden" name="id" value="{{ $m->id }}">
            
                <button type="submit" class="btn btn-warning mx-2" id="edit_button"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg> Edit
                </button>
            </form>
            <button onclick="delete_function(<?php echo json_encode($m->id) ?>, '<?php echo $m->firstname.' '.$m->lastname.' will be deleted as board member.' ?>','/board_member/delete/','Board Member')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg> Delete
            </button>
        </td>
	</tr>
    @endforeach
    @foreach($na_member as $n)
	<tr>
		<td>{{ $n->position }}</td>
    	<td>{{ $n->title }} {{ $n->firstname }} {{ ($n->initial != '') ? $n->initial.'.' : ''}} {{ $n->lastname }}</td>
        <td>{{ $n->email }}</td>
        <td>{{ $n->phone_number }}</td>
        <td class="d-flex <?php echo Auth::user()->role!='Admin' ? 'd-none' : '' ?>">
              <form method="get" action="/edit_board_member">
                 
                  
                <input type="hidden" name="id" value="{{ $n->id }}">
            
                <button type="submit" class="btn btn-warning mx-2" id="edit_button"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg> Edit
                </button>
            </form>
            <button onclick="delete_function(<?php echo json_encode($n->id) ?>, '<?php echo $n->firstname.' '.$n->lastname.' will be deleted as board member.' ?>','/board_member/delete/','Board Member')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg> Delete
            </button>
        </td>
	</tr>
    @endforeach
    @foreach($el_member as $e)
	<tr>
		<td>{{ $e->position }}</td>
    	<td>{{ $e->title }} {{ $e->firstname }} {{ ($e->initial != '') ? $e->initial.'.' : ''}} {{ $e->lastname }}</td>
        <td>{{ $e->email }}</td>
        <td>{{ $e->phone_number }}</td>
        <td class="d-flex <?php echo Auth::user()->role!='Admin' ? 'd-none' : '' ?>">
             <form method="get" action="/edit_board_member">
               
                  
                <input type="hidden" name="id" value="{{ $e->id }}">
            
                <button type="submit" class="btn btn-warning mx-2" id="edit_button"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -4px" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg> Edit
                </button>
            </form>
            <button onclick="delete_function(<?php echo json_encode($e->id) ?>, '<?php echo $e->firstname.' '.$e->lastname.' will be deleted as board member.' ?>','/board_member/delete/','Board Member')" type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg> Delete
            </button>
        </td>
	</tr>
    @endforeach
</table>
</div>
