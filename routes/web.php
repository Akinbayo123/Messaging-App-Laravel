<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingsController;

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

//Route::get('/', function () {
//return view('auth.auth');
//});
Route::get('/', [AuthController::class, 'index']);
Route::post('/index_check', [AuthController::class, 'check'])->name('check');


Route::get('/login', [AuthController::class, 'login'])->name('login_user');
Route::get('/register', [AuthController::class, 'register'])->name("register_user");
Route::post('/register_save', [AuthController::class, 'register_save'])->name('register.save');
Route::post('/login_otp', [AuthController::class, 'userLogin'])->name('userLogin');
Route::get('/verification/{id}', [AuthController::class, 'verification']);
Route::post('/verified', [AuthController::class, 'verifiedOtp'])->name('verifiedOtp');
Route::get('/resend-otp/{email}', [AuthController::class, 'resendOtp'])->name('resendOtp');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::controller(MessageController::class)->middleware('auth')->group(function () {
    Route::get('/dashboard', 'loadDashboard')->name('dashboard');
    Route::get('/message_view/{id}', 'message_view')->name('message.view');
    Route::post('/send_msg/{id}', 'send_msg')->name('send_msg');
    Route::get('/chat_new', 'chat_new')->name('chat_new');
    Route::post('/update_chat', 'update_chat')->name('update_message');
    Route::post('/delete_chat/{id}', 'delete_chat')->name('message.delete');
});


Route::controller(SettingsController::class)->middleware('auth')->group(function () {
    
Route::get('/settings', 'settings')->name('settings');
Route::get('/account', 'account')->name('account');
Route::post('/update_profile', 'update_profile')->name('update_profile');
Route::get('/friend_profile/{user}', 'friend_profile')->name('friend_profile');
});
