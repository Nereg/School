@extends('models.MailModel')
@section('content')
<h1>Привет, {{$name}}!</h1>

<a href="{{url('/')}}/activate/{{$Id}}/{{$code}}">Автивировать аккаунт</a>
@endsection