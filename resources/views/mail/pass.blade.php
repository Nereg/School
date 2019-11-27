@extends('models.MailModel')
@section('Title')
Востановление пароля    
@endsection
@section('content')
<h1 class="text-center header">Привет, {{$name}}!</h1>

<a href="{{url('/')}}/restore/{{$Id}}/{{$code}}" class="text-center">Востановить пароль</a>
@endsection