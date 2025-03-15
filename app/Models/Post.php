<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function telegramUser()
    {
        return $this->belongsTo(TelegramUser::class);
    }
}
