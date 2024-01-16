<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('course',compact('categories'));

        
        // return view('course',[
        //     'categories'=>Category::all(),
        // ]);
    }
}
