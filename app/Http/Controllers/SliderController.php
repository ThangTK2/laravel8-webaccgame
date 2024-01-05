<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::orderBy('id', 'DESC')->paginate(3);
        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
                'title' => 'required|unique:slider|max:255',
                'description'=>'required|max:255',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'status' => 'required'
            ],
            [
                'title.unique' => 'Tên slider đã tồn tại, xin vui lòng điền tên khác',
                'title.required' => 'Tên slider phải có',
                'description.required' => 'Mô tả slider phải có',
                'image.required' => 'Hình ảnh phải có'
            ]
        );

        $slider = new Slider();
        $slider->title = $data['title'];
        $slider->description = $data['description'];
        $slider->status = $data['status'];

        //thêm ảnh vào folder
        $get_image = $request->image;
        $path = 'uploads/slider/';  //hình ảnh sẽ được lưu trong thư mục public/uploads/category/
        $get_name_image = $get_image->getClientOriginalName(); // Lấy tên gốc của tệp hình ảnh
        $name_image = current(explode('.', $get_name_image));  //Lấy tên của hình ảnh mà không bao gồm phần mở rộng  hinh . jpg --> hinh là tên của hình ảnh và sau đó chọn phần đầu tiên của mảng kết quả bằng current().
        $new_image = $name_image.rand(0,99).'.'.$get_name_image; //Tạo một tên mới cho hình ảnh bằng cách thêm một số ngẫu nhiên từ 0 đến 99. Điều này giúp tránh việc trùng lặp tên khi nhiều người dùng tải lên cùng một tên hình ảnh.
        $get_image->move($path, $new_image); // Di chuyển hình ảnh đã chọn đến thư mục
        $slider->image = $new_image; //Lưu tên mới của hình ảnh vào trường image

        $slider->save();  //lưu thông tin của đối tượng $slider vào cơ sở dữ liệu.
        return redirect()->route('slider.index')->with('status', 'Thêm slider thành công');
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
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
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
                'description'=>'required|max:255',
                'status' => 'required'
            ],
            [
                'title.required' => 'Tên slider phải có',
                'description.required' => 'Mô tả slider phải có'
            ]
        );

        $slider = Slider::find($id);
        $slider->title = $data['title'];
        $slider->description = $data['description'];
        $slider->status = $data['status'];

        //thêm ảnh vào folder
        $get_image = $request->image;
        if($get_image){
            //bỏ hình ảnh trong thư mục public/uploads/slider/
            $path_unlink = 'uploads/slider/'.$slider->image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
            //thêm mới hình ảnh
            $path = 'uploads/slider/';  //hình ảnh sẽ được lưu trong thư mục public/uploads/slider/
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên gốc của tệp hình ảnh
            $name_image = current(explode('.', $get_name_image));  //Lấy tên của hình ảnh mà không bao gồm phần mở rộng  hinh . jpg --> hinh là tên của hình ảnh và sau đó chọn phần đầu tiên của mảng kết quả bằng current().
            $new_image = $name_image.rand(0,99).'.'.$get_name_image; //Tạo một tên mới cho hình ảnh bằng cách thêm một số ngẫu nhiên từ 0 đến 99. Điều này giúp tránh việc trùng lặp tên khi nhiều người dùng tải lên cùng một tên hình ảnh.
            $get_image->move($path, $new_image); // Di chuyển hình ảnh đã chọn đến thư mục
            $slider->image = $new_image; //Lưu tên mới của hình ảnh vào trường image
        }
        $slider->save();  //lưu thông tin của đối tượng $slider vào cơ sở dữ liệu.
        return redirect()->back()->with('status', 'Cập nhật slider thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        //bỏ hình ảnh trong thư mục public/uploads/slider/
        $path_unlink = 'uploads/slider/'.$slider->image;
        if(file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $slider->delete();
        return redirect()->back();
    }
}
