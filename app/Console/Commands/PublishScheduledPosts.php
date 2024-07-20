<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-scheduled-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::whereNotNull('publish_at')
                     ->where('publish_at', '<=', now())
                     ->where('published', false)
                     ->get();

        foreach ($posts as $post) {
            $post->save();
        }

        $this->info('Scheduled posts have been published.');
    }
}
