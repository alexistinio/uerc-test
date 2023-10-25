<?php

namespace App\Http\Livewire;

use App\Models\BoardMember;
use Livewire\Component;
use App\Models\Protocol;
use App\Models\User;

class Dashboard extends Component
{
    public function render()
    {

        if(isset($_GET['intervals'])){
            $intervals = $_GET['intervals'];
        }
        else{
            $intervals = null;
        }

        if(isset($_GET['month'])){
            $month = $_GET['month'];
        }
        else{
            $currentYear = date("Y");
            $currentMonth = date("m");
            $month = $currentYear.'-'.$currentMonth;
        }

        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }
        else{
            $year = date("Y");
        }
       
        $uerc_protocols = Protocol::where('college', 'UERC')->take(10)->orderBy('created_at', 'DESC')->get();
        $cerc_protocols = Protocol::where('college','!=', 'UERC')->take(10)->orderBy('created_at', 'DESC')->get();

        $underApprovalProtocols = Protocol::where('approval','On-going Review')->get();
        $approvedProtocols = Protocol::where('approval','Approved & On-going')->get();
        $returnedProtocols = Protocol::where('approval','Returned')->get();
        $terminatedProtocols = Protocol::where('approval','Terminated')->get();
        $completedProtocols = Protocol::where('approval','Completed')->get();

        $uerc = User::where('role','Admin')->take(13)->orderBy('created_at', 'DESC')->get();
        $board_members = BoardMember::all();
        $cerc = User::where('role','CERC')->take(13)->orderBy('created_at', 'DESC')->get();

        return view('livewire.dashboard', compact('uerc','board_members','cerc','underApprovalProtocols','approvedProtocols',
        'returnedProtocols','completedProtocols','terminatedProtocols','uerc_protocols','cerc_protocols'))
        ->layout('layouts.base');
    }
}
