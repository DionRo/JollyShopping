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
    public function __construct()
    {
        $this->middleware('admin.only')->except(['subscribe', 'unsubscribe']);
    }

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
    public function subscribe(Request $request)
    {
        $email = $request->email;
        $user = \App\User::where('email' , '=' , $email)->first();

        if(isset($user))
        {
            $user->isSubscribed = 1;
            $user->save();

            return redirect('/')->with('status', 'U bent opnieuw aangemeld voor de nieuwsbrief 
            , afmelden gaat wederom via de email.');
        }
        else
        {
            return redirect('/')->with('status', 'Deze email is niet bekend in ons systeem,
            registeer uzelf eerst, u bent dan automatisch aangemeld voor de niewsbrief.');
        }
    }


    public function unsubscribe($email, $securityToken)
    {
        $user = \App\User::where('email', '=' , $email)
            ->where('securityToken', '=', $securityToken)
            ->first();

        $user->isSubscribed = 0;
        $user->save();

        $email = "mailkabouter@jollyshopping.nl";
        $to = $user->email;
        $subject = "Afmelden van de niewsbrief";
        $txt =
            "Beste $user->firstname $user->lastname,
        U heeft zojuist afgemeld op de nieuwsbrief van jollyshopping.nl
        indien u zich opnieuw wilt aanmelden voor de niews brief
        kan dat via de website. 
        
        Met Vriendelijke groet,
        Team JollyShopping";

        $headers = "FROM: ". $email;

        mail($to,$subject,$txt,$headers);

        return redirect('/');

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
