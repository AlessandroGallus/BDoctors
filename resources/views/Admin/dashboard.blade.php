@extends('layouts.app')

@section('content')
<header></header>
<div class="container">
    <div class="row justify-content-center">
        <h1>DASHBOARD: <span>{{Auth::user()->name}} {{Auth::user()->surname}}</span></h1>
        <div class="col-md-8 d-flex justify-content-between">
            
            <div class="infos">
                
                <h3>Indirizzo: {{ Auth::user()->address }}</h3>
                <h3>Città: {{ Auth::user()->city }}</h3>
                <h3>Codice Fiscale: {{ Auth::user()->CF }}</h3>
                <h3>Data di Nascita: {{ Auth::user()->date_of_birth }}</h3>
                <h3>Numero Telefono: {{ Auth::user()->phone_number }}</h3>
                <div>
                    <h3>Specializzazioni:</h3>
                    @foreach (Auth::user()->specializations as $spec)
                        <span>{{$spec->name}}, </span>
                    @endforeach
                    <h3>Livello:</h3>
                    {{Auth::user()->sponsors[0]->name}}
                    
                </div>
            </div>
            
            <div class="profile-image">
                <img src="{{ asset('storage/'.Auth::user()->url_img) }}" alt="">
            </div>
            {{-- <img src="{{ asset('storage/'.Auth::user()->url_cv) }}" alt=""> --}}

            <form action="{{route('user.destroy',Auth::user()->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">DELETE</button>
            </form>
            <a href="#">See Messages</a>
            <a href="{{route('user.edit',Auth::user()->id)}}">EDIT</a>
            


            <span>
      {{--           {{ Auth::user()->specializations['name'] }} --}}
            </span>
            {{-- {{ dd(Auth::user()->specializations()) }}) --}}
        </div>
    </div>
</div>
@endsection
