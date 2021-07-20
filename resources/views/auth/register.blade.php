@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  {{-- required --}}  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" {{-- required --}} autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" {{-- required --}} autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname">
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('city') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('date_of_birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control" name="date_of_birth">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="CF" class="col-md-4 col-form-label text-md-right">{{ __('CF') }}</label>

                            <div class="col-md-6">
                                <input id="CF" type="text" class="form-control" name="CF">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('phone_number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url_cv" class="col-md-4 col-form-label text-md-right">{{ __('url_cv') }}</label>

                            <div class="col-md-6">
                                <input id="url_cv" type="file" class="form-control" name="url_cv">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url_img" class="col-md-4 col-form-label text-md-right">{{ __('url_img') }}</label>

                            <div class="col-md-6">
                                <input id="url_img" type="file" class="form-control" name="url_img" accept="application/pdf,application/vnd.ms-excel">
                            </div>
                        </div>


                            {{-- <div class="checkbox_container">
                                @foreach ($specializations as $spec)
                                    <input type="checkbox"
                                            name="specializations[]"
                                            value="{{ $spec->id }}"
                                            id="{{ $spec->name }}"
                                            >
                                    <label for="{{ $spec->name }}">{{ $spec->name }}</label>
                                @endforeach
                            </div> --}}


                            
                            @for ($i=0;$i<3;$i++)
                            <div class="form-group row">
                                <div class="col-md-4 text-md-right">
                                    <label class="label-control " for="specializations">Specializzazione</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                    name="specializations[]" id="soecializations">
                                        <option value=""> - selezionare una categoria - </option>
                                        @foreach($specializations as $spec)
                                            <option
                                            value="{{ $spec->id }}">{{ $spec->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endfor
                            
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#ciao').click(function(){
        console.log('test');
    })
</script>
@endsection
