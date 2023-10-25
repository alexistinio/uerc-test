<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Researcher;
use App\Models\Protocol;
use App\Models\User;
use App\Models\ProtocolCode;
use App\Models\BoardMember;
use Illuminate\Support\Facades\Auth;

class UserProtocols extends Component
{
    public function render()
    {
          // for initial certificate access
          $id = $_GET['id'] ?? null;
          $query = $_GET['query'] ?? '';
          $access = request('access', 'forAccess');
          $protocol = request('protocol', 'all');
          $data = request('data', '15');
          $sort = request('sort', 'DESC');
          $reviewer = request('reviewer', 'all');
          $tor = request('tor', 'all');
 

          $protocolCode = ProtocolCode::all();
          $researchers = Researcher::all();
          $board_member = BoardMember::find($reviewer);
          $user = User::find(request('id'));
          $protocolsQuery = $user->protocols();
          if($protocol=='all'){
            $protocolsQuery->orderByRaw("FIELD(approval, 'On-going Review', 'Approved & On-going','Returned', 'Terminated', 'Completed')");
          }
          else{
            if($protocol=='firstDecision'){
              if($access=="forAccess"){
                $protocolsQuery->where('approval', 'Approved & On-going')->where('first_decision_access', null);
              }
              else{
                $protocolsQuery->where('approval', 'Approved & On-going')->where('first_decision_access', "!=", null);
              }
            }
            else if($protocol=='finalDecision'){
              $protocolsQuery->where('final_manuscript', "!=", null);
            }
            else{
              $protocolsQuery->where('approval', $protocol);
            }
          }
          if($tor!='all'){
            $protocolsQuery->where('type_of_review', $tor);
          }
       
        

          $protocols = $protocolsQuery
          ->where('title','LIKE' , '%'.$query.'%')
          ->orderBy('created_at', $sort)
          ->paginate($data, ['*'], 'page', request()->input('page'))
          ->appends(request()->query());
   

       
        $board_members = BoardMember::all();

        return view('livewire.user-protocols', compact('id','user','query','protocols','access','protocol','protocolCode','researchers',
        'data','sort','board_members','reviewer','tor'))->layout('layouts.base');
        
    }
}
