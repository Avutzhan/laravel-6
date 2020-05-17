<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Likeable;

    protected $guarded = [];
    //так как все методы повторялись в нескольких местах мы воткнули их в трейты и подключаем куда надо


}

//to work with many to many you have to make
//post table
//tags table
//post_tag third table

