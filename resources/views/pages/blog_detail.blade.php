@extends('layout')
@section('content')
    <div class="c-layout-page">
        <div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
        <div class="container">
            <div class="c-page-title c-pull-left">
                <h3 class="c-font-uppercase c-font-sbold"><a href="{{ route('blogs')}}" title="Blog tin tức">{{ $blogs->title }}</a></h3>
            </div>
            <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li>/</li>
                <li>
                    <a href="{{ route('blogs')}}">
                        <h1>Blog tin tức</h1>
                    </a>
                </li>
            </ul>
        </div>
        </div>
        <div class="c-content-box c-size-md">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h5>{!!$blogs->description!!}</h5>
                    <p>{!!$blogs->content!!}</p>
                </div>

                <div class="col-md-3">
                    <div class="c-content-ver-nav">
                    <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
                        <h3 class="c-font-bold c-font-uppercase">Danh mục</h3>
                        <div class="c-line-left c-theme-bg"></div>
                    </div>
                    <ul class="c-menu c-arrow-dot1 c-theme">
                        <li><a href="/blog">Tất cả (34)</a></li>
                        <li><a href="/blog/uy-tin-cua-nickvn">Uy Tín Của Nick.vn (1)</a></li>
                        <li><a href="/blog/bai-ghim">Bài Ghim (4)</a></li>
                        <li><a href="/blog/tin-game">Tin Game (10)</a></li>
                        <li><a href="/blog/huong-dan">Hướng Dẫn (19)</a></li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
