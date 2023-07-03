<?php

namespace App\Events;

use App\Services\SitemapGenerator;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GenerateSitemap
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The URL for sitemap generation.
     *
     * @var string
     */
    public $url;

    /**
     * Create a new event instance.
     *
     * @param  string  $url
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function handle()
    {
        // Logic to generate the sitemap
        // This can include retrieving data, generating the sitemap file, etc.
        SitemapGenerator::generate_sitemap($this->url);
    }
}
