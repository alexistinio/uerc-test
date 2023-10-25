<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Researcher;
use App\Models\Protocol;
use App\Models\ProtocolCode;
use App\Models\BoardMember;
use Illuminate\Support\Facades\Storage;

class AdminAccess extends Component
{
    public function render()
    {

      $query = $_GET['query'] ?? '';
      $access = $_GET['access'] ?? 'forAccess';
      $protocol = $_GET['protocol'] ?? 'all';
      $approval = $_GET['approval'] ?? 'all';
      $data = $_GET['data'] ?? '15';
      $sort = $_GET['sort'] ?? 'DESC';
      $reviewer = $_GET['reviewer'] ?? 'all';
      $tor = $_GET['tor'] ?? 'all';
      $colleges = $_GET['colleges'] ?? 'all';
      
      $protocolCode = ProtocolCode::all();
      $researchers = Researcher::all();
      $board_members = BoardMember::all();
      $board_member = BoardMember::find($reviewer);
      
            $protocolsQuery = Protocol::query();
            if($protocol=='all'){
                $protocolsQuery = Protocol::orderByRaw("FIELD(approval, 'On-going Review', 'Approved & On-going','Returned', 'Terminated', 'Completed')");
            }
            else if($protocol=='typeOfReview'){
                $protocolsQuery->where('approval', 'On-going Review')->where('primary_reviewer', null);
            }
            else if($protocol=='firstDecision'){
                if ($access == 'forAccess') {
                    $protocolsQuery->where('first_decision', '!=', null)->where('first_decision_access', null);
                   } else {
                    $protocolsQuery->where('first_decision', '!=', null)->where('first_decision_access', '!=', null)->where('approval','Approved & On-going');
                   }
            }
            else if($protocol=='finalDecision'){
                $protocolsQuery->where('approval', 'Approved & On-going')->where('progress_report', '!=', null)->where('final_manuscript', '!=', null);
            }
            else{
                if($protocol=='ongoing'){
                    $protocol = 'On-going Review'; 
                  }
                  else if($protocol=='approved'){
                    $protocol = 'Approved & On-going'; 
                  }
                  else if($protocol=='returned'){
                    $protocol = 'Returned'; 
                  }
                  else if($protocol=='terminated'){
                    $protocol = 'Terminated'; 
                  }
                  else if($protocol=='completed'){
                    $protocol = 'Completed'; 
                  }
                  else{
                    //
                  }
                  $protocolsQuery->where('approval', $protocol);
            }
         

           if($reviewer!='all'){
            $full_name = $board_member->title.' '.$board_member->firstname.' '.$board_member->lastname;
            $protocolsQuery->where('primary_reviewer', $full_name);
           }

           if($colleges!='all'){
            $protocolsQuery->where('college', $colleges);
           }

           if($tor!='all'){
            $protocolsQuery->where('type_of_review', $tor);
           }

        $protocols = $protocolsQuery
        ->where('title','LIKE' , '%'.$query.'%')
        ->orderBy('created_at', $sort)
        ->paginate($data, ['*'], 'page', request()->input('page'))
        ->appends(request()->query());

      // You can now work with the simplified arrays as needed

        
        return view('livewire.admin-access', compact('query','colleges','protocols','access','protocol','protocolCode','researchers',
         'approval','data','sort','board_members','reviewer','tor'))->layout('layouts.base');
    }

    public function assign_reviewType($id){

          $protocol = Protocol::find($id);
          $tor = request()->input('value');
          $protocol->type_of_review = $tor;

          if($tor=='EX'){
            $data = [
             'approval' => 'Approved & On-going',
             'status_of_protocol' => 'Approved & On-going',
             'reviewers_report' =>  null,
             'primary_reviewer' => 'EXEMPTED',
             'other_reviewers' => 'EXEMPTED',
             'first_decision' => 'Approved',
             'first_decision_access' => now(),
             'final_report_form' => null,
             'final_manuscript' => null,
            ];

            $protocol->status = 'This protocol has been assigned as EXEMPTED. You may now send the Initial Certificate to the reviewer/s. Once done, please attach the Final Report & Manuscript for the protocol to be sent for final approval.';
          }
          else{
            $data = [
              'approval' => 'On-going Review',
              'status_of_protocol' => 'On-going Review',
              'primary_reviewer' => null,
              'other_reviewers' => null,
              'first_decision' => null,
              'first_decision_access' => null,
              'final_report_form' => null,
              'final_manuscript' => null,
              'reviewers_report' =>  null,
             ];

            if($tor!=null){
               $protocol->status = "Type of Review has been assigned. You may now assign the Reviewers. Please click on the Edit button to proceed.";
            }
            else{
              $protocol->status = 'This protocol is being reviewed. Please wait for the assignment of the Type of Review by the UERC. In the meantime, you may now send the Acknowledgement Form to the reviewer/s';
            }
         
          }

          if($protocol->final_manuscript!=null){
            Storage::disk('public')->delete($protocol->title.'/'.$protocol->final_manuscript);
          }
          if($protocol->final_report_form!=null){
            Storage::disk('public')->delete($protocol->title.'/'.$protocol->final_report_form);
          }
          if($protocol->reviewers_report!=null){
            Storage::disk('public')->delete($protocol->title.'/'.$protocol->reviewers_report);
          }
          
          $protocol->update($data);
    }
}
