<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class);
        //через юзера афилиэйшн получает посты напрямую он не может так как посты привязаны к юзеру а афилиэйшн независимая таблица
        // то есть чтобы афилиэшн получал посты через юзера нужно в контроллере делать иннер джоин
        //select `posts`.*, `users`.`affiliation_id` as `laravel_through_key` from `posts` inner join `users` on `users`.`id` = `posts`.`user_id` where `users`.`affiliation_id` = ?
        //но вместо этого
    }
}
//in tinker
//$leaning = App\Affiliation::whereName('liberal')->first();
//$leaning->posts;

