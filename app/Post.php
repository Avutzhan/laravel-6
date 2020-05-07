<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
        //если название таблицы не стандартное то вторым аргументом нужно его прописать в связях
    }
}

//to work with many to many you have to make
//post table
//tags table
//post_tag third table

