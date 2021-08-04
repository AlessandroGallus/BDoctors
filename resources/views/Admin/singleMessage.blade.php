@extends('layouts.app')
@section('content')
  <div class="container single-message clearfix">
    <h2>DETTAGLIO MESSAGGIO:</h2>
    <div class="left">
      <h3>Telefono:</h3>
      <h4>{{$message['phone_number']}}</h4>
      <h3>Email: </h3>
      <h4>{{$message['mail']}}</h4>
    </div>
    <div class="right">
      <h4 class="messaggio">{{$message['message_text']}}</h4>
      <a href="https://mail.google.com/"><button class="btn btn-primary">Rispondi</button></a>
    </div>
  </div>
@endsection

