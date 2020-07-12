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

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    //if you want to grab all roles of user like this #user->roles
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    //if you want to assign role to user you must do this
    //$user->roles()->save($role);
    //but we can do more practical and convenient
    //$user->assignRole();
    //
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }
        $this->roles()->sync($role, false);
        //there was save but this create an error with dublicate records
        //to avoid dublicate error you can add sync
        //so records will replace with new one and old will be dropped
        //if you dont want to drop records just add false
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();

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

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function routeNotificationForNexmo($notification)
    {
        return '';
    }
}

//if you want to grab abilities throgh user do this
//$user->roles->map->abilities;
//$user->roles->map->abilities->flatten();
//$user->roles->map->abilities->flatten()->pluck('name');
//$user->roles->map->abilities->flatten()->pluck('name')->unique();
