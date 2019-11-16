@extends('models.MainModel')
@section('Title','Войти в систему')
@section('content')
<style>
.main
{
    background-image: url({{url('/').'/img/laptop.jpg'}});
    background-repeat: no-repeat;
    background-size: cover;
      /* Center and scale the image nicely */
  background-position: center;
}
.logo
{
    height: 400px;
    width: 400px;
}
.card
{
  background-color: transparent;
  box-shadow: 0 0px 0px 0 rgba(0,0,0,0),0 0px 0px 0 rgba(0,0,0,0);
}
.text
{
color: black;
font-weight: 500;
font-size: 45px;
}
a
{
  color: #33b5e5 ;
}
a:hover
{
  color: gray;
}
form
{
  color: white;
}
.md-form label
{
  color: white;
}
.form-control
{
  color: white;
}
.form-control:focus
{
  color: white;
}
.error
{
  margin-top: 10px;
  color: white;
  background-color: rgba(250,0,0,.50);
  box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);
  border-radius: 10px;
  align-self: center;
  padding: 10px;
}
.good
{
  margin-top: 10px;
  color: white;
  background-color: rgba(0,250,0,.50);
  box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);
  border-radius: 10px;
  align-self: center;
  padding: 10px;
}
</style>
<div class="main container-fluid img-fluid">
  <!-- Material form login -->
  <div class="container-my container-fluid">
<div class="card">
  <div class="text-center">
    <img src="{{url('/').'/img/Logo.svg'}}" class="img-fluid logo text-center">
  </div>
    @if (count($errors) > 0)
	@foreach ($errors->all() as $error)
	  	<div class="error">{{$error}}</div>
	@endforeach
@endif
@isset($error)
<div class="error">{{$error}}</div>
@endisset
    @isset($good)
        <div class="good">{{$good}}</div>
    @endisset
    <div class="text-center" style="color:white;margin-top:15px;font-size:30px;">
     И , пожалуйста , приложите данные которые вы видете вверзу к сообщению об ошибке. Это поможет мне выяснить в чем проблемма а также активировать Ваш аккаунт. 
    </div>
    </div>
  </div>
  <!-- Material form login -->
  </div>
</div>
@endsection