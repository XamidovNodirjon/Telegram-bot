<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public function handle(Request $request)
    {

        try {
            $update = Telegram::getWebhookUpdate();
            $chatId = $request['message']['chat']['id'];
            $messageText = $update->getMessage()->getText();

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "Test tugmalari",
                'reply_markup' => json_encode([
                    'keyboard' => [
                        [['text' => 'Tugma 1'], ['text' => 'Tugma 2']],
                        [['text' => 'Tugma 3'], ['text' => 'Tugma 4']],
                    ],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => false
                ])
            ]);


        } catch (\Exception $e) {
            Log::error('exe', ['message' => $e->getMessage()]);
            return response('error', 200);
        }

    }
}
