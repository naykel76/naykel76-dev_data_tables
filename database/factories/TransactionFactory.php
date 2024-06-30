<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $fastFood = [
        'vendor' => ['KFC', 'McDonalds', 'Hungry Jacks'],
        'low' => 6,
        'high' => 30
    ];

    protected $superMarkets = [
        'vendor' => ['Coles', 'Woolworths', 'Aldi'],
        'low' => 170,
        'high' => 200
    ];

    protected $petrol = [
        'vendor' => ['BP', 'Caltex', 'Shell'],
        'low' => 95,
        'high' => 120
    ];


    public function definition(): array
    {
        return [
            'created_at' => Carbon::today()->subDays(rand(180, 0)),
        ];
    }

    public function fastFood(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'description' => $this->faker->randomElement($this->fastFood['vendor']),
                'category' => 'Takeaway',
                'amount' => $this->faker->randomFloat(2, $this->fastFood['low'], $this->fastFood['high']) * 1,
            ];
        });
    }

    /**
     * $sequence->index is used to determine how many months to subtract from
     * the current date for each instance, creating a monthly sequence. Note
     * that the sequence index starts at 0, if you want to start the sequence
     * one month back from today.
     */
    public function wages(): Factory
    {
        return $this->sequence(function ($sequence) {
            return [
                'description' => 'Monthly Wage',
                'category' => 'Income',
                'amount' => $this->faker->randomFloat(2, 3000, 3400),
                'created_at' => Carbon::today()->subMonths($sequence->index),
            ];
        });
    }

    public function rates(): Factory
    {
        return $this->sequence(function ($sequence) {
            return [
                'description' => 'Brisbane City Council Rates',
                'category' => 'Utilities',
                'amount' => $this->faker->randomFloat(2, 450, 480) * 1,
                'created_at' => Carbon::today()->subMonths($sequence->index * 3),
            ];
        });
    }
    public function power(): Factory
    {
        return $this->sequence(function ($sequence) {
            return [
                'description' => 'Energex Electricity Bill',
                'category' => 'Utilities',
                'amount' => $this->faker->randomFloat(2, 500, 580) * 1,
                'created_at' => Carbon::now()->subWeeks(6)->subMonths($sequence->index * 3),
            ];
        });
    }
    public function water(): Factory
    {
        return $this->sequence(function ($sequence) {
            return [
                'description' => 'Urban Utilities Water Bill',
                'category' => 'Utilities',
                'amount' => $this->faker->randomFloat(2, 270, 300) * 1,
                'created_at' => Carbon::now()->subWeeks(6)->subMonths($sequence->index * 3),
            ];
        });
    }
    public function groceries(): Factory
    {
        return $this->sequence(function ($sequence) {
            return [
                'description' => $this->faker->randomElement($this->superMarkets['vendor']),
                'category' => 'Groceries',
                'amount' => $this->faker->randomFloat(2, $this->superMarkets['low'], $this->superMarkets['high']) * 1,
                'created_at' => Carbon::today()->subWeeks($sequence->index),
            ];
        });
    }
    public function petrol(): Factory
    {
        return $this->sequence(function ($sequence) {
            return [
                'description' => $this->faker->randomElement($this->petrol['vendor']),
                'category' => 'Petrol',
                'amount' => $this->faker->randomFloat(2, $this->petrol['low'], $this->petrol['high']) * 1,
                'created_at' => Carbon::today()->subWeeks($sequence->index),
            ];
        });
    }
}
