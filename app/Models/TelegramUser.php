<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    protected $table = 'telegram_users';
    protected $fillable = [
        'chat_id',
        'username',
        'first_name',
        'last_name',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }
}
