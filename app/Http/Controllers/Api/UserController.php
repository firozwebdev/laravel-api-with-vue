<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users,200);
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

        if($request->hasfile('image'))
        {
           $file = $request->file('image');
           $name=time().$file->getClientOriginalName();
           $file->move(public_path().'/img/', $name);
        }else{
            $name = '';
        }


        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->image = $name;
        $user->password = bcrypt($request->get('password'));

        $user->save();

        return response()->json($user);

        

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
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
    public function update(Request $request, User $user)
    {
        //$user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        
        
        if($request->hasfile('image'))
        {
           $file = $request->file('image');
           $name = time().$file->getClientOriginalName();
           $file->move(public_path().'/img/', $name);
           $user->image = $name;
        }

       
        $user->update();
        return response()->json($user);
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('User Deleted');
    }
}
