@extends('layouts.app')
@section('content')
  <div class="container">
    <h2>REVIEWS</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Descrizione</th>
          <th scope="col">Voto</th>
        </tr>
      </thead>
      <tbody>
        @foreach (Auth::user()->reviews as $key=>$review)
            
        
        <tr>
          <th scope="row">{{$key+1}}</th>
          <td>{{$review['description']}}</td>
          <td>{{$review['vote']}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection