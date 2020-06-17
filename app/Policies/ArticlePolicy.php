<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

//    public function before(User $user)
//    {
//        //$user->isAdmin
//        //$user->roles()
//        //$user->id 36 Avutzhan
//        if ($user->id === 36) { //admin
//            return true;
//        }
//
////        return $user->id === 36; нельзя сразу делать return потому что после него не будет работать остальной код лучше запихивать его в if
//    }

    /**
     * @param User $user
     * @param Article $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
//        ddd('hello');
        return $article->user->is($user);
    }
}
