@extends('layouts.app')
@section('content')
  <h1>SPONSORS</h1>
  <a href="{{route('payment',['value'=>'silver'])}}">silver</a>
  <a href="{{route('payment',['value'=>'gold'])}}">gold</a>
  <a href="{{route('payment',['value'=>'platinum'])}}">platinum</a>

@endsection