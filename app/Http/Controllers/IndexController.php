<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        $category = Category::orderBy('id', 'DESC')->get();
        return view('pages.home', compact('slider', 'category'));
    }
    public function dichvu(){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.services', compact('slider'));
    }
    public function dichvucon($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.sub_service', compact('slug', 'slider'));
    }

    public function danhmuc_game($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.category', compact('slider'));
    }
    public function danhmuccon($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.sub_category', compact('slug', 'slider'));
    }
    public function blogs(){
        $blogs = Blog::orderBy('id', 'DESC')->paginate(20);
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.blogs', compact('slider', 'blogs'));
    }
    public function blogs_detail($slug){
        $blogs = Blog::where('slug', $slug)->first();
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.blog_detail', compact('slider', 'blogs'));
    }
}
