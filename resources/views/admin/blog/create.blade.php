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
                <div class="card-header">Thêm Blog Game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('blog.index') }}" class="btn btn-success">Danh sách blog game</a>
                    <br><br>
                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                        {{-- enctype: dữ liệu của biểu mẫu sẽ được mã hóa trước khi gửi lên server. multipart/form-data được sử dụng khi form chứa các file. khi bạn muốn gửi các file từ from lên server. --}}
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" name="title" id="slug" onkeyup="ChangeToSlug()" placeholder="Input title...">
                        </div>
                        {{--@error: tự động sinh ra khi validate lỗi, $message củng vậy  --}}
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" name="slug" id="convert_slug" placeholder="Input title...">
                        </div>
                        @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea class="form-control" name="description" id="desc_blog" placeholder="Input description..."></textarea>
                        </div>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="exampleInputPassword1">Content</label>
                            <textarea class="form-control" name="content" id="content_blog" placeholder="Input content..."></textarea>
                        </div>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" name="status">
                              <option value="1">Hiển thị</option>
                              <option value="0">Không hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
