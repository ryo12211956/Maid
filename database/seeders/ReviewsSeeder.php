<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Image;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::factory()->count(10)->create()->each(fn($review) =>
            Image::factory()->count(4)->create()->each(fn($image) => 
                $review->images()->attach($image->id)
            )
        );
    }
}
