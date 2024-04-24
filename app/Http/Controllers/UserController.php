<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view("pages.user.index", compact("user"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'password'=> 'required',
            'role' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route("user.index")->with('Success', "Data User berhasil dibuat!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where("id", $id)->first();
        return view("pages.user.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role'=> 'required',
        ]);
        User::where("id", $id)->update([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route("user.index")->with('Success', "Data User berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where("id", $id)->delete();
        return redirect()->route("user.index")->with('Success', "Data User berhasil dihapus!");
    }
}