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
  box-shadow: 0px;
}
.text
{

color: black;
font-weight: 500;
font-size: 45px;
}
.card-body
{
}
a
{
  color: black;
}
a:hover
{
  color: gray;
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
  
    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">
  
      <!-- Form -->
      <form class="text-center" action="#!">
  
        <!-- Email -->
        <div class="md-form was-validated">
          <input type="email" id="materialLoginFormEmail" class="form-control">
          <label for="materialLoginFormEmail">E-mail</label>
          <div class="valid-feedback">
              Looks good!
            </div>
        </div>
  
        <!-- Password -->
        <div class="md-form">
          <input type="password" id="materialLoginFormPassword" class="form-control">
          <label for="materialLoginFormPassword">Password</label>
        </div>
  
        <div class="d-flex justify-content-around">
          <div>
            <!-- Remember me -->
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
              <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
            </div>
          </div>
          <div>
            <!-- Forgot password -->
            <a href="">Forgot password?</a>
          </div>
        </div>
  
        <!-- Sign in button -->
        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>
  
        <!-- Register -->
        <p>Not a member?
          <a href="">Register</a>
        </p>
  
        <!-- Social login -->
        <p>or sign in with:</p>
        <a type="button" class="btn-floating btn-fb btn-sm">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a type="button" class="btn-floating btn-tw btn-sm">
          <i class="fab fa-twitter"></i>
        </a>
        <a type="button" class="btn-floating btn-li btn-sm">
          <i class="fab fa-linkedin-in"></i>
        </a>
        <a type="button" class="btn-floating btn-git btn-sm">
          <i class="fab fa-github"></i>
        </a>
  
      </form>
      <!-- Form -->
  
    </div>
  
  </div>
  <!-- Material form login -->
  </div>
</div>
@endsection