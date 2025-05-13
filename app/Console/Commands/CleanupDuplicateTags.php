<?php

namespace App\Console\Commands;

use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanupDuplicateTags extends Command
{
    protected $signature = 'tags:cleanup-duplicates';
    protected $description = 'Remove duplicate default tags';

    public function handle()
    {
        $this->info('Cleaning up duplicate default tags...');

        $defaultTags = ['Work', 'Personal', 'Urgent', 'Important', 'Low Priority'];

        foreach ($defaultTags as $tagName) {
            // Get all default tags with this name
            $tags = Tag::where('name', $tagName)
                      ->where('is_default', true)
                      ->orderBy('id')
                      ->get();

            // If there are duplicates
            if ($tags->count() > 1) {
                // Keep the first one
                $keepTag = $tags->shift();

                // Get IDs of tags to delete
                $deleteIds = $tags->pluck('id')->toArray();

                // First update any task_tag entries to use the kept tag
                foreach ($deleteIds as $deleteId) {
                    DB::table('task_tag')
                        ->where('tag_id', $deleteId)
                        ->update(['tag_id' => $keepTag->id]);
                }

                // Then delete the duplicate tags
                Tag::destroy($deleteIds);

                $this->info("Removed " . count($deleteIds) . " duplicate(s) of tag '{$tagName}'");
            }
        }

        $this->info('Cleanup completed successfully!');
    }
}
