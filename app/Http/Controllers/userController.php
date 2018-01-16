<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = \App\Admin::find(1);
        $users = \App\User::paginate(6);

        return view('admin/usersOverview')
            ->with('admin', $admin)
            ->with('users', $users);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = \App\Admin::find(1);
        $user = \App\Admin::find($id);
        $genders = ['Man', 'Vrouw'];

        return view('admin/editUser')
            ->with('admin', $admin)
            ->with('user', $user)
            ->with('genders', $genders);
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
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'gender' => 'required|string',
            'userLevel' => 'required|integer'
        ]);

        $user = \App\Admin::find($id);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->userLevel = $request->userLevel;

        if($request->userLevel == 3){
            $user->rank = 'Eigenaar';
        }
        elseif($request->userLevel == 2){
            $user->rank = 'Beheerder';
        }
        elseif($request->userLevel == 1){
            $user->rank = 'Werknemer';
        }
        else{
            $user->rank = 'Klant';
        }

        $user->save();

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();
        
        return redirect('admin');
    }
}
