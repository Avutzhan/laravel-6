<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function isBest()
    {
        return $this->id === $this->articles->first()->best_reply_id;
    }
}
