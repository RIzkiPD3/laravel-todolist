<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class DefaultTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultTags = [
            'Work',
            'Personal',
            'Urgent',
            'Important',
            'Low Priority',
        ];

        foreach ($defaultTags as $tagName) {
            // Only create the tag if it doesn't already exist
            Tag::firstOrCreate(
                ['name' => $tagName, 'is_default' => true],
                ['user_id' => null]
            );
        }
    }
}
