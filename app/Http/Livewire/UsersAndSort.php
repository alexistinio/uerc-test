<?php

namespace App\Http\Livewire;

use App\Models\Researcher;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UsersAndSort extends Component
{
    
    public $delete_id;
    protected $listeners = ['deleteUserConfirmed' => 'deleteUser'];
 

    public function render()
    {
        $query = request('query', '');
        $position = request('position', 'All');
        $userType = request('userType', 'UERC');
        $collegesFilter = request('colleges', 'All');
        $sortDirection = request('sortDirection', 'DESC');
        $sortColumn = request('sortColumn', 'created_at');
    
      if (in_array($collegesFilter, ['ARC', 'BUS', 'CELA', 'ENG', 'LAW', 'NUR', 'PHA', 'COS'])) {
    $users = User::where('colleges', $collegesFilter)
        ->when($position !== 'All', function ($query) use ($position) {
            return $query->where('position', $position);
        })
        ->orderBy($sortColumn, $sortDirection)
        ->paginate(6, ['*'], 'page', request()->input('page'));
} else {
    $role = ($userType == 'UERC') ? 'Admin' : $userType;
    $users = User::where('lastname', 'LIKE', '%' . $query . '%')
        ->where('role', $role)
        ->when($position !== 'All', function ($query) use ($position) {
            return $query->where('position', $position);
        })
        ->orderBy($sortColumn, $sortDirection)
        ->paginate(6, ['*'], 'page', request()->input('page'));
}
    
        return view('livewire.users-and-sort', compact('position','sortDirection', 'sortColumn', 'collegesFilter', 'userType', 'users', 'query'))
            ->layout('layouts.base');
    }
    


    public function delete($id)
    { 
        $user = User::find($id);

        if($user->profile_image){
              Storage::disk('public')->delete($user->profile_image);
        }
      
        
        $user->delete();
    }

 

     public function add_user(){
   
        if(isset($_GET['userType'])){
          $userType = $_GET['userType'];
        }
        else{
          $userType = 'UERC';
        }
  
        return view ('auth.register', compact('userType'));
    }

     public function edit()
     {
        
       $user = User::find(request('id'));
 
        return view('view.admin.user_management.edit_user', compact('user'));
     } 

     public function edit_profile()
     {
        
        $user = auth()->user();
 
        return view('view.admin.user_management.edit_user', compact('user'));
     } 

     public function update(Request $request, $id)
     {
        $user = User::find($id);
        if($user->role=='Admin'){
            request()->validate([
                'firstname'=>'required',
                'lastname'=>'required',
                'email'=>'required',
                'phone_number'=>['required','string','min:11','max:11'],
                'role'=>'required',
                'position' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        // Check if the position being added/updated is 'Chairperson' or 'Secretary'
                        if (in_array($value, ['Chairperson', 'Secretary'])) {
                            // Check if a user with the specified position already exists in the database
                            $existingCount = \DB::table('users')
                                ->where('position', $value)
                                ->where('id', '<>', request()->input('id')) // Exclude the current user when updating
                                ->count();
                
                            if ($existingCount > 0) {
                                $fail("The $value position is already occupied.");
                            }
                        }
                    },
                    'string',
                    'max:255'
                ],
                'profile_image'=>'nullable',
            ]); 

            $user->firstname = request()->input('firstname');
            $user->lastname = request()->input('lastname');
            $user->email = request()->input('email');
            $user->phone_number = request()->input('phone_number');
            $user->role = request()->input('role');
            $user->position = request()->input('position');
         

            $image = $request->file('profile_image');
            if($image != null){
                Storage::delete('public/'.$user->profile_image);

           
                    $path = 'public/profile' . '/uerc';
                
            
                Storage::makeDirectory($path);
                $fileName = $image->getClientOriginalName();

                     $imagePath = $request->file('profile_image')->storeAs('profile/uerc', $fileName, 'public');
                
             

                // Create an instance of Intervention Image and open the temporary image
                $img = Image::make("{$imagePath}")->fit(300, 300);
                $img->save();

                $user->profile_image = $imagePath;
            }
         
        
            // Update the user's profile image path in the database
            // Assuming you have a User model and 'profile_image' column in your users table
          
            
        }
        else{
            request()->validate([
                'firstname'=>'required',
                'lastname'=>'required',
                'email'=>'required',
                'phone_number'=>['required','string','min:11','max:11'],
                'colleges'=>'required',
                'courses'=>'required',
                'profile_image'=>'nullable',
            ]); 

            $user->firstname = request()->input('firstname');
            $user->lastname = request()->input('lastname');
            $user->email = request()->input('email');
            $user->phone_number = request()->input('phone_number');
            $user->colleges = request()->input('colleges');
            $user->courses = request()->input('courses');
            
                $image = $request->file('profile_image');
            if($image != null){
                Storage::delete('public/'.$user->profile_image);

            
                    $path = 'public/profile/'.auth()->user()->colleges;
                
                Storage::makeDirectory($path);
                $fileName = $image->getClientOriginalName();

            
                     $imagePath = $request->file('profile_image')->storeAs('profile/'.auth()->user()->colleges, $fileName, 'public');
                

                // Create an instance of Intervention Image and open the temporary image
                $img = Image::make("{$imagePath}")->fit(300, 300);
                $img->save();

                $user->profile_image = $imagePath;
            }
        }
 
            
            if(request()->password == null){
                //
            }
            else{
                $user->password = Hash::make(request()->password);
            }
            
            $user->update();
        
      
         if($user->wasChanged()){
            if(str_contains(url()->previous(), "edit_profile")){
                return redirect('/dashboard')->with('message', 'Your profile has been updated.');  // -> resources/views/stocks/index.blade.php
            }
            else{
                return redirect('/user_management')->with('message', 'User Updated.');  // -> resources/views/stocks/index.blade.php    
            }
         }
 
         else {
            if(str_contains(url()->previous(), "edit_profile")){
                return redirect('/dashboard')->with('message', 'No changes made.');  // -> resources/views/stocks/index.blade.php
            }
            else{
                return redirect('/user_management')->with('message', 'No changes made.');  // -> resources/views/stocks/index.blade.php 
            }
         }
     } 

}
