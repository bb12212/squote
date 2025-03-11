<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quotes = Quote::with(['lead.consumer', 'provider'])->get();

        foreach ($quotes as $quote) {
            // 70% chance of having a rating
            if (rand(1, 10) <= 7) {
                DB::table('provider_ratings')->insert([
                    'provider_id' => $quote->provider_id,
                    'consumer_id' => $quote->lead->consumer->id,
                    'quote_id' => $quote->id,
                    'rating' => rand(3, 5), // Bias towards positive ratings
                    'review' => $this->getRandomReview(),
                    'is_verified' => true,
                    'created_at' => $quote->created_at->addDays(rand(5, 30)),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Get a random review text
     */
    private function getRandomReview(): string
    {
        $reviews = [
            'Great service! The installation was done professionally and on time.',
            'Very satisfied with the work. The team was knowledgeable and efficient.',
            'Excellent communication throughout the process. Would recommend.',
            'The solar panels are working perfectly. Good value for money.',
            'Professional service from start to finish. Very happy with the results.',
            'Installation was completed ahead of schedule. Great work!',
            'The team was very helpful in explaining everything about the system.',
            'Quality work and excellent customer service.',
            'Very pleased with the installation and after-service support.',
            'The whole process was smooth and well-managed.',
        ];

        return $reviews[array_rand($reviews)];
    }
}
