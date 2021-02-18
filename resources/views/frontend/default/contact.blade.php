@extends('frontend.layout')
@section('title',"İletişim")
@section('content')
    
<div class="container">
	
    <h1 class="mt-4 mb-3">Bize
      <small>Ulaşın</small>
    </h1>

    <hr/>
	<br>
	@if(session()->has('success'))
		<div class="alert alert-success">
			<p>{{session('success')}}</p>
		</div>
	@endif
	
	@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
	@endif
    <!-- Content Row -->
    <div class="row">
      <!-- Contact Details Column -->
      <div class="col-lg-8 mb-4">
      	<h3>İLETİŞİM FORMU</h3>
        <form method="POST">
          @csrf
          <div class="control-group form-group">
            <div class="controls">
              <label>Ad Soyad:</label>
              <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Ad Soyad">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Telefon Numarası:</label>
              <input type="tel" class="form-control"  name="phone" placeholder="123-456-78-58" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" >
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Email Adresi:</label>
              <input type="email" class="form-control" name="email" placeholder="Mail">
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Mesaj:</label>
              <textarea rows="10" cols="100" class="form-control" name="message" placeholder="Mesaj" maxlength="999" style="resize:none">{{old('message')}}</textarea>
            </div>
          </div>
          <div id="success"></div>
          <!-- For success/fail messages -->
          <button type="submit" class="btn btn-primary" >Gönder</button>
        </form>
      </div>
      <div class="col-lg-4 mb-4">
        <h3>İLETİŞİM BİLGİLERİ</h3>
        <p>
          <abbr title="Adress">Adres</abbr>: {!! $adres !!} &nbsp {{$il}}/{{$ilce}}
          <br>
        </p>
        <p>
          <abbr title="Phone">Tel</abbr>: {{$phone_sabit}}
        </p>
        <p>
          <abbr title="Email">Email</abbr>:
          <a href="">{{$mail}}</a>
        </p>
      </div>
    </div>  
</div>

       
@endsection
@section('css') @endsection
@section('js') @endsection
