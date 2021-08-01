@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<header></header>
<div class="container">
    <div class="row ">
        <h1>DASHBOARD: <span>{{Auth::user()->name}} {{Auth::user()->surname}}</span></h1>
        <div class="col-md-8 d-flex justify-content-between">
            
            <div class="infos">
                
                <h3>Indirizzo: {{ Auth::user()->address }}</h3>
                <h3>Città: {{ Auth::user()->city }}</h3>
                <h3>Codice Fiscale: {{ Auth::user()->CF }}</h3>
                <h3>Data di Nascita: {{ Auth::user()->date_of_birth }}</h3>
                <h3>Numero Telefono: {{ Auth::user()->phone_number }}</h3>
                @if (Auth::user()->visit_types)
                    <h3>Prestazioni: </h3>
                    <p>{{Auth::user()->visit_types}}</p>
                @endif
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
            <button  style=" height:55px " class="btn btn-danger" id="click">Delete test</button>
            <div id="delete" style="position: absolute; background-color:white ;  left:50%"></div>
            {{-- <form action="{{route('user.destroy',Auth::user()->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">DELETE</button>
            </form> --}}
            
            <a href="{{route('user.edit',Auth::user()->id)}}">EDIT</a>
            


            <span>
      {{--           {{ Auth::user()->specializations['name'] }} --}}
            </span>
            {{-- {{ dd(Auth::user()->specializations()) }}) --}}
        </div>
        
    </div>
    <hr>
    <a href="/dashboard/messages">See Messages</a><br>
    <a href="{{route('reviews.index')}}">See Reviews</a>      
    <a href="/dashboard/sponsors">Sponsor yourself</a>      
</div>
<script>
    $(document).ready(function(){
         let index =1;
        $('#click').click(function(){
            $('#delete').append(`<div id='confirm-delete' style="padding: 10px 15px;border:1px solid red;border-radius:5px">
            <h2>Are you sure you want to delete your profile?</h2>
            <form action="{{route('user.destroy',Auth::user()->id)}}" class="text-center d-inline" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">YES</button>
            </form> <button id="close" class="btn btn-danger text-center" >NO</button>
            </div>`)
        })
        $(document).delegate("#close",'click',function(){
            console.log('chiusura');
            $('#confirm-delete').remove()
        })
    })
 </script>
@endsection
