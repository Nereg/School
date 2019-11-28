@extends('models.MainModel')
@section('Title','Зарегистрироваться в системе')
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
      Регистрация
	</h5>
	
@if (count($errors) > 0)
	@foreach ($errors->all() as $error)
	  	<div class="error">{{$error}}</div>
	@endforeach
@endif
@if (session('name'))<div class="good">{{ session('good')}}</div>@endif
				<!--Card content-->
				<div class="card-body px-lg-5 pt-0">
					<!-- Form -->
					<form class="text-center" action="{{url('/register')}}" method="POST">
      {{ csrf_field() }}
                      
						<!-- name-->
						<div class="md-form">                      
							<input type="text" id="materialLoginFormEmail" name="name" class="form-control" required value="@if (session('name')){{ session('name') }}@endif">
								<label for="materialLoginFormEmail">Имя</label>
							</div>
							<!-- Email -->
							<div class="md-form">
								<input type="email" id="materialLoginFormEmail" name="email" class="form-control" required value="@if (session('email')){{ session('email') }}@endif">
									<label for="materialLoginFormEmail">Електронная почта</label>
								</div>
								<!-- Password -->
								<div class="md-form">
									<input type="password" id="materialLoginFormPassword" name="password" class="form-control" required>
										<label for="materialLoginFormPassword">Пароль</label>
									</div>
									<!-- Password confirmation-->
									<div class="md-form">
										<input type="password" id="materialLoginFormPassword" name="passwordConfirm" class="form-control" required>
											<label for="materialLoginFormPassword">Подтверждение пароля</label>
									</div>
									<input type="hidden" name="GId" value="@if (session('GId')){{ session('GId') }}@endif">
											<!-- Sign in button -->
											<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Войти</button>
											<!-- Register -->
											<p>Уже зарегистрированы ?
          
                      <a href="{{url('/login')}}">Войти</a>
											</p>
											        <!-- Social login -->
        <p>или зарегистрироваться с помощью:</p>
        <a type="button" class="btn-floating btn-tw btn-sm" href="{{url('/GoogleRedirect')}}">
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