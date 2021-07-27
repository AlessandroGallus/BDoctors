@extends('layouts.app')
@section('content')
  <div class="container">
    <h2>MESSAGGI:</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Mail</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach (Auth::user()->messages as $key=>$message)
            
        
        <tr>
          <th scope="row">{{$key}}</th>
          <td>{{$message['mail']}}</td>
          <td><a href="{{route('messages.show',$message['id'])}}"><button class="btn btn-primary">VIEW</button></a> <form class="d-inline" action="{{route('messages.destroy',$message['id'])}}" method="POST">@csrf @method('DELETE') <button class="btn btn-danger" type="submit">DELETE</button></form> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection