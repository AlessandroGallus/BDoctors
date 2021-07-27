@extends('layouts.app')
@section('content')
  <div class="container">
    <h2>DETTAGLIO MESSAGGIO:</h2>
    <h2>> Email: </h2>
    <h4>{{$message['mail']}}</h4>
    <h2>> Messaggio:</h2>
    <h4>{{$message['message_text']}}</h4>
    <h2>> Telefono:</h2>
    <h4>{{$message['phone_number']}}</h4>
  </div>
@endsection