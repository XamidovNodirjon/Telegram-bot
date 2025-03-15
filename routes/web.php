<?php

use Illuminate\Support\Facades\Route;
use \Telegram\Bot\Laravel\Facades\Telegram;
use \Filament\Facades\Filament;

Route::get('/', function () {
    return view('welcome');
});

Route::get('setwebhook', function () {
    $response = Telegram::setWebhook(['url' => 'https://3bed-81-95-228-219.ngrok-free.app/api/telegram/webhook']);
});

Route::get('/test/admin', function () {
    return redirect(Filament::getUrl());
});
