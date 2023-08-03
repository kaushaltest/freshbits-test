<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\Email;
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


Route::view('/', 'user');
Route::get('/getuser', [User::class, "getUser"]);
Route::post('/adduser', [User::class, "addUser"]);
Route::put('/edituser', [User::class, "editUser"]);
Route::delete('/deleteuser', [User::class, "deleteUser"]);
Route::post('/import',[User::class,'import']);

Route::view('/emailtemplate', 'emailtemplate');
Route::get('/getemailtemplate', [Email::class, "getEmailTemplate"]);
Route::post('/addemailtemplate', [Email::class, "addEmailTemplate"]);
Route::put('/editemailtemplate', [Email::class, "editEmailTemplate"]);
Route::delete('/deleteemailtemplate', [Email::class, "deleteEmailTemplate"]);

Route::view('/emailsend', 'emailsend');
Route::post('/sendemail', [Email::class, "sendEmail"]);