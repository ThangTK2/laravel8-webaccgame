<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::orderBy('id', 'DESC')->paginate(5);
        return view('admin.blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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

        $data = $request->validate(
            [
                'title' => 'required|unique:blogs|max:255',
                'slug' => 'required|unique:categories|max:255',
                'description'=>'required|max:255',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'content' => 'required',
                'status' => 'required'
            ],
            [
                'title.unique' => 'Tên blog đã tồn tại, xin vui lòng điền tên khác',
                'title.required' => 'Tên blog phải có',
                'slug.unique' => 'Slug blog game đã tồn tại, xin vui lòng điền slug khác',
                'slug.required' => 'Slug blog game phải có',
                'description.required' => 'Mô tả blog phải có',
                'content.required' => 'Nội dung blog phải có',
                'image.required' => 'Hình ảnh phải có'
            ]
        );

        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->slug = $data['slug'];
        $blog->description = $data['description'];
        $blog->content = $data['content'];
        $blog->status = $data['status'];

        //thêm ảnh vào folder
        $get_image = $request->image;
        $path = 'uploads/blog/';  //hình ảnh sẽ được lưu trong thư mục public/uploads/blog/
        $get_name_image = $get_image->getClientOriginalName(); // Lấy tên gốc của tệp hình ảnh
        $name_image = current(explode('.', $get_name_image));  //Lấy tên của hình ảnh mà không bao gồm phần mở rộng  hinh . jpg --> hinh là tên của hình ảnh và sau đó chọn phần đầu tiên của mảng kết quả bằng current().
        $new_image = $name_image.rand(0,99).'.'.$get_name_image; //Tạo một tên mới cho hình ảnh bằng cách thêm một số ngẫu nhiên từ 0 đến 99. Điều này giúp tránh việc trùng lặp tên khi nhiều người dùng tải lên cùng một tên hình ảnh.
        $get_image->move($path, $new_image); // Di chuyển hình ảnh đã chọn đến thư mục
        $blog->image = $new_image; //Lưu tên mới của hình ảnh vào trường image

        $blog->save();  //lưu thông tin của đối tượng $blog vào cơ sở dữ liệu.
        return redirect()->route('blog.index')->with('status', 'Thêm blog thành công');
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
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('blog'));
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

        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'slug' => 'required|max:255',
                'description'=>'required|max:255',
                'content'=>'required',
                'status' => 'required'
            ],
            [
                'title.required' => 'Tên blog phải có',
                'slug.required' => 'Slug blog game phải có',
                'description.required' => 'Mô tả blog phải có',
                'content.required' => 'Nội dung blog phải có'
            ]
        );

        $blog = Blog::find($id);
        $blog->title = $data['title'];
        $blog->description = $data['description'];
        $blog->status = $data['status'];

        //thêm ảnh vào folder
        $get_image = $request->image;
        if($get_image){
            //bỏ hình ảnh trong thư mục public/uploads/blog/
            $path_unlink = 'uploads/blog/'.$blog->image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
            //thêm mới hình ảnh
            $path = 'uploads/blog/';  //hình ảnh sẽ được lưu trong thư mục public/uploads/blog/
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên gốc của tệp hình ảnh
            $name_image = current(explode('.', $get_name_image));  //Lấy tên của hình ảnh mà không bao gồm phần mở rộng  hinh . jpg --> hinh là tên của hình ảnh và sau đó chọn phần đầu tiên của mảng kết quả bằng current().
            $new_image = $name_image.rand(0,99).'.'.$get_name_image; //Tạo một tên mới cho hình ảnh bằng cách thêm một số ngẫu nhiên từ 0 đến 99. Điều này giúp tránh việc trùng lặp tên khi nhiều người dùng tải lên cùng một tên hình ảnh.
            $get_image->move($path, $new_image); // Di chuyển hình ảnh đã chọn đến thư mục
            $blog->image = $new_image; //Lưu tên mới của hình ảnh vào trường image
        }
        $blog->save();  //lưu thông tin của đối tượng $blog vào cơ sở dữ liệu.
        return redirect()->back()->with('status', 'Cập nhật blog thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        //bỏ hình ảnh trong thư mục public/uploads/blog/
        $path_unlink = 'uploads/blog/'.$blog->image;
        if(file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $blog->delete();
        return redirect()->back();
    }
}
