<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Good>
 */
class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->firstName(),
            'creation_date' => $this->randomDate('2022-06-06', '2023-06-06'),
            'expiration_date'=> $this->randomDate('2023-06-06', '2024-06-06'),
            'price'=>random_int(50, 500),
            'img_link'=>'img'
        ];
    }
    function randomDate($sStartDate, $sEndDate, $sFormat = 'Y-m-d')
    {
        // Convert the supplied date to timestamp
        $fMin = strtotime($sStartDate);
        $fMax = strtotime($sEndDate);

        // Generate a random number from the start and end dates
        $fVal = mt_rand($fMin, $fMax);

        // Convert back to the specified date format
        return date($sFormat, $fVal);
    }
}
