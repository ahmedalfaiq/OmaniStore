<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller{

    public function index()
    {
    $users = User::all();
    return view('admin.users.index', compact('users'));
    }



    public function edit($id)    {
        $user = User::findOrFail($id);
        $users = USer::all();
        return view('admin.users.index', compact('user','users'));
    }

    public function update(Request $request, $id){
        // dd($id);
        $request->validate([
            "name" => "required",
            'email' => 'required',
            'role' => 'required',
            'balance' => 'required',
        ]);
        $data = $request->all();

        $formFields=[];
        $formFields['name'] =$data['name'];
        $formFields['email'] =$data['email'];
        // $formFields['password'] =Hash::make($data['password']);
        // 'password' => Hash::make($data['password']),

        $formFields['role'] =$data['role'];
        $formFields['balance'] =$data['balance'];
        $user = User::findOrFail($id);
        $user->update($formFields);
        return back();
    }



    public function delete($id){
        User::destroy($id);
        return back();
    }


}
