<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'role:admin'])->except("profile");
    }

    public function index(){
        $users = User::orderBy('name')->get();


        return view('pages.user.index', compact('users'));
    }

    public function create(){
        return view('pages.user.create');
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password|min:8',
            'is_admin' => 'required'
        ];

        $messages = [
            'required' => "Field ini harus diisi",
            'email' => 'Format email tidak benar',
            'min' => 'Minimal karakter :min',
            'same' => 'Konfirmasi password tidak sama',
            'unique' => 'Email sudah terdaftar'
        ];

        $this->validate($request,$rules, $messages);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin === 'is_admin' ? 1 : 0,
            'status' => 1
        ]);

        $user->assignRole($request->is_admin === 'is_admin' ? "admin" : "user");


        return redirect()->route('user')->with('success', "User berhasil ditambahkan");
    }

    public function edit($id) {
        $user = User::findOrFail($id);

        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $password = $user->password;
    

        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,'.$id,
            'is_admin' => 'required'
        ];

        $messages = [
            'required' => "Field ini harus diisi",
            'email' => 'Format email tidak benar',
            'min' => 'Minimal karakter :min',
            'same' => 'Konfirmasi password tidak sama',
            'unique' => 'Email sudah terdaftar'
        ];

        $this->validate($request,$rules, $messages);

        if($request->password !== null && $request->password_confirmation !== null){
            $password = bcrypt($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'is_admin' => $request->is_admin === 'is_admin' ? 1 : 0,
            'status' => 1
        ]);

        $model_has_role = \DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->is_admin === 'is_admin' ? "admin" : "user");


        return redirect()->route('user')->with('success', "User berhasil diubah");
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user')->with('success', "User berhasil hapus");
    }

    public function changeStatus($id) {
        $user = User::findOrFail($id);

        $user->update([
            'status' => $user->status == '1' ? 0 : 1
        ]);

        return redirect()->route('user')->with('success', "Status user berhasil diubah");
    }

    public function profile(){
        dd("PROFLE");
    }
}

