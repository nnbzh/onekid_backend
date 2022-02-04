<?php

namespace Database\Seeders;

use App\Helpers\SubscriptionType;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subs = [
            [
                'name' => 'Yearly Subscription 7',
                'slug' => 'yearly_subscription_7',
                'visits_per_week' => 7,
                'price' => 230000,
                'type'  => SubscriptionType::YEARLY
            ],
            [
                'name' => 'Yearly Subscription 6',
                'slug' => 'yearly_subscription_6',
                'visits_per_week' => 6,
                'price' => 210000,
                'type'  => SubscriptionType::YEARLY
            ],
            [
                'name' => 'Monthly Subscription (4 visits/week)',
                'slug' => 'monthly_subscription_4',
                'visits_per_week' => 4,
                'price' => 40000,
                'type'  => SubscriptionType::MONTHLY
            ],
            [
                'name' => 'Monthly Subscription (3 visits/week)',
                'slug' => 'monthly_subscription_3',
                'visits_per_week' => 3,
                'price' => 27000,
                'type'  => SubscriptionType::MONTHLY
            ],
        ];

        foreach ($subs as $sub) {
            Subscription::query()->updateOrCreate(['slug' => $sub['slug']], $sub);
        }
    }
}
