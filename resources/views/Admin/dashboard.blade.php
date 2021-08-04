@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <header></header>
    <div class="container">

        <h1><b>DASHBOARD</b> <span>{{ Auth::user()->name }} {{ Auth::user()->surname }}</span></h1><br>

        <div class="profile-container ">
            <div class="profile-image">
                <img src="{{ asset('storage/' . Auth::user()->url_img) }}" alt="">
                @if (substr(Auth::user()->url_img,0,4)==='http')
                <img src="{{ Auth::user()->url_img }}" alt="">
                @endif
               
            </div>
            <hr class="border-hr">

            <div class="infos">

                <h3><b>Indirizzo:</b> {{ Auth::user()->address }}</h3>
                <h3><b>Città:</b> {{ Auth::user()->city }}</h3>
                <h3><b>Codice Fiscale:</b> {{ Auth::user()->CF }}</h3>
                <h3><b>Data di Nascita:</b> {{ Auth::user()->date_of_birth }}</h3>
                <h3><b>Numero Telefono:</b> {{ Auth::user()->phone_number }}</h3>
                @if (Auth::user()->visit_types)
                    <h3><b>Prestazioni:</b> </h3>
                    <p>{{ Auth::user()->visit_types }}</p>
                @endif
                <div>
                    <h3><b>Specializzazione/i:</b></h3>
                    @foreach (Auth::user()->specializations as $spec)
                        <span>{{ $spec->name }}, </span>
                    @endforeach
                    <h3><b>Livello:</b></h3>
                    {{ ucwords(Auth::user()->sponsors[0]->name) }}
                    <h3><b>Scadenza:</b></h3>
                    {{ Auth::user()->sponsors[0]['pivot']['expiring_date'] }}

                </div>
                <hr>
                
                <button style=" height:55px " class="btn btn-danger" id="click">CANCELLA</button>
                <div id="delete" style="position: absolute; background-color:white ;  left:50%"></div>
                <a href="{{ route('user.edit', Auth::user()->id) }}"><button class="btn btn-secondary"
                        style=" height:55px ">MODIFICA</button></a>
            </div>

            {{-- <div class="profile-image">
                <img src="{{ asset('storage/' . Auth::user()->url_img) }}" alt="">
                <img src="{{ Auth::user()->url_img }}" alt="">
            </div> --}}
        </div>


        <hr>

        <a href="/dashboard/messages">Visualizza Messaggi</a><br>
        <a href="{{ route('reviews.index') }}">Visualizza Recensioni</a><br>
        <a href="/dashboard/sponsors">Mettiti in evidenza, scegli il tuo sponsor!!</a>

    </div>
    <script>
        $(document).ready(function() {
            let index = 1;
            $('#click').click(function() {
                $('#delete').append(`<div id='confirm-delete' style="padding: 10px 15px;border:1px solid red;border-radius:5px">
            <h2>Are you sure you want to delete your profile?</h2>
            <form action="{{ route('user.destroy', Auth::user()->id) }}" class="text-center d-inline" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">YES</button>
            </form> <button id="close" class="btn btn-danger text-center" >NO</button>
            </div>`)
            })
            $(document).delegate("#close", 'click', function() {
                console.log('chiusura');
                $('#confirm-delete').remove()
            })
        })
    </script>
    <style>
        img {
            height: 300px;
        }

    </style>
@endsection
