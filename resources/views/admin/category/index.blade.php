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
                <div class="card-header">Liệt Kê Danh Mục Game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('category.create') }}" class="btn btn-success">Thêm danh mục game</a>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Hiển thị</th>
                            <th>Hình ảnh</th>
                            <th>Quản lý</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $key => $item)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        @if ($item->status ==0)
                                            Không hiển thị
                                        @else
                                            Hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{ asset('uploads/category/'.$item->image) }}" alt="Hình ảnh" height="80px" width="150px"></td>
                                    <td></td>
                                    <td>
                                        <a href="" class="btn btn-warning">Sửa</a>
                                        <a href="" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>

@endsection