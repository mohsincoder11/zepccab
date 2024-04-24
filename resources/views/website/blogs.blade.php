@extends('website-layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Our Blogs || Zhep Tours & Travels
@endsection

@section('head')
    @include('website-layouts.head')
@endsection

@section('theme')
    @include('website-layouts.theme')
@endsection

@section('header')
    @include('website-layouts.header')
@endsection


@section('content')

    <div class="axil-breadcrumb-area breadcrumb-style-default pt--170 pb--70 theme-gradient">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner">
                        <ul class="axil-breadcrumb liststyle d-flex">
                            <li class="axil-breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">Blogs</li>
                        </ul>
                        <h1 class="axil-page-title">Blogs</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-images">
            <i class="shape shape-1 icon icon-bcm-01"></i>
            <i class="shape shape-2 icon icon-bcm-02"></i>
            <i class="shape shape-3 icon icon-bcm-03"></i>
        </div>
    </div>
    <!-- End Breadcrumb Area -->



    <div class="container mt-5">
        <div class="row">
			
								@php
                                    use Illuminate\Support\Facades\DB;
                                    $blogs = DB::table('blogs')
                                    ->select('blogs.*')
									->limit(10)
									->orderby('id','DESC')
                                    ->get();
                                @endphp
						@foreach($blogs as $blog)
			
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="axil-blog-list wow move-up">
                    <div class="blog-top">
                        <h5><a >{{$blog->title}}</a></h5>
                        <div class="author">
                            <div class="author-thumb">
                                <img src="{{asset('public/website/assets/images/logo/logo.png')}}" alt="Blog Author">
                            </div>
                            <div class="info">
                                <h6>Admin </h6>
                                <ul class="blog-meta">
                                    <li>{{$blog->date}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="thumbnail">
                        <a>
                            <img class="w-100" src="https://zhepcab.com/img/{{$blog->image}}" alt="Blog Images">
                        </a>
                    </div>
                    <div class="content">
                        <?php echo $blog->description; ?>
                    </div>
                </div>
            </div>
	
			
			@endforeach

        </div>
    </div>


@endsection

@section('footer')
    @include('website-layouts.footer')
@endsection

@section('script')
    @include('website-layouts.script')
@endsection


