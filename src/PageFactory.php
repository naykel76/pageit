<?php

namespace Naykel\Pageit;

use Illuminate\Database\Eloquent\Factories\Factory;
use Naykel\Pageit\Models\Page;

// This factory is in the src directory of the package because it throws a psr-4
// error if you put it in the database/factories directory. This seems to be an
// unsolvable issue and AI is useless!

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'layout' => 'default',
        ];
    }
}
