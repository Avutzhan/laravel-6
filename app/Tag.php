<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        //many to many
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}

//this is used just by many to many
//$post->tags()->detach(2);
//$post->tags()->attach(2);
//$post->tags()->attach([1,2]);

//$tag = App\Tag::first();
//=> App\Tag {#3028
//    id: 1,
//     name: "person",
//     created_at: null,
//     updated_at: null,
//   }
//>>> $post->tags()->attach($tag); //you can add collection
//=> null
//>>>

//actually in pivot tables you dont need timestamps so dont add them if you want to use them then add to models
//when you run this command many times it runs but we must run it one time
//$tag->posts()->attach(2);
//to restrict this we must add to migration
//$table->primary(['post_id', 'tag_id']);
//onDelete('cascade'); delete other by cascade if deleted first model
//in tinker
//$tags->first(function ($tag) { return strlen($tag->name) > 5; });
//collect(['one','two','three']);
//collect(['one','two','three'])->first();
//collect(['one','two','three', ['rrr', 'rrr']])->flatten();
//$items = collect([1,2,3,4,5,6,7]);
//$items->filter(function ($item) { return $item >= 5; });
//$filtered = $items->filter(function ($item) { return $item >= 5; });
//$items->filter(function ($item) { return $item % 2 === 0; });
//$items->filter(function ($item) { return $item % 2 === 0; })->map(function ($item) { return $item + 5; });
//$articles->pluck('tags')->collapse()->pluck('name');
// тема урока в том что мы можем манипулировать окллекциями как нам удобно создавая цепочки из методово
// Пора переходить на уровень выше с использованием кода нужно вместо самописных велосипедов переходить на функции высшего порядка и строенные методы языка и фреймворка нужна практика пес повтори фрикодкамп
//$test->unique();
// $articles->pluck('tags.*.name'); выводим данные со связи тагс у артикля
//collect(['one', 'one', 'two', 'two'])->unique()->map(function ($item) { return ucwords($item); });
//ucwords upper case words
