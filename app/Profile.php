<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function post()
    {
        return $this->belongsTo(User::class);
    }
}
// test sql query
//DB::listen(function($sql){var_dump($sql->sql, $sql->bindings);});
//DB::enableQueryLog();
//DB::getQueryLog();
