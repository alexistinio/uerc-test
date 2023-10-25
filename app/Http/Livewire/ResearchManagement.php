<?php

namespace App\Http\Livewire;
use App\Models\Researcher;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class ResearchManagement extends Component
{

  
    public function render()
    {
        if(Auth::user()->role=='Admin'){
            if(isset($_GET['colleges'])){
                $colleges = $_GET['colleges'];
            }
            else{
                $colleges = 'all';
            }
        }

        if(isset($_GET['query'])){
            $query = $_GET['query'];
        }
        else{
            $query = '';
        }

        if(isset($_GET['data'])){
            $data = $_GET['data'];
        }
        else{
            $data = '5';
        }

        if(isset($_GET['sortDirection'])){
            $sortDirection = $_GET['sortDirection'];
            $sortColumn = $_GET['sortColumn'];
        }
        else{
            $sortDirection = 'DESC';
            $sortColumn = 'created_at';
        }  

        if(Auth::user()->role=='Admin'){
            if($query!=''){
               
                $researchers = Researcher::where('lastname','LIKE' , '%'.$query.'%')->orderBy($sortColumn, $sortDirection)->paginate(6, ['*'], 'page', request()->input('page'));
            }
            else{
                if($colleges=='all'){
                    $researchers = Researcher::orderBy($sortColumn, $sortDirection)->paginate(6, ['*'], 'page', request()->input('page'));
                }
                else{
                  
                    $researchers = Researcher::where('colleges', $colleges)->orderBy($sortColumn, $sortDirection)->paginate(6, ['*'], 'page', request()->input('page'));
                }
            }
           
            return view('livewire.research-management', compact('researchers','sortColumn','sortDirection','colleges','query','data'))->layout('layouts.base');
        }


        else{ // User

            if($query!=''){
               
                $researchers = Researcher::where('colleges', auth()->user()->colleges)->where('lastname','LIKE' , '%'.$query.'%')->orderBy($sortColumn, $sortDirection)->paginate(6, ['*'], 'page', request()->input('page'));
            }
            else{
       
            
                $researchers = Researcher::where('colleges', auth()->user()->colleges)->orderBy($sortColumn, $sortDirection)->paginate(6, ['*'], 'page', request()->input('page'));
            }
   
            return view('livewire.research-management', compact('query','sortDirection','data','sortColumn','researchers'))->layout('layouts.base');
        }
    }

    public function index()
    {
        return view('view.research_management.home');
    }

    public function create()
    {
        return view('view.research_management.add_researcher');
    }

    public function edit()
    {

        $researcher = Researcher::find(request('id'));
        
        return view('view.research_management.edit_researcher', compact('researcher'));
    }


    public function delete($id)
    { 
        $researcher = Researcher::find($id);
        $researcher->delete();
    }

    public function update($id)
    {
        $data = request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone_number' => ['required', 'string', 'min:11', 'max:11'],
            'colleges' => 'required',
            'courses' => 'required',
            
        ]); 
        
        $researcher = Researcher::find($id);
        $researcher->update($data);
        
     
        if($researcher->wasChanged()){
            return redirect('/researcher_management')->with('message', 'Researcher Updated.');  // -> resources/views/stocks/index.blade.php
        }

        else {
            return redirect('/researcher_management')->with('message', 'No changes made.');  // -> resources/views/stocks/index.blade.php
        }
    }

    public function store(Researcher $researcher){
    
        $data = request()->validate([
            'title' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone_number' => ['required', 'string', 'min:11', 'max:11'],
            'colleges' => 'required',
            'courses' => 'required',
        ]);
       
        $data['user_id'] = auth()->user()->id;
        $researcher->create($data);

        return redirect('/researcher_management')->with('message','Researcher "'.$data['firstname'].' '.$data['lastname'].'" has been created.',['researchers'=>$researcher]);
    }
}
