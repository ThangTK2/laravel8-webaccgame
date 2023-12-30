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
                            <th>Thứ tự</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $key => $item)
                                <tr>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>john@example.com</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>

@endsection
