<?php

namespace Database\Seeders;

use App\Models\ClassTemplate;
use Illuminate\Database\Seeder;

class ClassEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $availableTimes = [
            [
                'start' => '08:00:00',
                'end' => '10:00:00',
            ],
            [
                'start' => '10:00:00',
                'end' => '12:00:00',
            ],
            [
                'start' => '12:00:00',
                'end' => '14:00:00',
            ],
            [
                'start' => '14:00:00',
                'end' => '16:00:00',
            ],
            [
                'start' => '16:00:00',
                'end' => '18:00:00',
            ],
            [
                'start' => '18:00:00',
                'end' => '20:00:00',
            ],
        ];

        $templates = ClassTemplate::query()->get();

        foreach ($templates as $template) {
            for ($i = 1; $i <= 7; $i++) {
                foreach ($availableTimes as $availableTime) {
                    $template->entities()->create([
                        'weekday'       => $i,
                        'start_time'    => $availableTime['start'],
                        'finish_time'   => $availableTime['end'],
                        'places_available' => 5,
                    ]);
                }
            }
        }
    }
}
