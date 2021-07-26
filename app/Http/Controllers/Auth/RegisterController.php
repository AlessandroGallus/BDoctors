<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)



    {

        $message = [
            'name.required'=>'Questo campo è obbligatorio test',
            'name.max'=>'Ciò che hai inserito è troppo lungo',
            'email.required'=>'Questo campo è obbligatorio',
            'email.max'=>'Ciò che hai inserito è troppo lungo',
            'password.required'=>'Questo campo è obbligatorio',
            'surname.required'=>'Questo campo è obbligatorio',
            'city.required'=>'Questo campo è obbligatorio',
            'address.required'=>'Questo campo è obbligatorio',
            'date_of_birth.required'=>'Questo campo è obbligatorio',
            'CF.required'=>'Questo campo è obbligatorio',
            'CF.min'=>'Questo campo è troppo corto',
            'phone_number.required'=>'Questo campo è obbligatorio',
            'url_cv.required'=>'Questo campo è obbligatorio',
            'url_img.required'=>'Questo campo è obbligatorio',
            'specializations.required'=>'scegliere specializzazione',

        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'surname' =>['required', 'string', 'min:1', 'max:255'],
            'city' => ['required', 'string', 'min:1', 'max:255'],
            'address' =>['required', 'string', 'min:1', 'max:255'],
            'date_of_birth' =>['required'],
            'CF'=>['required', 'string', 'min:1',  'max:16'],
            'phone_number'=>['required', 'string', 'min:1', 'max:17'],
            'url_cv'=>['required'],
      // 'url_img'=>['required']
          'url_img' => 'required|mimes:png,jpeg,gif',
          'specializations' => ['required'],
        ], $message);
    }
/* aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /* dd($data); */
        $url_img = Storage::put('uploads', $data['url_img']);
        /* $url_cv = Storage::put('uploads', $data['url_cv']); */

     /*    return  */ $new_user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'city' => $data['city'],
            'address' => $data['address'],
            'date_of_birth' => $data['date_of_birth'],
            'CF' => $data['CF'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'url_img' => $url_img,
            'url_cv' => $data['url_cv'],
      // 'specializations' => $data['specializations'],
        ]);

        $new_user->specializations()->attach($data['specializations']);
        $new_user->sponsors()->attach([1=>['expiring_date'=>date('Y-m-d H:i:s')]]);

        return $new_user;
    }
}
