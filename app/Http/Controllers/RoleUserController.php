<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleUser;

class RoleUserController extends Controller
{
    
    public function index()
    {
        $role_user = RoleUser::all();
        return view('role_user.index', compact('role_user'));
    }

    
    public function create()
    {
        return view('role_user.create');
    }

    
    public function store(Request $request)
    {
        $request->validate(
            [
                'jabatan' => 'required',
            ],

            [
                'jabatan.required' => 'Jabatan tidak boleh kosong',
            ]
        );

        $role_user = new RoleUser;
        $role_user->jabatan = $request->jabatan;
        $role_user->save();

        return redirect('/role_user');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $role_user = RoleUser::findOrFail($id);

        return view('role_user.edit', compact('role_user'));
    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'jabatan' => 'required',
            ],

            [
                'jabatan.required' => 'Jabatan tidak boleh kosong',
            ]
        );

        $role_user = RoleUser::find($id);
        $role_user->jabatan = $request->jabatan;
        $role_user->save();
        
        return redirect('/role_user');

    }

    
    public function destroy($id)
    {
        $role_user = RoleUser::find($id);
        $role_user->delete();

        return redirect('/role_user');
    }
}
