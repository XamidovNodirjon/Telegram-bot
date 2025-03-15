<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\TelegramUser;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start interacting with the bot';

    public function handle()
    {
        $update = $this->getUpdate();
        $message = $update->getMessage();

        if (!$message) {
            $this->replyWithMessage([
                'text' => "Xatolik yuz berdi! Iltimos, botni qayta ishga tushiring."
            ]);
            return;
        }

        $chatId = $message->getChat()->getId();
        $username = $message->getChat()->getUsername();
        $firstName = $message->getChat()->getFirstName();
        $lastName = $message->getChat()->getLastName();

        // Foydalanuvchini tekshirish va qo‘shish
        TelegramUser::firstOrCreate(
            ['chat_id' => $chatId],
            [
                'username' => $username,
                'first_name' => $firstName,
                'last_name' => $lastName
            ]
        );

        // 🔹 Katta keyboard tugmalarni yaratish
        $keyboard = Keyboard::make()
            ->row([Keyboard::button('Bugun nima pishiramiz ?')])
            ->row([Keyboard::button('🍳 Nonushta uchun'), Keyboard::button('Bolalar uchun')])
            ->row([Keyboard::button('Milliy taomlar'), Keyboard::button('Dunyo taomlari')])
            ->row([Keyboard::button('Turk taomlar'), Keyboard::button('Xamirli ovqatlar')])
            ->row([Keyboard::button("Mazali do'lmalar"), Keyboard::button('Somsalar')])
            ->row([Keyboard::button('Salatlar'), Keyboard::button('Fast food')])
            ->row([Keyboard::button('Konserva yopish'), Keyboard::button('Salqin ichimliklar')])
            ->row([Keyboard::button('Tortlar, desertlar'), Keyboard::button("Karving o'rganamiz")])
            ->row([Keyboard::button('Sabzavotlardan taomlar')])
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(false); // 🔹 Bu muhim!

        // 🔹 Xabar va klaviaturani foydalanuvchiga jo‘natish
        $this->replyWithMessage([
            'chat_id' => $chatId, // 🔹 Telegram bot chat ID
            'text' => "Salom, {$firstName}! Kategoriyalardan birini tanlang:",
            'reply_markup' => $keyboard
        ]);
    }

}
