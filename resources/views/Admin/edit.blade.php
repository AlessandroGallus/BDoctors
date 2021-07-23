@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('user.update',Auth::user()->id)}}" method="POST" >
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value='{{old('name',$to_edit['name'])}}' name="name"  {{-- required --}}  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" value='{{old('surname',$to_edit['surname'])}}' name="surname">
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
                                <input id="city" value='{{old('city',$to_edit['city'])}}' type="text" class="form-control @error('city') is-invalid @enderror" name="city">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                            <div class="col-md-6">
                                <input id="address" value='{{old('address',$to_edit['address'])}}' type="text" class="form-control @error('address') is-invalid @enderror" name="address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('date_of_birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" value='{{old('date_of_birth',$to_edit['date_of_birth'])}}' type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth">
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="CF" class="col-md-4 col-form-label text-md-right">{{ __('CF') }}</label>

                            <div class="col-md-6">
                                <input id="CF" value='{{old('CF',$to_edit['CF'])}}' type="text" class="form-control @error('') is-invalid @enderror" name="CF">
                                @error('CF')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number"  class="col-md-4 col-form-label text-md-right">{{ __('phone_number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" value='{{old('phone_number',$to_edit['phone_number'])}}' type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url_cv" class="col-md-4 col-form-label text-md-right">{{ __('url_cv') }}</label>

                            <div class="col-md-6">
                                <input id="url_cv" type="text" class="form-control @error('url_cv') is-invalid @enderror" name="url_cv" value='{{old('url_cv',$to_edit['url_cv'])}}'>
                                @error('url_cv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url_img" class="col-md-4 col-form-label text-md-right">{{ __('url_img') }}</label>

                            <div class="col-md-6">
                                <input id="url_img" type="file" class="form-control @error('url_img') is-invalid @enderror" name="url_img" >
                                @error('url_img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            <div class="form-group row">
                                <div class="col-md-4 text-md-right">
                                    <label class="label-control " for="specializations">Specializzazione</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                    name="specializations[]" id="specializations">
                                        <option value=""> - selezionare una categoria - </option>
                                        @foreach($specializations as $spec)
                                            <option @if (old('specializations',$userspec[0]->id)== $spec->id)
                                                selected
                                            @endif
                                            value="{{ $spec->id }}">{{ $spec->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
