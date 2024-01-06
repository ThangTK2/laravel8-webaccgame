{{-- navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="{{ url('/') }}">Dashboard</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" target="_blank_" href="{{ url('/') }}">Trang chủ <span class="sr-only">(current)</span></a>
          {{-- target="_blank_" mở sang trang mới --}}
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('slider.index') }}">Slider</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('category.index') }}">Danh mục game</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Nick game</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('blog.index') }}">Blogs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Dịch vụ game</a>
        </li>
      </ul>
    </div>
</nav>
