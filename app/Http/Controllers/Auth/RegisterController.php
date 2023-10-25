<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected function registered(Request $request, $user)
     {
        if($user->role == 'CERC'){
            return redirect('/user_management?userType=CERC')->with('message','User "'.$user->firstname.' '.$user->lastname.'" under CERC has been created.');
        }
        else{
            return redirect('/user_management')->with('message','Administrator account "'.$user->firstname.' '.$user->lastname.'" has been created.');
        }
     
     }
     
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       
        if(str_contains(url()->previous(), "CERC")){
            return Validator::make($data, [
                'title' => ['required', 'string', 'max:255'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'string', 'min:11', 'max:11'],
                'role' => ['required', 'string', 'max:255'],
                'colleges' => ['required', 'string', 'max:255'],
                'courses' => ['required', 'string', 'max:255'],
                
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        else{
            return Validator::make($data, [
                'title' => ['required', 'string', 'max:255'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'string', 'min:11', 'max:11'],
                'role' => ['nullable', 'string', 'max:255'],
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
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
            
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(str_contains(url()->previous(), "CERC")){
            return User::create([
                'title' => $data['title'],
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'role' => $data['role'],
                'colleges' => $data['colleges'],
                'courses' => $data['courses'],
             
                'password' => Hash::make($data['password']),
            ]);
        }
        else{
            return User::create([
                'title' => $data['title'],
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'role' => $data['role'],
                'position' => $data['position'],
                'password' => Hash::make($data['password']),
            ]);
        }
  
  
    }
}

