@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Blog Düzenleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('blog.update',$blogs->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @isset($blogs->blog_file)
                    <div class="form-group">
                        <label>Yüklü Görsel</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <img width="100" height="120" src="/images/blogs/{{$blogs->blog_file}}" alt="">
                            </div>
                        </div> 
                    </div>
                    @endisset

                    <div class="form-group">
                        <label>Resim Seç</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="blog_file" type="file"/>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label>Başlık</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('blog_title', $blogs->blog_title)}}"  type="text" name="blog_title"/>
                            </div>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label>Slug</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('blog_slug', $blogs->blog_slug)}}" type="text" name="blog_slug"/>
                            </div>
                        </div> 
                    </div> 
                    
                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="blog_status" class="form-control">
                                    <option @if (old('blog_status',$blogs->blog_status) == "1") {{ 'selected' }} @endif value="1">Aktif</option>
                                    <option @if (old('blog_status',$blogs->blog_status) == "0") {{ 'selected' }} @endif value="0">Pasif</option>
                                    <!--
                                        <option {{$blogs->blog_status=="0" ? "selected=''" : ""}} value="0">Pasif</option>
                                    -->
                                </select>
                            </div>
                        </div> 
                    </div> 

                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <label>İçerik</label>
                                <textarea name="blog_content" id="editor1" class="form-control">{{$blogs->blog_content}}</textarea>
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                        </div> 
                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Düzenle</button>
                        </div> 
                    </div> 
                </form>
            </div>
        </div>       
    </section>
@endsection

@section('css') 
@endsection

@section('js')
@endsection