@extends('layouts.app')
@section('content')
  <h1 class="text-center mb-5">FAI UN UPGRADE DEL TUO PROFILO</h1>
  
  {{-- <a href="{{route('payment',['value'=>'gold'])}}">gold</a>
  <a href="{{route('payment',['value'=>'platinum'])}}">platinum</a> --}}

  <div class="payment-options">
    <div class="card">
        <div>SILVER <i class="silver fas fa-trophy"></i></div>
        <p>Metti il tuo profilo in evidenza rispetto agli altri utenti e raggiungi i tuoi possibili pazienti con più facilità</p>
        <hr>
        <span class="price">2.99€ / 24h</span>
        <hr>
        <a href="{{route('payment',['value'=>'silver'])}}"><button class="btn btn-primary">UPGRADE</button></a>
    </div>
    <div class="card">
      <div>GOLD <i class="gold fas fa-trophy"></i></div>
        <p>Metti il tuo profilo in evidenza rispetto agli altri utenti e raggiungi i tuoi possibili pazienti con più facilità</p>
        <hr>
        <span class="price">5.99€ / 72h</span>
        <hr>
        <a href="{{route('payment',['value'=>'gold'])}}"><button class="btn btn-primary">UPGRADE</button></a>
  </div>
  <div class="card">
    <div>PLATINUM <i class="platinum fas fa-trophy"></i></div>
        <p>Metti il tuo profilo in evidenza rispetto agli altri utenti e raggiungi i tuoi possibili pazienti con più facilità</p>
        <hr>
        <span class="price">9.99€ / 144h</span>
        <hr>
        <a href="{{route('payment',['value'=>'platinum'])}}"><button class="btn btn-primary">UPGRADE</button></a>
</div>
  </div>

@endsection