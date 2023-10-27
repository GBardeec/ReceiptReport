<?php

namespace Database\Factories;

use App\Models\Cheque;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ChequeFactory extends Factory
{
    public function definition()
    {
        $startDate = Carbon::create(2019, 11, 1, 8, 0, 0);
        $endDate = Carbon::create(2020, 1, 31, 23, 0, 0);

        $minChequesPerDay = 50;
        $maxChequesPerDay = 100;

        $shops = Shop::all();

        while ($startDate <= $endDate) {
            foreach ($shops as $shop) {
                $timezone = $shop->timezone;

                $numberOfCheques = $this->faker->numberBetween($minChequesPerDay, $maxChequesPerDay);

                for ($i = 0; $i < $numberOfCheques; $i++) {
                    $sum = $this->faker->numberBetween(90, 400);

                    $randomHour = $this->faker->numberBetween(8, 23);
                    $randomMinute = $this->faker->numberBetween(0, 59);

                    $checkDateTime = $startDate->copy()->setHour($randomHour)->setMinute($randomMinute);

                    Cheque::create([
                        'shop_id' => $shop->id,
                        'check_datetime' => $checkDateTime->format('Y-m-d H:i:s'),
                        'sum' => $sum,
                    ]);
                }
            }

            $startDate->addDay();
        }
    }
}
