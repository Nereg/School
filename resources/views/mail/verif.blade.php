@extends('models.MailModel')
@section('content')
<h1 class="text-center header">Привет, {{$name}}!</h1>

<a href="{{url('/')}}/activate/{{$Id}}/{{$code}}">Автивировать аккаунт</a>
@endsection