<?php

use Illuminate\Database\Seeder;

class ConversationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Article::class, 5)->create();
        factory(App\Reply::class, 15)->create();
    }
}
//php artisan db:seed --class=ConversationsSeeder
