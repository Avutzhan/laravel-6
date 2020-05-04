<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function projects()
    {
        return $this->hasMany(Projects::class);
    }

//    public function relationships()
//    {
//        one to one
//        one to many
//        many to many
//        has many through
//        polymorphyc relations
//    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function experience()
    {
        return $this->hasOne(Experience::class);
    }
}

