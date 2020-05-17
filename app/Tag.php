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

