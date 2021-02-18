@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Blog Ekleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Resim Seç</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" required name="blog_file" type="file"/>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label>Başlık</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('blog_title')}}" type="text" name="blog_title"/>
                            </div>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <label>Slug</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('blog_slug')}}" type="text" name="blog_slug"/>
                            </div>
                        </div> 
                    </div> 
                   
                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="blog_status" class="form-control">
                                    <option value="1" @if (old('blog_status') == "1") {{ 'selected' }} @endif>Aktif</option>
                                    <option value="0" @if (old('blog_status') == "0") {{ 'selected' }} @endif>Pasif</option>
                                </select>
                            </div>
                        </div> 
                    </div> 
                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <label>İçerik</label>
                                <textarea value="{{old('blog_content')}}" name="blog_content" id="editor1" class="form-control">{{old('blog_content')}}</textarea>
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                        </div> 
                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Ekle</button>
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