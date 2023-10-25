<?php

use App\Http\Livewire\AdminAccess;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\CodeCategory;
use App\Http\Livewire\UsersAndSort;
use App\Http\Livewire\ResearchManagement;
use App\Http\Livewire\ProtocolsManagement;
use App\Http\Livewire\BoardMemberMgt;
use App\Http\Livewire\Meetings;
use App\Http\Livewire\Reports;
use App\Http\Livewire\UserProtocols;
use App\Http\Livewire\MyProtocols;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {  
    return view('auth.login');
});


Route::get('/', function () {  
    return redirect('/dashboard');
})->middleware('isAdmin','auth');

Auth::routes();

Route::middleware(['isAdmin'])->group(function () {
   
   // User Management
    Route::get('/user_management', UsersAndSort::class);
    Route::get('/add_user', [UsersAndSort::class, 'add_user']);
    Route::get('/edit_user', [UsersAndSort::class, 'edit']);
    Route::post('/update/{id}', [UsersAndSort::class, 'update']);
    Route::get('/user/delete/{id}', [UsersAndSort::class, 'delete']);
    
    Route::get('/search', [UsersAndSort::class, 'search']);
    
    
    //Code & Category
    Route::get('/protocol_codes', CodeCategory::class);
    Route::get('/edit_code/{id}', [CodeCategory::class, 'edit_code']);
    Route::post('/update_code/{id}', [CodeCategory::class, 'update_code']);
    Route::post('/protocol_code/store', [CodeCategory::class, 'store']);
    Route::get('/protocol_code/delete/{id}', [CodeCategory::class, 'delete']);



    // Protocols
    Route::get('/administrator', AdminAccess::class);
    Route::put('/assign_reviewType/{id}', [AdminAccess::class, 'assign_reviewType']);

    Route::get('/user_protocols', UserProtocols::class);
    // Board Members
    Route::get('/create_board_member', [BoardMemberMgt::class, 'create']);
});



Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', Dashboard::class);  

//Edit profile details
Route::get('/edit_profile', [UsersAndSort::class, 'edit_profile']);
Route::put('/update/{id}', [UsersAndSort::class, 'update']);
//Research Management
Route::get('/researcher_management', ResearchManagement::class);
Route::get('/add_researcher', [ResearchManagement::class, 'create']);
Route::post('/edit_researcher', [ResearchManagement::class, 'edit']);
Route::put('/researcher_management/update_researcher/{id}', [ResearchManagement::class, 'update']);
Route::get('/research/delete/{id}', [ResearchManagement::class, 'delete']);
Route::post('/research_management/add_researcher', [ResearchManagement::class, 'store']);
Route::get('/researcher_management/search', [ResearchManagement::class, 'search']);

//Protocol Management
Route::get('/protocol_management', ProtocolsManagement::class);
Route::get('/myprotocols', MyProtocols::class);
Route::get('/export_pdf/{id}', [ProtocolsManagement::class, 'export_pdf']);
Route::get('/initial/{id}', [ProtocolsManagement::class, 'initial_certificate']);
Route::get('/final/{id}', [ProtocolsManagement::class, 'final_certificate']);
Route::get('/notice_of_review/{id}', [ProtocolsManagement::class, 'notice_of_review']);
Route::get('/ndc_agreement/{id}', [ProtocolsManagement::class, 'ndc_agreement']);
Route::get('/nda_taken/{id}', [ProtocolsManagement::class, 'nda_taken']);
Route::get('/acknowledgement_form/{id}', [ProtocolsManagement::class, 'acknowledgement_form']);
Route::get('/acknowledgement_receipt/{id}', [ProtocolsManagement::class, 'acknowledgement_receipt']);
Route::get('/transmittal_form/{id}', [ProtocolsManagement::class, 'transmittal_form']);
Route::get('/transmittal_form_log/{id}', [ProtocolsManagement::class, 'transmittal_form_log']);
Route::get('/setFirstDecision/{id}', [ProtocolsManagement::class, 'setFirstDecision']);
Route::get('/setFirstDecision_access/{id}', [ProtocolsManagement::class, 'setFirstDecision_access']);
Route::get('/delete/{id}', [ProtocolsManagement::class, 'delete']);
Route::get('/fetch_id/{user_id}', [ProtocolsManagement::class, 'selectedResearcher']);
Route::get('/edit_protocol/{id}', [ProtocolsManagement::class, 'edit']);
Route::post('/protocol_management/store/{c}/{o}', [ProtocolsManagement::class, 'store']);
Route::put('/protocol_management/update/{id}/{c}/{o}', [ProtocolsManagement::class, 'update']);
Route::put('/u_orreceipt/{id}', [ProtocolsManagement::class, 'u_orreceipt']);
Route::put('/u_orreceipt_2/{id}', [ProtocolsManagement::class, 'u_orreceipt_2']);
Route::put('/u_progress/{id}', [ProtocolsManagement::class, 'u_progress']);
Route::put('/u_progress_2/{id}', [ProtocolsManagement::class, 'u_progress_2']);
Route::put('/u_doc1/{id}', [ProtocolsManagement::class, 'u_doc1']);
Route::put('/u_doc1_2/{id}', [ProtocolsManagement::class, 'u_doc1_2']);
Route::put('/u_terminateattach/{id}', [ProtocolsManagement::class, 'u_terminateattach']);
Route::put('/s_revreport/{id}', [ProtocolsManagement::class, 's_revreport']);
Route::put('/s_revreport_2/{id}', [ProtocolsManagement::class, 's_revreport_2']);
Route::put('/s_attachments/{id}', [ProtocolsManagement::class, 's_attachments']);

