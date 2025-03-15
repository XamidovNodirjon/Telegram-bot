<?php

namespace App\Telegram\Commands;


use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class HabitSelectCommand extends Command
{

    protected string $name = 'habit to see or edd habits';

    protected string $description = 'Select to see or add habits';

    public function handle()
    {
        $messageText = $this->getUpdade()->getMessage()->getText();

        if ($messageText == 'Good Habits') {
            $keyboard = Keyboard::make()
                ->row([
                    Keyboard::button('See Good Habits'),
                    Keyboard::button('Add Good Habits'),
                ])
                ->row([
                    Keyboard::button('Back')
                ]);

            $this->replyWithMessage([
                'text' => 'You selected Good Habits. Choose an  option',
                'reply_markup' => $keyboard
            ]);
        } elseif ($messageText == 'Bad Habits') {
            $keyboard = Keyboard::make()
                ->row([
                   Keyboard::button('See Bad Habits'),
                   Keyboard::button('Add Bad Habits'),
                ])
            ->row([
                Keyboard::button('Back')
            ]);

            $this->replyWithMessage([
                'text' => 'You selected Bad Habits. Choose an  option',
                'reply_markup' => $keyboard
            ]);

        }


    }
}
