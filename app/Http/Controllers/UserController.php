<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kursus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view("sesi/index");
    }

    public function login(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            // kalau otentikasi sukses
            return redirect('dashboard')->with('success', Auth::user()->name . ' Berhasil Login');
        }else {
            // kalau otentikasi gagal
            return redirect('sesi')->with('error', 'Username dan Password yang dimasukkan tidak valid');        
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('dashboard')->with('success', 'Berhasil Logout');
    }

    public function register(){
        return view('sesi/register');
    }

     public function create(Request $request){
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ],[
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Silahkan masukkan email yang valid',
            'email.unique' => 'Email sudah pernah digunakan, silahkan pilih email yang lain',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Minimum password yang diizinkan adalah 6 karakter',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make( $request->password )
         
        ];
        User::create($data);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            // kalau otentikasi sukses
            return redirect('dashboard')->with('success', Auth::user()->name . ' Berhasil Login');
        }else {
            // kalau otentikasi gagal
            return back()->with('error', 'Username dan Password yang dimasukkan tidak valid');        
        }
    }

    public function joinKursus(Request $request, $kursusId)
    {
        // $user = Auth::user();
        $user = Auth::user()->with('kursus')->first();
        $kursus = Kursus::find($kursusId);
        //logic dipakai jika nilai kursus tidak berisi null
        // if ($user->kelas->contains($kursus)) {
        //     $message = 'You are already a member of the "' . $kursus->nama . '" class.';
        //     return redirect('dashboard')->with('status', $message);
        // }
        if ($user && $user->kursus && $user->kursus->contains($kursus)) {
            // Pengguna sudah tergabung dengan kelas
            $errormessage = 'You are already a member of the "' . $kursus->judul . '" course.';
            return redirect()->back()->with('error', $errormessage);
        }
        
        $user->kursus()->attach($kursus);
        $successMessage = 'You have joined the "' . $kursus->judul . '" course successfully.';
        return redirect()->back()->with('success',$successMessage);
    }

    //nampilin data user course
    public function showKursusUsers($kursusId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $users = $kursus->users;

        return view('kursus_users', compact('kursus', 'users'));
    }
}
