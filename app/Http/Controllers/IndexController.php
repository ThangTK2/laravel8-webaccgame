<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blogs', 'huongdan')->get();
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        $category = Category::orderBy('id', 'DESC')->get();
        return view('pages.home', compact('slider', 'category', 'blogs_huongdan'));
    }
    public function dichvu(){
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blogs', 'huongdan')->get();
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.services', compact('slider', 'blogs_huongdan'));
    }
    public function dichvucon($slug){
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blogs', 'huongdan')->get();
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.sub_service', compact('slug', 'slider', 'blogs_huongdan'));
    }

    public function danhmuc_game($slug){
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blogs', 'huongdan')->get();
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.category', compact('slider', 'blogs_huongdan'));
    }
    public function danhmuccon($slug){
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blogs', 'huongdan')->get();
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.sub_category', compact('slug', 'slider', 'blogs_huongdan'));
    }
    public function blogs(){
        $blogs = Blog::orderBy('id', 'DESC')->where('kind_of_blogs', 'blogs')->paginate(20);
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blogs', 'huongdan')->get();
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.blogs', compact('slider', 'blogs', 'blogs_huongdan'));
    }
    public function blogs_detail($slug){
        $blogs = Blog::where('slug', $slug)->first();
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blogs', 'huongdan')->get();
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.blog_detail', compact('slider', 'blogs', 'blogs_huongdan'));
    }
}
