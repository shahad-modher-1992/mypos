<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 
            $users = User::where('id', '>', 1)->when($request->search, function($q) use ($request) {
              return $q->where('name', 'like', '%' . $request->search . '%');
             })->latest()->paginate(5);
            return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('dashboard.users.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $created_data = $request->except(['image','permissions']);
        $image = $request->image;
        $path=time().'.'.$image->getClientOriginalExtension();          
        $request->image->move('user/', $path);
        $created_data['image'] = $path;
         $user = User::create($created_data);
        // dd($user);

        $user->roles()->attach(2);

        $role = Role::find(2);

        $permissions = Permission::where('name' , '=', $request->permissions)->get();

    
        foreach($permissions as $permission) {      
            $role->permissions()->attach($permission->id);           
        }
         

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.user.index');
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
        return view('dashboard.users.edit');
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
        session()->flash('success', __('site.deleted_successfully'));
        return back();
    }
}
