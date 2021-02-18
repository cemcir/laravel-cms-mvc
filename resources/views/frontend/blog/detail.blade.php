@extends('frontend.layout')
@section('title','Detaylar')
@section('content')
<div class="container">

    <h1 class="mt-4 mb-3">{{$blog->blog_title}}</h1>

    <div class="row">
        <div class="col-lg-8">
            <img class="img-fluid rounded" src="/images/blogs/{{$blog->blog_file}}" alt="">
            <hr>
            <p>Yayınlama Tarihi {{$blog->created_at->format('d-m-Y h:i')}}</p>
            <hr>        
            <p>{!!$blog->blog_content!!}</p>
            <hr>
        </div>

        <div class="col-md-4">
            <div class="card my-4">
                <h5 class="card-header">Son Eklenen Bloglar</h5>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($blogList as $list)
                            <a href="{{route('blog.Detail',$list->blog_slug)}}"><li class="list-group-item">{{$list->blog_title}}</li></a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('css') @endsection
@section('js') @endsection