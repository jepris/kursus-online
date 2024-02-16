<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KursusController extends Controller
{
    public function index(){
        // $data = Kursus::all()->paginate(3);
        $data = Kursus::latest()->paginate(3);
        $category= Category::all();
        return view('dashboard', compact(['data','category']));
    }

    public function tambahdata(){
        return view('tambahdata',[
            'category'=> Category::all()
        ]);
    }

    public function insertdata(Request $request){
        $data = new Kursus;
        $data->cover = $request->cover;
        $data->judul = $request->judul;
        $data->category_id = $request->category_id;
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
    // public function exitkursus(Kursus $kursus){
    //     auth()->user()->kursus()->detach($kursus);

    //     return redirect('/course')->with('success', 'Anda telah keluar dari kelas.');
    // }
    public function edit(Kursus $id)
    {
        $kursus = Kursus::find($id);
        return view('kursus.edit', compact('kursus'));
    }

    public function update(Request $request, Kursus $kursus,$id)
    {
        $kursus = Kursus::find($id);
        $kursus->cover = $request->cover;
        $kursus->judul = $request->judul;
        $kursus->category_id = $request->category_id;
        $kursus->description = $request->description;
        if ( $request->hasFile( 'cover' ) ) {
            $file = $request->file( 'cover' );
            $name = 'cover-'.date('ymdhis'). '.' . $file->getClientOriginalExtension();
            $request->cover->move( public_path('/cover_image'), $name );
            $gambar = $name;
        } else {

            $gambar = $request->cover;
        }
       
        $kursus->cover = $gambar;
        $kursus->update();
        // $request->validate([
        //     'nama' => 'required',
        //     'deskripsi' => 'required',
        // ]);

        // $kursus->update($request->all());

        return redirect()->route('kursus.index')->with('status', 'Class updated successfully');
    }

    public function destroy(Kursus $kursus)
    {
        $kursus->delete();

        return redirect()->route('kursus.index')->with('status', 'Class deleted successfully');
    }
}