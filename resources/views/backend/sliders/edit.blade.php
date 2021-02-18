@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sliders Düzenleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('slider.update',$sliders->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @isset($sliders->slider_file)
                        <div class="form-group">
                            <label>Yüklü Görsel</label> 
                            <div class="row">
                                <div class="col-xs-12">
                                    <img width="100" height="120" src="/images/sliders/{{$sliders->slider_file}}" alt="">
                                </div>
                            </div> 
                        </div>
                    @endisset

                    <div class="form-group">
                        <label>Resim Seç</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_file" type="file"/>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label>Başlık</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('slider_title', $sliders->slider_title)}}"  type="text" name="slider_title"/>
                            </div>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label>Slug</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('slider_slug', $sliders->slider_slug)}}" type="text" name="slider_slug"/>
                            </div>
                        </div> 
                    </div> 

                    <div class="form-group">
                        <label>Url</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('slider_url',$sliders->slider_url)}}" type="text" name="slider_url"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="slider_status" class="form-control">
                                    <option @if (old('slider_status',$sliders->slider_status) == "1") {{ 'selected' }} @endif value="1">Aktif</option>
                                    <option @if (old('slider_status',$sliders->slider_status) == "0") {{ 'selected' }} @endif value="0">Pasif</option>
                                    <!--
                                        <option {{$sliders->slider_status=="0" ? "selected=''" : ""}} value="0">Pasif</option>
                                    -->
                                </select>
                            </div>
                        </div> 
                    </div> 

                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <label>İçerik</label>
                                <textarea name="slider_content" id="editor1" class="form-control">{{$sliders->slider_content}}</textarea>
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