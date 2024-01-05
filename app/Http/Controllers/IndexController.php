<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $category = Category::orderBy('id', 'DESC')->get();
        return view('pages.home', compact('category'));
    }
    public function dichvu(){
        return view('pages.services');
    }
    public function dichvucon($slug){
        return view('pages.sub_service', compact('slug'));
    }

    public function danhmuc(){
        return view('pages.category');
    }
    public function danhmuccon($slug){
        return view('pages.sub_category', compact('slug'));
    }
}
