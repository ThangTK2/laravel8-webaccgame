<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $category = new Category();
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->status = $data['status'];

        //thêm ảnh vào folder
        $get_image = $request->image;
        $path = 'uploads/category/';  //hình ảnh sẽ được lưu trong thư mục public/uploads/category/
        $get_name_image = $get_image->getClientOriginalName(); // Lấy tên gốc của tệp hình ảnh
        $name_image = current(explode('.', $get_name_image));  //Lấy tên của hình ảnh mà không bao gồm phần mở rộng  hinh . jpg --> hinh là tên của hình ảnh và sau đó chọn phần đầu tiên của mảng kết quả bằng current().
        $new_image = $name_image.rand(0,99).'.'.$get_name_image; //Tạo một tên mới cho hình ảnh bằng cách thêm một số ngẫu nhiên từ 0 đến 99. Điều này giúp tránh việc trùng lặp tên khi nhiều người dùng tải lên cùng một tên hình ảnh.
        $get_image->move($path, $new_image); // Di chuyển hình ảnh đã chọn đến thư mục
        $category->image = $new_image; //Lưu tên mới của hình ảnh vào trường image

        $category->save();  //lưu thông tin của đối tượng $category vào cơ sở dữ liệu.
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->status = $data['status'];

        //thêm ảnh vào folder
        $get_image = $request->image;
        if($get_image){
            //bỏ hình ảnh trong thư mục public/uploads/category/
            $path_unlink = 'uploads/category/'.$category->image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
            //thêm mới hình ảnh
            $path = 'uploads/category/';  //hình ảnh sẽ được lưu trong thư mục public/uploads/category/
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên gốc của tệp hình ảnh
            $name_image = current(explode('.', $get_name_image));  //Lấy tên của hình ảnh mà không bao gồm phần mở rộng  hinh . jpg --> hinh là tên của hình ảnh và sau đó chọn phần đầu tiên của mảng kết quả bằng current().
            $new_image = $name_image.rand(0,99).'.'.$get_name_image; //Tạo một tên mới cho hình ảnh bằng cách thêm một số ngẫu nhiên từ 0 đến 99. Điều này giúp tránh việc trùng lặp tên khi nhiều người dùng tải lên cùng một tên hình ảnh.
            $get_image->move($path, $new_image); // Di chuyển hình ảnh đã chọn đến thư mục
            $category->image = $new_image; //Lưu tên mới của hình ảnh vào trường image
        }
        $category->save();  //lưu thông tin của đối tượng $category vào cơ sở dữ liệu.
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        //bỏ hình ảnh trong thư mục public/uploads/category/
        $path_unlink = 'uploads/category/'.$category->image;
        if(file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $category->delete();
        return redirect()->back();
    }
}
