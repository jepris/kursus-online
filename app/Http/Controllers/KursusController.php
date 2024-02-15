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
    public function show(Kursus $kursus){
        return view('kursus.show',compact('kursus'));
    }
    public function edit(Kursus $kursus){
        return view('kursus.edit',compact('kursus'));
    }
    public function update(Request $request, Kursus $kursus){
        $request->validate([
            'cover'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi tipe dan ukuran gambar
            'judul'=> 'required',
            'category_id' => 'required|exists:categories,id',
            'description'=>'required'
        ]);
        if ($request->hasFile('cover')) {
            if($kursus->cover){
                Storage::delete([public_path('/cover_image'),$kursus->cover ]);
            }
            $file = $request->file( 'cover' );
            $name = 'cover-'.date('ymdhis'). '.' . $file->getClientOriginalExtension();
            $request->cover->move( public_path('/cover_image'), $name );
            $gambar = $name;
            $kursus->cover = $gambar;
            $kursus->save();
        }
        return view('kursus.update',compact('kursus'));
    }
    public function destroy(Kursus $kursus){
        if ($kursus->cover) {
            Storage::delete([public_path('/cover_image'),$kursus->cover ]);
        }
    
        $kursus->delete();
        return redirect('/kursus')->with('success', 'Kelas berhasil dihapus.');
    }

    // public function main(){
    //     $kursus = Kursus::all();
    //     return view('kursuses.main', compact('kursus'));
    // }
    // public function create()
    // {
    //     $categories = Category::all();
    //     return view('kursus.create', compact('categories'));
    // }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'deskripsi' => 'required|string',
    //         'category_id' => 'required|exists:categories,id',
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $kursus = new Kursus();
    //     $kursus->nama = $request->input('nama');
    //     $kursus->deskripsi = $request->input('deskripsi');
    //     $kursus->category_id = $request->input('category_id');

    //     if ($request->hasFile('gambar')) {
    //         $gambarPath = $request->file('gambar')->store('kursus', 'public');
    //         $kursus->gambar = basename($gambarPath);
    //     }

    //     $kursus->save();

    //     return redirect()->route('kursus.index')->with('success', 'kursus berhasil ditambahkan!');
    // }
    // public function edit(Kursus $kursus)
    // {
    //     $categories = Category::all();
    //     return view('kursus.edit', compact('kursus', 'categories'));
    // }

    // public function update(Request $request, Kursus $kursus)
    // {
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'deskripsi' => 'required|string',
    //         'category_id' => 'required|exists:categories,id',
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $kursus->nama = $request->input('nama');
    //     $kursus->deskripsi = $request->input('deskripsi');
    //     $kursus->category_id = $request->input('category_id');

    //     if ($request->hasFile('gambar')) {
    //         Storage::delete('kursus/' . $kursus->gambar);
    //         $gambarPath = $request->file('gambar')->store('kursus', 'public');
    //         $kursus->gambar = basename($gambarPath);
    //     }

    //     $kursus->save();

    //     return redirect()->route('kursuses.show', $kursus)->with('success', 'kursus berhasil diperbarui!');
    // }

    // public function destroy(Kursus $kursus)
    // {
    //     Storage::delete('kursus/' . $kursus->gambar);
    //     $kursus->delete();

    //     return redirect()->route('kursuses.index')->with('success', 'kursus berhasil dihapus!');
    // }
}