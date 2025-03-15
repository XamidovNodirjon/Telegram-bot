<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\TelegramUser;

Route::post('/telegram/webhook', function (Request $request) {
    try {
        $update = Telegram::getWebhookUpdate();
        $message = $update->getMessage();
        $chatId = $message->getChat()->getId();
        $username = $message->getChat()->getUsername();
        $firstName = $message->getChat()->getFirstName();
        $lastName = $message->getChat()->getLastName();

        TelegramUser::firstOrCreate(
            ['chat_id' => $chatId],
            [
                'username' => $username,
                'first_name' => $firstName,
                'last_name' => $lastName
            ]
        );

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Salom, {$firstName}! Xush kelibsiz!",
        ]);
    } catch (\Exception $e) {
        Log::error('Telegram webhook xatosi', ['message' => $e->getMessage()]);
        return response('error', 200);
    }
});
