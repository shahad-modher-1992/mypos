<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return response()->json([
           'status'  => 200,
           'message' => 'getting users successfuly',
           'data'    => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->roles()->attach(3);

        return response()->json([
            'status'   => 200,
            "message"  => "add this user successfuly",
            'data'     => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::findOrFail($id);
        $user->delete();
        return response()->json([
            'status'   => 200,
            "message"  => "succuessful deleted",
            'data'     => $user
        ]);
    }

    //start login function

    public function login(Request $request) {

       $ep = $request->only(['email', 'password']);
         Auth::attempt($ep);

        return response()->json([
            'status'   => 200,
            "message"  => "succuessful login",
            // 'data'     => $user
        ]);
    }
   
    //end login function


    // start setPermissions function

    public function setPermissions(UserRequest $request) {
        $data = $request->except('permissions');
        $user = User::create($data);
        $user->roles()->attach(2);

        $role = Role::find(2);
        $role->permissions()->attach($request->permissions);
        return response()->json([
            'status' => 200,
            'message' => "set permissions successfuly",
            'data' => $user,
        ]);
        
    }


    ///start search function 

    public function search(Request $request) {
        $users = User::where('id', '>', 1)->when($request->search, function($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        })->get();


        return response()->json([
            'status'   => 200,
            'message'  => 'search had been successfuly',
            'data'     => $users
        ]);
    }
}
