@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Slider Ekleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Resim Seç</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" required name="slider_file" type="file"/>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label>Başlık</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('slider_title')}}" type="text" name="slider_title"/>
                            </div>
                        </div> 
                    </div> 

                    <div class="form-group">
                        <label>Slug</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('slider_slug')}}" type="text" name="slider_slug"/>
                            </div>
                        </div> 
                    </div> 

                    <div class="form-group">
                        <label>Url</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('slider_url')}}" type="text" name="slider_url"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="slider_status" class="form-control">
                                    <option value="1" @if (old('slider_status') == "1") {{ 'selected' }} @endif>Aktif</option>
                                    <option value="0" @if (old('slider_status') == "0") {{ 'selected' }} @endif>Pasif</option>
                                </select>
                            </div>
                        </div> 
                    </div> 
                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <label>İçerik</label>
                                <textarea value="{{old('slider_content')}}" name="slider_content" id="editor1" class="form-control">{{old('slider_content')}}</textarea>
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