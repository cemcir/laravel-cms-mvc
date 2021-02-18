@extends('frontend.layout')
@section('title','Detaylar')
@section('content')
<div class="container">

    <h1 class="mt-4 mb-3">{{$page->page_title}}</h1>

    <div class="row">
        <div class="col-lg-8">
            <img style="width:700px;height:380px;" class="img-fluid rounded" src="/images/pages/{{$page->page_file}}" alt="">
            <hr>
            <p>Yayınlama Tarihi {{$page->created_at->format('d-m-Y h:i')}}</p>
            <hr>        
            <p>{!!$page->page_content!!}</p>
            <hr>
        </div>

        <div class="col-md-4">
            <div class="card my-4">
                <h5 class="card-header">Son Eklenen Bloglar</h5>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($pageList as $list)
                            <a style="text-decoration:none;" href="{{route('page.Detail',$list->page_slug)}}"><li class="list-group-item">{{$list->page_title}}</li></a>
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