<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductPurschased
{
    use Dispatchable, SerializesModels;

    public $name;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

}


//php artisan event:list
//php artisan make:event ProductPurschased
//php artisan make:listener AwardAchievements
//php artisan make:listener AwardAchievements -e ProductPurschased
//php artisan make:listener SendShareableCoupon -e ProductPurschased
