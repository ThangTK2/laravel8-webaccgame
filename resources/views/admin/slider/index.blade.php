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
                <div class="card-header">Danh Sách Slider</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('slider.create') }}" class="btn btn-success">Thêm slider</a>
                    <br><br>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Tên slider</th>
                            <th>Mô tả</th>
                            <th>Hiển thị</th>
                            <th>Hình ảnh</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($slider as $key => $item)
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
                                    <td><img src="{{ asset('uploads/slider/'.$item->image) }}" alt="Hình ảnh" height="80px" width="150px"></td>
                                    <td>
                                        <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-warning">Sửa</a>
                                        <form id="deleteForm{{ $item->id }}" action="{{ route('slider.destroy', $item->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa slider này không?')" class="btn btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Paginate --}}
                    <div>
                        {{ $slider->links('pagination::bootstrap-4') }}
                        {{-- pagination::bootstrap-4: phân trang theo css bootstrap --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
