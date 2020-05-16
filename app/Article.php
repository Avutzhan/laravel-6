<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
//    protected $fillable = ['title', 'excerpt', 'body']; reverse of this
    protected $guarded = [];

    public function path()
    {
        return route('articles.show', $this);
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
//    это стандартный кейс если имя метода юсер то ларка ищет атоматом юсер_айди
//    а если название автор то ларка ищет автор_айди но так как мы работаем с юсерами и имеем юсер_айди
//    то надо писать вторым аргументом что мы имеем ввиду ларка не поймет

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
