<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kursus;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    public function index(){
        $data = Kursus::all();
        return view('dashboard', compact('data'));
    }

    public function tambahdata(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){
        $data = new Kursus;
        $data->cover = $request->cover;
        $data->judul = $request->judul;
        $data->description = $request->description;
        if ( $request->hasFile( 'cover' ) ) {
            $file = $request->file( 'cover' );
            $name = 'cover-'.date('ymdhis'). '.' . $file->getClientOriginalExtension();
            $request->cover->move( public_path('/cover_image'), $name );
            $gambar = $name;
        } else {

            $gambar = $request->cover;
        }
       
        $data->cover = $gambar;
        $data->save();
        return redirect()->route('dashboard')->with('Success','Kursus Berhasil Di Tambahkan');;
    }
}