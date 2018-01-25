<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class newsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin.only');
    }
    public function index()
    {
        $newsletters = \App\Newsletter::orderBy('created_at', 'desc')->paginate(10);

        return view('admin/newslettersOverview')
            ->with('newsletters', $newsletters );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/addNewsletter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'pdf' => 'required'
        ]);

        $targetfolder = storage_path("newsletters/");

        $targetfolder = $targetfolder . basename( $_FILES['pdf']['name']) ;

        if(move_uploaded_file($_FILES['pdf']['tmp_name'], $targetfolder))

        {

            $newsletter =  new \App\Newsletter();

            $newsletter->title = $request->name;
            $newsletter->description = $request->description;
            $newsletter->path = $targetfolder;

            $newsletter->save();

            return redirect('/admin/newsletters');
        }

        else {

            echo "Problem uploading file";

        }
    }

    public function sendNewsletter($id)
    {
        $users = \App\User::where('isSubscribed', '=' , '1')->get();
        $newsletter = \App\Newsletter::find($id);

        $order = 'Newsletter';
        $path = storage_path($newsletter->path);

        Mail::to($users)->send(new NewsletterMail($order, $path));

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
        //
    }
}
