<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    public function abilities()
    {
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }

    //if you want to add ability to role
    public function allowTo($ability)
    {
        if (is_string($ability)) {
            $ability = Ability::whereName($ability)->firstOrFail();
        }

        $this->abilities()->sync($ability, false);
    }
}

//role->ability assosiated
//moderator->can write
// on tinker
//$user = App\User::find(1);
//$moderator = App\Role::firstOrCreate(['name' => 'moderator']);
//$user->assignRole($moderator);

//$manager = App\Role::firstOrCreate(['name' => 'manager']);
//$reports = App\Ability::firstOrCreate(['name' => 'view_reports']);
//$user->assignRole($reports);
//$manager->allowTo($reports); dont forget to allow
