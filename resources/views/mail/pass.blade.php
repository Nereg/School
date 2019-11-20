@extends('models.MailModel')
@section('Title')
Востановление пароля    
@endsection
@section('content')
<h1>Привет, {{$name}}!</h1>

<a href="{{url('/')}}/restore/{{$Id}}/{{$code}}">Востановить пароль</a>
@endsection