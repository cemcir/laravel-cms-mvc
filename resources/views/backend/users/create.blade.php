@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">User Ekleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Resim Seç</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="user_file" type="file"/>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label>Ad Soyad</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('name')}}" type="text" name="name"/>
                            </div>
                        </div> 
                    </div> 

                    <div class="form-group">
                        <label>Email</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('email')}}" type="email" name="email"/>
                            </div>
                        </div> 
                    </div> 

                    <div class="form-group">
                        <label>Şifre</label> 
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{old('password')}}" type="password" name="password"/>
                            </div>
                        </div> 
                    </div>

                    <div class="form-group"> 
                        <label>Durum</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="user_status" class="form-control">
                                    <option value="1" @if (old('user_status') == "1") {{ 'selected' }} @endif>Aktif</option>
                                    <option value="0" @if (old('user_status') == "0") {{ 'selected' }} @endif>Pasif</option>
                                </select>
                            </div>
                        </div> 
                    </div> 
                    <div class="form-group">  
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