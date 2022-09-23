<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    function __construct()
    {
        //$this->middleware('can:profile.password')->only('store');
    }
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users=User::Orderby('name','ASC')->get();
        return view('users.index',compact('users'));  
    }
   
    public function create(Request $request)
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required',
        ]);
         User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ])->assignRole($request['role']);
        return redirect()->route('user.index');
    }

   
    public function show(User $user)
    {
        $user = User::find($id);
        return view('admin.users.show', ['user'=>$user]);
    }

    
    public function edit(User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

   
    public function update(Request $request, User $user)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    
    public function destroy(User $user)
    {
        
        $user->delete();
    }

}
