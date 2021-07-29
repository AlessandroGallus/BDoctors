<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guest.index');
});

Auth::routes();


Route::get('/dashboard', 'HomeController@index')->name('home');
/* Route::delete('/dashboard/{user}','Admin\UserController@destroy')->middleware('auth')->name('user.destroy'); */
Route::namespace('Admin')
    ->middleware('auth')
    ->group(function(){
        Route::resource('/user','UserController');
        Route::resource('/dashboard/messages','MessageController');
    });

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/dashboard/messages', 'HomeController@messages')->name('messages');
Route::get('/dashboard/reviews', 'HomeController@reviews')->name('messages');


Route::get('/dashboard/payment',  function(){
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.enviroment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);
    $token = $gateway->ClientToken()->generate();
    return view('Admin.payment', [
        'token'=>$token
    ]);
})->name('payment');

Route::post('/checkout', function (Request $request) {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.enviroment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);
    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        $transaction = $result->transaction;
        /* header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id); */
        if($transaction->amount == '2.99'){
            $user = User::find(Auth::user()->id);
            $user->sponsors()->sync([2=>['expiring_date'=>date('Y-m-d', strtotime('tomorrow'))]]);
        }
        if($transaction->amount == '5.99'){
            $user = User::find(Auth::user()->id);
            $user->sponsors()->sync([3=>['expiring_date'=>date('Y-m-d', strtotime('+3 day'))]]);
        }
        if($transaction->amount == '9.99'){
            $user = User::find(Auth::user()->id);
            $user->sponsors()->sync([4=>['expiring_date'=>date('Y-m-d', strtotime('+6 day'))]]);
        }
        return redirect()->back()->with('success_message','Transaction Successful. The Id is    ' .$transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        return redirect()->back()->withErrors('Errore:' .$result->message);
    }
});



Route::delete('/dashboard/{user}','Admin\UserController@destroy')->middleware('auth')->name('user.destroy');
Route::get('{any?}', 'PageController@index')->where('any','.*');
