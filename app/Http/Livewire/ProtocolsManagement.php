<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Researcher;
use App\Models\Protocol;
use App\Models\Timestamp;
use App\Models\ReturnNote;
use App\Models\TerminateNote;
use App\Models\User;
use App\Models\ProtocolCode;
use App\Models\BoardMember;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class ProtocolsManagement extends Component
{

 
    public $user_id, $forApproval_id;
    public $comment;

   
    public function render()
    {
    
    $variables = ['query','protocolCode','researchers','protocols',
    'approval','colleges','data','sort','board_members','reviewer','tor','status'];  

    $approval = $_GET['approval'] ?? 'all';
    
    $status = 'All Protocols';
    
    $query = $_GET['query'] ?? '';
    $data = $_GET['data'] ?? '15';
    $sort = $_GET['sort'] ?? 'DESC';
    $reviewer = $_GET['reviewer'] ?? 'all';
    $tor = $_GET['tor'] ?? 'all';
    $board_members = BoardMember::all();

      if(Auth::user()->role == 'Admin'){
        $colleges = $_GET['colleges'] ?? 'all';
        $protocolCode = ProtocolCode::all();
        $researchers = Researcher::all();
        $board_member = BoardMember::find($reviewer);
      }
      else{
        $researchers = Researcher::where('colleges', Auth::user()->colleges)->get();
        $colleges = Auth::user()->colleges;
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
        
        $protocolCode = ProtocolCode::whereIn('program_codes', $programCodes[$colleges])->get();
      }
    
          if($approval=='all'){
            $protocolsQuery = Protocol::orderByRaw("FIELD(approval, 'On-going Review', 'Approved & On-going','Returned', 'Terminated', 'Completed')");
          }
          else{
           
            if($approval=='ongoing'){
              $status = 'On-going Review'; 
            }
            else if($approval=='approved'){
              $status = 'Approved & On-going'; 
            }
            else if($approval=='returned'){
              $status = 'Returned'; 
            }
            else if($approval=='terminated'){
              $status = 'Terminated'; 
            }
            else if($approval=='completed'){
              $status = 'Completed'; 
            }
            else{
              //
            }
               $protocolsQuery = Protocol::where('approval', $status);
          }
          if ($colleges !== 'all') {
              $protocolsQuery->where('college', $colleges);
          }
          
          if ($reviewer !== 'all') {
              $full_name = $board_member->title.' '.$board_member->firstname.' '.$board_member->lastname;
              $protocolsQuery->where('primary_reviewer', $full_name);
          }
          
          if ($tor !== 'all') {
              $protocolsQuery->where('type_of_review', $tor);
          }

          $protocols = $protocolsQuery
          ->where('title','LIKE' , '%'.$query.'%')
          ->orderBy('created_at', $sort)
          ->paginate($data, ['*'], 'page', request()->input('page'))
          ->appends(request()->query());
      

      return view('livewire.protocols.protocols-management', compact($variables))->layout('layouts.base');
    }


    public function setFirstDecision($id)
    {


        $protocol = Protocol::find($id);
        $value = request()->input('value');

        if($value=='Declined'){
          $protocol->approval = 'Terminated';
          $protocol->prev_status = $protocol->status;
          $protocol->status = 'Protocol has been Terminated by UERC.';
        }
        else if($value=='Approved'){
          $protocol->approval = 'Approved & On-going';
          $protocol->status_of_protocol = 'Approved & On-going';
          $protocol->status = 'Decision is now Approved. Please wait for UERC to issue the Initial Certificate';
        }
        else{
          $protocol->status = 'Please assign the Decision in order to proceed.';
        }
       
        $protocol->first_decision = $value;
        $data = [
          'first_decision_access'=>null,
          'final_report_form'=>null,
          'final_manuscript'=>null,
        ];

        if($protocol->final_manuscript!=null){
          Storage::disk('public')->delete($protocol->title.'/'.$protocol->final_manuscript);
        }
        if($protocol->final_report_form!=null){
          Storage::disk('public')->delete($protocol->title.'/'.$protocol->final_report_form);
        }

        $protocol->update($data);
       
    } 
    public function setFirstDecision_access($id)
    {
        date_default_timezone_set('Asia/Manila');

    
        $protocols = Protocol::find($id);
        if($protocols->first_decision_access == null){

          $protocols->first_decision_access = date('Y-m-d');

          $protocols->status = 'Initial Certificate has now been issued by UERC. You may now send the certificate to the reviewer/s. Once done, please attach the Final Report & Manuscript.';
          $protocols->update();
          
        
        }
        else{
          $protocols->first_decision_access = null;
          $protocols->status = "Please wait for UERC to issue the Initial Certificate.";
          $data = [
            'final_report_form'=>null,
            'final_manuscript'=>null
          ];

          if($protocols->final_manuscript!=null){
            Storage::disk('public')->delete($protocols->title.'/'.$protocols->final_manuscript);
          }
          if($protocols->final_report_form!=null){
            Storage::disk('public')->delete($protocols->title.'/'.$protocols->final_report_form);
          }

          $protocols->update($data);
        }
    } 

    public function setFinalDecision_access($id)
    {
        date_default_timezone_set('Asia/Manila');

    
        $protocols = Protocol::find($id);
        if($protocols->final_decision_access == null){

          $protocols->final_decision_access = date('Y-m-d');
          $protocols->update();
          
        
        }
        else{
          $protocols->final_decision_access = null;
          $protocols->update();
        }
       
    } 


    public function delete($id)
    {
      
        $protocols = Protocol::find($id);
        Storage::disk('public')->deleteDirectory('protocols/'.$protocols->college.'/'.$protocols->title);
        Timestamp::where('protocol_id', $id)->delete();
       
        $protocols->delete();
    
    } 

    public function approve($id)
    {
      date_default_timezone_set('Asia/Manila');
      $protocols = Protocol::find($id);
      $protocols->approval = 'Approved & On-going';
      $protocols->final_decision = date('Y-m-d');

      $protocols->update();        
    } 

    public function terminate(TerminateNote $terminate, $id)
    {
      date_default_timezone_set('Asia/Manila');
      $protocols = Protocol::find($id);
      $protocols->approval = 'Terminated';

      $comment = request('terminate_note');
      if($comment!=null){
        $data = [
          'protocol_id' => $id,
          'note' => $comment,
          'from' => Auth::user()->title.' '.Auth::user()->firstname.' '.Auth::user()->lastname,
          'date' => now(),
        ];

        $terminate->create($data);
      }

      $file = request()->file('terminate_attachment');
      if($file){
        $fileName = $file->getClientOriginalName();
        $file->storeAs('protocols/'.$protocols->college.'/'.$protocols->title.'/terminate_attachment', $fileName, 'public');
        $protocols->terminate_attachment =  $fileName;
      }
      $protocols->prev_status = $protocols->status;
      $protocols->status = 'Protocol has been Terminated by UERC.';

      $protocols->update();    
      
      return back()->with('message','Protocol '.$protocols->title.' has been terminated.');
    } 

    public function unterminate($id)
    {
      date_default_timezone_set('Asia/Manila');
      $protocols = Protocol::find($id);


      $protocols->approval = $protocols->status_of_protocol;
      $protocols->status = $protocols->prev_status;
      

      $protocols->update();        
    } 

    public function resetCompletion($id){
      $protocol = Protocol::find($id);

      $protocol->approval = 'Approved & On-going';
      $protocol->status_of_protocol = 'Approved & On-going';

      $protocol->update();
    }
    public function complete($id)
    {
      $protocols = Protocol::find($id);
      $protocols->approval = 'Completed';
      $protocols->status_of_protocol = 'Completed';
      $protocols->final_decision_access = now();

      $protocols->status = 'This Protocol has now been marked by UERC as COMPLETED. You may now send the Final Certificate to the Reviewer/s.';

      $content = "Title: ".$protocols->title."\n";
      $content .= "Protocol Code: ".$protocols->protocol_code."\n";
      $content .= "Status of Submission: ".$protocols->status_of_submission."\n";
      $content .= "Primary Researcher: ".$protocols->p_researcher."\n";
      $content .= "Co-Researcher/s: ".$protocols->c_researcher."\n";
      $content .= "Chapter 1-3: ".$protocols->doc1."\n";
      if($protocols->doc1_2){
        $content .= "Chapter 1-3 (2): ".$protocols->doc1_2."\n";
      }
      $content .= "Ammendment Form: ".$protocols->ammendment_form."\n";
      if($protocols->ammendment_form2){
        $content .= "Ammendment Form (2): ".$protocols->ammendment_form2."\n";
      }
      $content .= "\n";

      $content .= "Date of Receipt: ".date('M d, Y', strtotime($protocols->date_of_receipt))."\n";
      $content .= "Primary Reviewer: ".$protocols->primary_reviewer."\n";
      $content .= "Other Reviewer/s: ".$protocols->other_reviewers."\n";
      $content .= "Research Type: ".$protocols->research_type."\n";
      $content .= "Status of the Protocol: ".$protocols->status_of_protocol."\n";
      $content .= "Funding: ".$protocols->funding."\n";
      $content .= "OR Number: ".$protocols->or_number."\n";
      $content .= "OR Receipt: ".$protocols->or_receipt."\n";
      if($protocols->or_receipt2){
        $content .= "OR Receipt (2): ".$protocols->or_receipt2."\n";
      }
      $content .= "Progress Report: ".$protocols->progress_report."\n";
      if($protocols->progress_report2){
        $content .= "Progress Report (2): ".$protocols->progress_report2."\n";
      }
      $content .= "\n";
  
        if($protocols->type_of_review=='ER'){
            $type_of_review = 'ER - Expedited Review';
        }
        else if($protocols->type_of_review=='EX'){
            $type_of_review = 'EX - Exempted Review';
        }
        else{
            $type_of_review = 'FR - Full Board Review';
        }
    
      $content .= "Type of Review: ".$type_of_review."\n";
      $content .= "Reviewer's Report: ".$protocols->reviewers_report."\n";
      if($protocols->reviewers_report2){
        $content .= "Reviewer's Report (2): ".$protocols->reviewers_report2."\n";
      }
      if($protocols->protocol_attachments){
        $content .= "Protocol Attachment/s: ".$protocols->protocol_attachments."\n";
      }
      $content .= "Final Report: ".$protocols->final_report_form."\n";
      if($protocols->final_report_form2){
        $content .= "Final Report (2): ".$protocols->final_report_form2."\n";
      }
      $content .= "Final Manuscript: ".$protocols->final_manuscript."\n";
      if($protocols->final_manuscript2){
        $content .= "Final Manuscript (2): ".$protocols->final_manuscript2."\n";
      }
      $content .= "\n";

      $content .= "Protocol Created By: ".$protocols->user->title.' '.$protocols->user->firstname.' '.$protocols->user->lastname."\n";


      // Specify the filename for the text file
      $filename = $protocols->title.'.txt';

      // Save the text file to the storage directory
      Storage::disk('public')->put('protocols/'.$protocols->college.'/'.$protocols->title.'/'.$filename, $content);

      $protocols->update();
    } 

   
    public function sendBack($id)
    {
      $protocols = Protocol::find($id);
  
      $protocols->approval = $protocols->status_of_protocol;
      if($protocols->status== 'Returned Protocol. Please check the "Return Note" and comply the required actions. Once done, you may send back the protocol to UERC for process.'){
        $protocols->status = $protocols->prev_status;
      }
   
      

      $protocols->update();

    } 


    public function return(ReturnNote $return, $id)
    {

     
      $protocols = Protocol::find($id);
      
      $comment = request('comment');
      if($comment!=null){
        $data = [
          'protocol_id' => $id,
          'note' => $comment,
          'from' => Auth::user()->title.' '.Auth::user()->firstname.' '.Auth::user()->lastname,
        ];

        $return->create($data);
      }
    $data = [];
      if(request('doc1_c')=='on'){
         $data['doc1_2_access'] = now();
         
      }
      if(request('orreceipt_c')=='on'){
        $data['or_receipt2_access'] = now();
     }
     if(request('progress_c')=='on'){
      $data['progress_report2_access'] = now();
      }
      if(request('report_c')=='on'){
        $data['reviewers_report2_access'] = now();
        }
    if(request('finalmanu_c')=='on'){
      $data['final_manuscript2_access'] = now();
    }
      if(request('finalreport_c')=='on'){
        $data['final_report_form2_access'] = now();
      }
 
      $protocols->approval = 'Returned';
      $protocols->prev_status = $protocols->status;
      $protocols->status = 'Returned Protocol. Please check the "Return Note" and comply the required actions. Once done, you may send back the protocol to UERC for process.';
    
      $protocols->update($data);
      
      return back()->with('message','Protocol "'.$protocols->title.'" has been returned to the user.');
    } 

    
    public function selectedResearcher($user_id){

        $this->user_id = $user_id;
        $selectedResearcher = Researcher::find($this->user_id);
        
 
        return response()->json(['selectedResearcher'=>$selectedResearcher]);
     }
 
     public function export_pdf($id){
         
         $protocols = Protocol::find($id);
   
         return view('view.pdf.phreb', compact('protocols'));
     }

     public function initial_certificate($id){
         
      $protocols = Protocol::find($id);

      return view('view.pdf.initial_certificate', compact('protocols'));
    }

    public function final_certificate($id){
          
      $protocols = Protocol::find($id);

      return view('view.pdf.final_certificate', compact('protocols'));
    }

    public function notice_of_review($id){
          
      $protocols = Protocol::find($id);

      return view('view.pdf.notice_of_review', compact('protocols'));
    }

    public function ndc_agreement($id){
          
      $protocols = Protocol::find($id);

      return view('view.pdf.ndc_agreement', compact('protocols'));
    }

    public function acknowledgement_form($id){
          
      $protocols = Protocol::find($id);
    
      return view('view.pdf.acknowledgement_form', compact('protocols'));
    }
    

    public function acknowledgement_receipt($id){
          
      $protocols = Protocol::find($id);

      return view('view.pdf.acknowledgement_receipt', compact('protocols'));
    }

    public function nda_taken($id){
          
      $protocols = Protocol::find($id);

      return view('view.pdf.nda_taken', compact('protocols'));
    }

    public function transmittal_form($id){
          
      $protocols = Protocol::find($id);

      return view('view.pdf.transmittal_form', compact('protocols'));
    }

    public function transmittal_form_log($id){
          
      $protocols = Protocol::find($id);

      return view('view.pdf.transmittal_form_log', compact('protocols'));
    }

     public function edit($id){
         
      $protocols = Protocol::find($id);

      $uploader_role = ($protocols->user->role);

      $edits = $protocols->edits;

     return response()->json(['protocols' => $protocols, 'uploader_role' => $uploader_role, 'edits' => $edits]);
    }
 
     public function store(Protocol $protocols){
 
      date_default_timezone_set('Asia/Manila');
         
        if(Auth::user()->role=='Admin'){
          $college = 'UERC';
        }
        else{
          $college = Auth::user()->colleges;
        }
          $data = [
            'title' => request('title'),
            'user_id' => auth()->user()->id,
            'college' => $college,
            'date_of_receipt' => date('Y-m-d'),
            'protocol_code' => request('protocol_code'),
            'status_of_submission' => request('status_of_submission'),
            'type_of_review' => request('type_of_review'),
            'p_researcher' => request('p_researcher'),
         
            'c_researcher' => request()->c,
            'other_reviewers' => 'None',
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'research_type' => request('research_type'),
            'status_of_protocol' => 'On-going Review',
            'funding' => request('funding'),
            'or_number' => request('or_number'),
            
            /*
            'reviewers_report' => request('reviewers_report')->storeAs('uploads',request('reviewers_report')->getClientOriginalName(),'public'),
            */
          ];
          /*
        $filesArray = [];
        $files = request('protocol_attachments');
          foreach ($files as $file) {
            $file->storeAs('uploads', $file->getClientOriginalName(),'public');
              array_push($filesArray, $file->getClientOriginalName());
          }
        $filesString = implode('/', $filesArray); 
        $data['protocol_attachments'] = $filesString;
        */
        $userType = Auth::user()->role=='Admin' ? 'UERC' : Auth::user()->colleges;
        $file_or = request()->file('or_receipt');
        $fileName_or = $file_or->getClientOriginalName();
        $file_or->storeAs('protocols/'.$userType.'/'.request('title').'/or_receipt', $fileName_or, 'public');
        $data['or_receipt'] =  $fileName_or;

        $file_doc1 = request()->file('doc1');
        $fileName_doc1 = $file_doc1->getClientOriginalName();
        $file_doc1->storeAs('protocols/'.$userType.'/'.request('title').'/doc1', $fileName_doc1, 'public');
        $data['doc1'] =  $fileName_doc1;

        $file_progress = request()->file('progress_report');
        $fileName_progress = $file_progress->getClientOriginalName();
        $file_progress->storeAs('protocols/'.$userType.'/'.request('title').'/progress_report', $fileName_progress, 'public');
        $data['progress_report'] =  $fileName_progress;

        $protocols->create($data);
        
       

        return back()->with('message','Protocol entitled "'.$data['title'].'" has been uploaded.');
     }

     public function u_orreceipt($id){
   
      $protocol = Protocol::find($id);
  
      $file = request()->file('or_receipt');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/or_receipt', $fileName, 'public');
      $protocol->or_receipt =  $fileName;


      $protocol->update();

      return back()->with('message', "OR Receipt Attached Successfully.");
    }

    public function u_orreceipt_2($id){
   
      $protocol = Protocol::find($id);
  
      $file = request()->file('or_receipt2');
      $fileName = $file->getClientOriginalName();
   
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/or_receipt2', $fileName, 'public');
      $protocol->or_receipt2 =  $fileName;


      $protocol->update();

      return back()->with('message', "OR Receipt (2) Attached Successfully.");
    }

    public function u_progress($id){
   
      $protocol = Protocol::find($id);
  
      $file = request()->file('progress_report');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/progress_report', $fileName, 'public');
      $protocol->progress_report =  $fileName;


      $protocol->update();

      return back()->with('message', "Progress Report Attached Successfully.");
    }

    public function u_progress_2($id){
   
      $protocol = Protocol::find($id);
  
      $file = request()->file('progress_report2');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/progress_report2', $fileName, 'public');
      $protocol->progress_report2 =  $fileName;


      $protocol->update();

      return back()->with('message', "Progress Report (2) Attached Successfully.");
    }

    public function u_terminateattach($id){
   
      $protocol = Protocol::find($id);
  
      $file = request()->file('terminate_attachment');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/terminate_attachment', $fileName, 'public');
      $protocol->terminate_attachment =  $fileName;


      $protocol->update();

      return back()->with('message', "Termination File Attached Successfully.");
    }

    public function u_doc1($id){
    
      $protocol = Protocol::find($id);

      $file = request()->file('doc1');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/doc1', $fileName, 'public');
      $protocol->doc1 =  $fileName;


      $protocol->update();

      return back()->with('message', "Chapter 1-3 Attached Successfully.");
    }

    public function u_doc1_2($id){
    
      $protocol = Protocol::find($id);

      $file = request()->file('doc1_2');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/doc1_2', $fileName, 'public');
      $protocol->doc1_2 =  $fileName;


      $protocol->update();

      return back()->with('message', "Chapter 1-3 (2) Attached Successfully.");
    }

     public function s_revreport($id){
   
         $protocol = Protocol::find($id);
     
         $file = request()->file('reviewers_report');
         $fileName = $file->getClientOriginalName();
         $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/reviewers_report', $fileName, 'public');
         $protocol->reviewers_report =  $fileName;

         if($protocol->type_of_review!='EX'){
          $protocol->status = "Reviewer's report has been attached. Please make sure to review all details before approving the protocol.";
         }

         $protocol->update();

         return back()->with('message', "Reviewer's Report Attached Successfully.");
     }

     public function s_revreport_2($id){
   
      $protocol = Protocol::find($id);
  
      $file = request()->file('reviewers_report2');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/reviewers_report2', $fileName, 'public');
      $protocol->reviewers_report2 =  $fileName;


      $protocol->update();

      return back()->with('message', "Reviewer's Report (2) Attached Successfully.");
  }

     public function s_attachments($id){
   
      $protocol = Protocol::find($id);
  
       
        $filesArray = [];
        $files = request('protocol_attachments');
          foreach ($files as $file) {
            $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/attachments', $file->getClientOriginalName(),'public');
              array_push($filesArray, $file->getClientOriginalName());
          }
        $filesString = implode('/', $filesArray); 
        $protocol->protocol_attachments = $filesString;
        

      $protocol->update();

      return redirect('/protocol_management')->with('message',"File/s successfully attached under Protocol Attachments.");
    }


    public function s_finalmanu($id){
   
      $protocol = Protocol::find($id);
     
      $file = request()->file('final_manuscript');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/final_manuscript', $fileName, 'public');
      $protocol->final_manuscript =  $fileName;

      if($protocol->final_report_form!=null){
        $protocol->status = 'This protocol has been sent to UERC for Final Approval (Completion).';
      }

      $protocol->update();

      return back()->with('message', "Final Manuscript Attached Successfully.");
    }

    public function s_finalmanu_2($id){
   
      $protocol = Protocol::find($id);
     
      $file = request()->file('final_manuscript2');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/final_manuscript2', $fileName, 'public');
      $protocol->final_manuscript2 =  $fileName;


      $protocol->update();

      return back()->with('message', "Final Manuscript (2) Attached Successfully.");
    }

    public function s_ammendment($id){
   
      $protocol = Protocol::find($id);
     
      $file = request()->file('ammendment_form');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/ammendment_form', $fileName, 'public');
      $protocol->ammendment_form =  $fileName;
      $protocol->ammendment_form2_access =  now();


      $protocol->update();

      return back()->with('message', "Ammendment Form Attached Successfully.");
    }

    public function s_ammendment2($id){
   
      $protocol = Protocol::find($id);
     
      $file = request()->file('ammendment_form2');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/ammendment_form2', $fileName, 'public');
      $protocol->ammendment_form2 =  $fileName;


      $protocol->update();

      return back()->with('message', "Ammendment Form 2 Attached Successfully.");
    }

    public function s_finalreport($id){
   
      $protocol = Protocol::find($id);
     
      $file = request()->file('final_report_form');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/final_report_form', $fileName, 'public');
      $protocol->final_report_form =  $fileName;

      if($protocol->final_manuscript!=null){
        $protocol->status = 'This protocol has been sent to UERC for Final Approval (Completion).';
      }

      $protocol->update();

      return back()->with('message', "Final Report Attached Successfully.");
    }

    public function s_finalreport_2($id){
   
      $protocol = Protocol::find($id);
     
      $file = request()->file('final_report_form2');
      $fileName = $file->getClientOriginalName();
      $file->storeAs('protocols/'.$protocol->college.'/'.$protocol->title.'/final_report_form2', $fileName, 'public');
      $protocol->final_report_form2 =  $fileName;


      $protocol->update();

      return back()->with('message', "Final Report (2) Attached Successfully.");
    }

    public function delete_progress($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/progress_report'.'/'.$protocol->progress_report);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->progress_report = null;

      $protocol->update();
    }

    public function delete_progress_2($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/progress_report2'.'/'.$protocol->progress_report2);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->progress_report2 = null;

      $protocol->update();
    }

    public function delete_finalmanu($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/final_manuscript'.'/'.$protocol->final_manuscript);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->final_manuscript = null;
      $protocol->status = 'Please attach the Final Report & Manuscript to move to the next process.';

      $protocol->update();
    }

    public function delete_finalmanu_2($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/final_manuscript2'.'/'.$protocol->final_manuscript2);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->final_manuscript2 = null;


      $protocol->update();
    }

    public function delete_ammendment($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/ammendment_form'.'/'.$protocol->ammendment_form);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->ammendment_form = null;
      $protocol->update();
    }

    public function delete_ammendment2($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/ammendment_form2'.'/'.$protocol->ammendment_form2);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->ammendment_form2 = null;
      $protocol->update();
    }

    public function delete_finalreport($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/final_report_form'.'/'.$protocol->final_report_form);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->final_report_form = null;
      $protocol->update();
    }

    public function delete_finalreport_2($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/final_report_form2'.'/'.$protocol->final_report_form2);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->final_report_form2 = null;
      $protocol->update();
    }

    public function delete_or($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/or_receipt'.'/'.$protocol->or_receipt);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->or_receipt = null;
      $protocol->update();
    }

    public function delete_or_2($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/or_receipt2'.'/'.$protocol->or_receipt2);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->or_receipt2 = null;
      $protocol->update();
    }

    public function delete_terminateattach($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/terminate_attachment'.'/'.$protocol->terminate_attachment);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->terminate_attachment = null;
      $protocol->update();
    }

    public function delete_doc1($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/doc1'.'/'.$protocol->doc1);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->doc1 = null;
      $protocol->update();
    }

    public function delete_doc1_2($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/doc1_2'.'/'.$protocol->doc1_2);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->doc1_2 = null;
      $protocol->update();
    }

    public function delete_report($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/reviewers_report'.'/'.$protocol->reviewers_report);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->reviewers_report = null;
      $protocol->status = "Please attach the Reviewer's Report once available to proceed.";
      $data = [
        'first_decision'=>null,
        'first_decision_access'=>null,
        'final_manuscript'=>null,
        'final_report_form'=>null,
      ];
      if($protocol->final_manuscript!=null){
        Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/final_manuscript'.'/'.$protocol->final_manuscript);
      }
      if($protocol->final_report_form!=null){
        Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/final_report_form'.'/'.$protocol->final_report_form);
      }
      $protocol->update($data);
    }

    public function delete_report_2($id){
   
      $protocol = Protocol::find($id);
    
      Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/reviewers_report2'.'/'.$protocol->reviewers_report2);
      /*
      Storage::disk('public')->deleteDirectory($protocol->title);
      */
      $protocol->reviewers_report2 = null;

 

      $protocol->update();
    }


    public function delete_attachments($id){
   
      $protocol = Protocol::find($id);

      $files = $protocol->protocol_attachments;
      $filesArray = explode("/",$files);
        foreach ($filesArray as $file) {
          Storage::disk('public')->delete($protocol->title.'/'.$file);
        }
      $protocol->protocol_attachments = null;
      $protocol->update();  

    }

     
     public function update($id)
     {
        $protocol = Protocol::find($id);
        $oldData = [
          'title' => $protocol->title,
          'protocol_code' => $protocol->protocol_code,
          'status_of_submission' => $protocol->status_of_submission,
          'type_of_review' => $protocol->type_of_review,
          'p_researcher' => $protocol->p_researcher,
          'c_researcher' => $protocol->c_researcher,
          'email' => $protocol->email,
          'phone_number' => $protocol->phone_number,

          'primary_reviewer' => $protocol->primary_reviewer,
          'other_reviewers' => $protocol->other_reviewers,
          'research_type' => $protocol->research_type,
          'status_of_protocol' => $protocol->status_of_protocol,
          'funding' => $protocol->funding,
          'or_number' => $protocol->or_number,

         ]; 

        $role = request('role');
        $data = [
          'title' => request('edit_title'),
          'protocol_code' => request('edit_protocol_code'),
          'status_of_submission' => request('edit_status_of_submission'),
          'type_of_review' => $protocol->type_of_review,
          'p_researcher' => request('edit_p_researcher'),
          'c_researcher' => request()->c,
          'email' => request('edit_email'),
          'phone_number' => request('edit_phone_number'),
          'primary_reviewer' => request('edit_primary_reviewer'),
          'other_reviewers' => request()->o,
          'research_type' => request('edit_research_type'),
          'status_of_protocol' => $protocol->status_of_protocol,
          'funding' => request('edit_funding'),
          'or_number' => request('edit_or_number'),
         ];          
      
         $protocol->update($data);
 
    
         if($protocol->wasChanged()){

          $changedFields = $protocol->getChanges();
          unset($changedFields['updated_at']);
          if (!empty($changedFields)) {
              // Fields were changed
              // You can add your custom logic here to handle the changes
              // For example, log the changes or perform additional actions
              foreach ($changedFields as $field => $newValue) {
              
                $oldValue = $oldData[$field];
                  // Log or process the changes here
                  // $field is the name of the changed field
                  // $oldValue is the original value
                  // $newValue is the updated value

                  if($field=='title'){
                    $field = ucfirst($field);
                    $userType = Auth::user()->role=='Admin' ? 'UERC' : auth()->user()->colleges;
                    $oldFilePath = "protocols/".$userType."/{$oldData['title']}";
                    $newFilePath = "protocols/".$userType."/{$newValue}";
                    
                 
                    File::move($oldFilePath, $newFilePath);
                    
                    
                   
               
                  }
                  else if($field=='protocol_code'){
                    $field = 'Protocol Code';
                  }
                  else if($field=='status_of_submission'){
                    $field = 'Status of Submission';
                  }
                  else if($field=='p_researcher'){
                    $field = 'Primary Researcher';
                  }
                  else if($field=='c_researcher'){
                    $field = 'Co-Researcher/s';
                  }
                  else if($field=='email'){
                    $field = ucfirst($field);
                  }
                  else if($field=='phone_number'){
                    $field = 'Phone Number';
                  }
                  else if($field=='primary_reviewer'){
                    $field = 'Primary Reviewer';
                    if($oldData['primary_reviewer']==null && $newValue!=null){
                      $protocol->update([
                        'status'=>"Reviewers have been assigned. Please attach the Reviewer's report once it becomes available to proceed.",
                      ]);
                    }
                    if($oldData['primary_reviewer']!=null && $newValue==null){
                      if($protocol->final_manuscript!=null){
               
                         Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/final_manuscript'.'/'.$protocol->final_manuscript);
                      }
                      if($protocol->final_report_form!=null){
          
                         Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/final_manuscript'.'/'.$protocol->final_report_form);
                      }
                      if($protocol->reviewers_report!=null){
        
                         Storage::disk('public')->delete('protocols/'.$protocol->college.'/'.$protocol->title.'/final_manuscript'.'/'.$protocol->reviewers_report);
                      }
                      $protocol->update([
                        'status'=>"Please assign the reviewers using the Edit Button.",
                        'reviewers_report'=>null,
                        'first_decision'=>null,
                        'first_decision_access'=>null,
                        'final_report_form'=>null,
                        'final_manuscript'=>null,
                      ]);
                    }
                  }
                  else if($field=='other_reviewers'){
                    $field = 'Other Reviewers';
                  }
                  else if($field=='research_type'){
                    $field = 'Research Type';
                  }
                  else if($field=='funding'){
                    $field = ucfirst($field);
                  }
                  else if($field=='or_number'){
                    $field = 'OR Number';
                  }
                  else{
                     //
                  }

                  Timestamp::create([
                    "protocol_id" => $id,
                    "process" => $field.' was changed from '.$oldValue.' to '.$newValue.'.',
                   
                  ]);
              }
          }   
          
          return back()->with('message', 'Protocol entitled "'.$data['title'].'" has been updated.'); 
        
         }
         else {
          return back()->with('message', 'No changes made.'); 
        }
     } 
}
