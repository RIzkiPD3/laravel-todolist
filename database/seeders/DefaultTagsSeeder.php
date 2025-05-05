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
            ['name' => 'Personal', 'is_default' => true],
            ['name' => 'Work', 'is_default' => true],
            ['name' => 'Shopping', 'is_default' => true],
            ['name' => 'Health', 'is_default' => true],
            ['name' => 'Education', 'is_default' => true],
            ['name' => 'Finance', 'is_default' => true],
        ];

        foreach ($defaultTags as $tag) {
            Tag::create($tag);
        }
    }
}
