<?php

use App\Http\Controllers\AramexController;
use App\Http\Controllers\AramexCredentialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::get('lang/{lang}', function ($lang) {
    App::setLocale($lang);
    session()->put('locale', $lang);
    return Redirect::back();
})->name('lang.switch');

Route::get('/aramex', function () {
    return view('home');
});

Route::get('/aramex/scheduleDelivery', [AramexController::class, 'scheduleDelivery']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/login', [UserController::class, 'login_page'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);
Route::get('/register', [UserController::class, 'create']);
Route::get('logout', [UserController::class, 'logout']);

Route::get('/aramex/shipments/create', [AramexController::class, 'createShipment']);
Route::post('/aramex/shipments/store', [AramexController::class, 'storeShipment']);

Route::get('/aramex/shipments', [AramexController::class, 'shipments']);
Route::post('/aramex/shipments/track', [AramexController::class, 'trackShipments']);
Route::get('/aramex/shipments/trackingResults', [AramexController::class, 'shipmentTrackResult']);
Route::get('/aramex/shipments/{id}', [AramexController::class, 'index']);

Route::get('/aramex/pickups/create/{id}', [AramexController::class, 'createPickup']);
Route::post('/aramex/pickups/store', [AramexController::class, 'storePickup']);
Route::get('/aramex/pickups', [AramexController::class, 'pickups']);
Route::get('/aramex/pickups/{id}', [AramexController::class, 'pickup']);
Route::delete('/aramex/pickups', [AramexController::class, 'cancelPickup']);
Route::post('/aramex/pickups/track', [AramexController::class, 'trackPick']);

Route::get('/aramex/rate', [AramexController::class, 'createRate']);
Route::post('/aramex/calculateRate', [AramexController::class, 'calculateRate']);

Route::get('/aramex/label', [AramexController::class, 'createLabel']);
Route::post('/aramex/printLabel', [AramexController::class, 'printLabel']);

Route::get('/aramex/reserveRange', function () {
    return view('reserveRange');
});
Route::post('/aramex/reserveRange', [AramexController::class, 'reserveRange']);

Route::get('/aramex/credentials/create/{id}', [AramexCredentialController::class, 'createCredential']);
Route::post('/aramex/credentials/store', [AramexCredentialController::class, 'storeCredential']);
Route::get('/aramex/credentials/{id}', [AramexCredentialController::class, 'credentialIndex']);
Route::get('/aramex/credentials/edit/{id}', [AramexCredentialController::class, 'credentialEdit']);
Route::put('/aramex/credentials/update', [AramexCredentialController::class, 'credentialUpdate']);
