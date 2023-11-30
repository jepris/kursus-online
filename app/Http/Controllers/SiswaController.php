<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(){
        $data = Siswa::all();
        return view('dashboard', compact('data'));
    }

    public function tambahdatasiswa(){
        return view('tambahdatasiswa');
    }

    public function insertdatasiswa(Request $request){
    Siswa::create($request->all());
    return redirect()->route('dashboard')->with('Success','Data Berhasil Di Tambahkan');
}

}