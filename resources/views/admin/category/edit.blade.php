@extends('layouts.app')

@section('navbar')
    <div class="container">
        @include('admin.include.navbar')
    </div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập Nhật Danh Mục Game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('category.index') }}" class="btn btn-success">Danh sách danh mục game</a>
                    <a href="{{ route('category.create') }}" class="btn btn-success">Thêm danh mục game</a>
                    <br><br>
                    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        {{-- enctype: dữ liệu của biểu mẫu sẽ được mã hóa trước khi gửi lên server. multipart/form-data được sử dụng khi form chứa các file. khi bạn muốn gửi các file từ from lên server. --}}
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" value="{{ $category->title }}" name="title" placeholder="Input title..." required>
                        </div>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" class="form-control-file"  name="image" placeholder="Input title...">
                            <img src="{{ asset('uploads/category/'.$category->image) }}" alt="Hình ảnh" height="80px" width="150px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea class="form-control" name="description" required placeholder="Input description...">{{ $category->description }}</textarea>
                        </div>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" required name="status">
                                @if ($category->status==1)
                                    <option value="1" selected>Hiển thị</option>
                                    <option value="0">Không hiển thị</option>
                                @else
                                    <option value="1">Hiển thị</option>
                                    <option value="0" selected>Không hiển thị</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
