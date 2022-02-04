<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->updateOrCreate(['email' => 'admin@admin.com'], ['password' => 'admin']);
        $this->call([
            SubscriptionSeeder::class,
            ClassEntitySeeder::class
        ]);
    }
}
