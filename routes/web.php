<?php

use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
// use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/send-message', function () {
//     $chatId =  '917829891'; //'720514952'; // Replace with your chat ID
//     $message = 'مرحبا كيفك احسان';

//     Telegram::sendMessage([
//         'chat_id' => $chatId,
//         'text' => $message,
//     ]);

//     return 'Message sent to Telegram!';
// });

// Route::get("/get-updates", function () {
//     $updates = Telegram::getUpdates();

//     return $updates;
// });

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);