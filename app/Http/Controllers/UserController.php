<?php

namespace App\Http\Controllers;

use App\RoleUser;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        $role_user = RoleUser::all();
        return view('user.create', compact('role_user'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'role_user_id' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required'
            ],
            [
                'nama.required' => 'Nama Harus diisi !',
                'role_user_id.required' => 'Jabatan Harus diisi !',
                'email.required' => 'Email Harus diisi !',
                'email.unique' => 'Email Sudah terdaftar !',
                'password.required' => 'Password Harus diisi !',
            ]
        );

        $user = new User;
        $user->nama = $request->nama;
        $user->role_user_id = $request->role_user_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 

        $user->save();

        return redirect('/user')->with('success', 'User berhasil di tambahkan');
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role_user = RoleUser::all();

        return view('user.edit', compact('user', 'role_user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama' => 'required',
                'role_user_id' => 'required',
                'email' => 'required',
            ],
            [
                'nama.required' => 'Nama Harus diisi !',
                'role_user_id.required' => 'Jabatan Harus diisi !',
                'email.required' => 'Email Harus diisi !',
            ]
        );

        $user = User::find($id);

        $user->nama = $request->nama;
        $user->role_user_id = $request->role_user_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 

        $user->save();

        return redirect('/user')->with('success', 'User Berhasil di edit');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/user')->with('success', 'User Berhasil di Hapus');
    }
}
