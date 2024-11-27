<?php

use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Http\Controllers\SocialiteController;

Route::get('/', function () { return view('welcome'); });

Route::get('/test', function () {
    return view('register');
    return redirect()->away('https://t.me/sonikord_bot');
});

Route::get('/send-message', function () {
    $chatId =  '6556224081'; //'720514952'; // Replace with your chat ID
    $message = 'hello world';
    for($i = 0; $i < 50; $i++) {
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' => $message,
    ]);

    return 'Message sent to Telegram!';
});

Route::get("/get-updates", function () {
    $updates = Telegram::getUpdates();

    return $updates;
});

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);