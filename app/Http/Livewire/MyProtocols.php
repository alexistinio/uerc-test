<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Researcher;
use App\Models\Protocol;
use App\Models\User;
use App\Models\ProtocolCode;
use App\Models\BoardMember;
use Illuminate\Support\Facades\Auth;

class MyProtocols extends Component
{
    public function render()
    {
          // for initial certificate access
          $query = $_GET['query'] ?? '';
          $access = request('access', 'forAccess');
          $protocol = request('protocol', 'all');
          $data = request('data', '15');
          $sort = request('sort', 'DESC');
          $reviewer = request('reviewer', 'all');
          $tor = request('tor', 'all');
      
          if(Auth::user()->role == 'Admin'){
            $protocolCode = ProtocolCode::all();
            $researchers = Researcher::all();
            $board_member = BoardMember::find($reviewer);
          }
          else{
            $researchers = Researcher::where('colleges', Auth::user()->colleges)->get();
            $programCodes = [
              'ARC' => ['ARC'],
              'BUS' => ['ACC', 'CUS', 'FIN', 'HOS', 'MGT'],
              'CELA' => ['COM', 'EDU', 'LANG', 'PHY', 'SOC'],
              'ENG' => ['CEE', 'CIV', 'COE', 'ELE', 'MIN', 'IND', 'MEC'],
              'LAW' => ['LAW'],
              'NUR' => ['NUR'],
              'PHA' => ['PHA'],
              'COS' => ['CHE', 'COS', 'ITM', 'MAT', 'BIO', 'PSY'],
          ];
          $protocolCode = ProtocolCode::whereIn('program_codes', $programCodes[Auth::user()->colleges])->get();
          }

          $protocolsQuery = Auth::user()->protocols();
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
            if($reviewer!='all'){
              $full_name = $board_member->title.' '.$board_member->firstname.' '.$board_member->lastname;
              $protocolsQuery->where('primary_reviewer', $full_name);
            }
          

            $protocols = $protocolsQuery
            ->where('title','LIKE' , '%'.$query.'%')
            ->orderBy('created_at', $sort)
            ->paginate($data, ['*'], 'page', request()->input('page'))
            ->appends(request()->query());
     

         
          $board_members = BoardMember::all();

          return view('livewire.my-protocols', compact('query','protocols','access','protocol','protocolCode','researchers',
          'data','sort','board_members','reviewer','tor'))->layout('layouts.base');
    }
}
