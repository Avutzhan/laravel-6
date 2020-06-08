<?php

namespace App\Listeners;

use App\Events\ProductPurschased;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AwardAchievements
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductPurschased  $event
     * @return void
     */
    public function handle(ProductPurschased $event)
    {
        var_dump('check for new achievement');
    }
}
