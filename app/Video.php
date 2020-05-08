<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function parent()
    {
        return $this->morphTo('watchable');
    }

//    public function watchable()
//    {
//        return $this->morphTo();
//    }
//стандартное именование метода но если хочешь нестандартно то придется написать внутри morphTo стандарное имя
}
