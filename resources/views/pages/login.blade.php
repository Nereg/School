@extends('Models.MainModel')
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
  color: white;
  background-color: rgba(250,0,0,.50);
  box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);
  border-radius: 10px;
  align-self: center;
  padding: 10px;
}
.good
{
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
    <h5 class="text-center text">
      Войти
    </h5>
    <div class="error text-center">
     Типо ошибка ;)
    </div>
    <div class="good text-center">
      А ту все хорошо
    </div>
    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">
  
      <!-- Form -->
      <form class="text-center" action="#!">
  
        <!-- Email -->
        <div class="md-form">
          <input type="email" id="materialLoginFormEmail" class="form-control">
          <label for="materialLoginFormEmail">Електронная почта</label>
        </div>
  
        <!-- Password -->
        <div class="md-form">
          <input type="password" id="materialLoginFormPassword" class="form-control">
          <label for="materialLoginFormPassword">Пароль</label>
        </div>
  
        <div class="d-flex justify-content-around">
          <div>
            <!-- Remember me -->
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
              <label class="form-check-label" for="materialLoginFormRemember">Запомнить меня</label>
            </div>
          </div>
          <div>
            <!-- Forgot password -->
            <a href="">Забыли пароль ?</a>
          </div>
        </div>
  
        <!-- Sign in button -->
        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Войти</button>
  
        <!-- Register -->
        <p>Не зарегистрированы ?
          <a href="">Зарегистрироваться</a>
        </p>
  
        <!-- Social login -->
        <p>или войти с помощью:</p>
        <a type="button" class="btn-floating btn-tw btn-sm">
          <i class="fab fa-google"></i>
        </a>
      </form>
      <!-- Form -->
  
    </div>
  
  </div>
  <!-- Material form login -->
  </div>
</div>
@endsection