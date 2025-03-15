<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class Breakfast extends Command
{
    protected string $name = "habbit_selection";
    protected string $description = "Select to see or edd habbits";

    public function handle(): void{
        $messageText = $this->getUpdate()->getMessage()->getText();

        $keyboard = $this->telegram->keyboard();
    }
}
