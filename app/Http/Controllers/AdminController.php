<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Addres;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Addres::latest()->get()->all();

        return view('admin', compact('data'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required|regex:/[0-9]{9}/',
            'email' => 'required|email|max:255',
            'address' => 'required'
        ]);
        Addres::create($request->all());

        return redirect::back()->with('status', 'The entry was created successfully');
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
        $this->validate($request, [
            'edit_name' => 'required|max:255',
            'edit_phone' => 'required|regex:/[0-9]{9}/',
            'edit_email' => 'required|email|max:255',
            'edit_address' => 'required'
        ]);

        $data = [
            'name' => $request->edit_name,
            'phone' => $request->edit_phone,
            'email' => $request->edit_email,
            'address' => $request->edit_address
        ];

        $result = Addres::find($id)->update($data);

        if ($result) return redirect::back()->with('success', 'The entry was edited successfully');

        return redirect::back()->with('error', 'Something wrong!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Addres::find($id)->delete();

        if ($result) return redirect::back()->with('success', 'The entry was deleted successfully');

        return redirect::back()->with('error', 'Something wrong!');
    }
}