Route::put('/s_finalmanu/{id}', [ProtocolsManagement::class, 's_finalmanu']);
Route::put('/s_finalmanu_2/{id}', [ProtocolsManagement::class, 's_finalmanu_2']);
Route::put('/s_ammendment/{id}', [ProtocolsManagement::class, 's_ammendment']);
Route::put('/s_ammendment2/{id}', [ProtocolsManagement::class, 's_ammendment2']);
Route::put('/s_finalreport/{id}', [ProtocolsManagement::class, 's_finalreport']);
Route::put('/s_finalreport_2/{id}', [ProtocolsManagement::class, 's_finalreport_2']);
Route::get('/delete_report/{id}', [ProtocolsManagement::class, 'delete_report']);
Route::get('/delete_report_2/{id}', [ProtocolsManagement::class, 'delete_report_2']);
Route::get('/delete_or/{id}', [ProtocolsManagement::class, 'delete_or']);
Route::get('/delete_or_2/{id}', [ProtocolsManagement::class, 'delete_or_2']);
Route::get('/delete_terminateattach/{id}', [ProtocolsManagement::class, 'delete_terminateattach']);
Route::get('/delete_doc1/{id}', [ProtocolsManagement::class, 'delete_doc1']);
Route::get('/delete_doc1_2/{id}', [ProtocolsManagement::class, 'delete_doc1_2']);
Route::get('/delete_attachments/{id}', [ProtocolsManagement::class, 'delete_attachments']);
Route::get('/delete_progress/{id}', [ProtocolsManagement::class, 'delete_progress']);
Route::get('/delete_progress_2/{id}', [ProtocolsManagement::class, 'delete_progress_2']);
Route::get('/delete_finalmanu/{id}', [ProtocolsManagement::class, 'delete_finalmanu']);
Route::get('/delete_finalmanu_2/{id}', [ProtocolsManagement::class, 'delete_finalmanu_2']);
Route::get('/delete_finalreport/{id}', [ProtocolsManagement::class, 'delete_finalreport']);
Route::get('/delete_finalreport_2/{id}', [ProtocolsManagement::class, 'delete_finalreport_2']);
Route::get('/delete_ammendment/{id}', [ProtocolsManagement::class, 'delete_ammendment']);
Route::get('/d_ammendment2/{id}', [ProtocolsManagement::class, 'delete_ammendment2']);
Route::put('/return_protocol/{id}', [ProtocolsManagement::class, 'return']);
Route::get('/approve/{id}', [ProtocolsManagement::class, 'approve']);
Route::put('/terminate_protocol/{id}', [ProtocolsManagement::class, 'terminate']);
Route::get('/unterminate/{id}', [ProtocolsManagement::class, 'unterminate']);
Route::get('/complete/{id}', [ProtocolsManagement::class, 'complete']);
Route::get('/reset/{id}', [ProtocolsManagement::class, 'resetCompletion']);
Route::get('/sendBack/{id}', [ProtocolsManagement::class, 'sendBack']);
Route::get('/word_file', [ProtocolsManagement::class, 'word_file']);



//Board Member
Route::get('/board_member_mgt', BoardMemberMgt::class);
Route::get('/board_member/delete/{id}', [BoardMemberMgt::class, 'delete']);
Route::get('/edit_board_member', [BoardMemberMgt::class, 'edit']);
Route::put('/board_member/update/{id}', [BoardMemberMgt::class, 'update']);
Route::post('/board_member_mgt/store', [BoardMemberMgt::class, 'store']);

//Meeting Repos
Route::get('/drive', Meetings::class);
Route::post('/meetings/store', [Meetings::class, 'store']);
Route::post('/meetings/createFolder', [Meetings::class, 'createFolder']);
Route::get('/drive/{folderName}', [Meetings::class, 'openFolder']);
Route::post('/drive/f_store/{id}', [Meetings::class, 'f_store']);
Route::put('/meetings/editFolder/{id}', [Meetings::class, 'editFolder']);
Route::get('/meetings/delete/{id}', [Meetings::class, 'delete']);
Route::get('/meetings/delete/{foldername}/{id}', [Meetings::class, 'd_fileInFolder']);
Route::get('/meetings/delete_folder/{id}', [Meetings::class, 'delete_folder']);


//Reports
Route::get('/reports', Reports::class);
Route::get('/phreb_download', [Reports::class, 'phreb_download']);

});


