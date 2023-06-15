<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate {url : The URL for which to generate the sitemap}';
    protected $description = 'Generate sitemap for the website';

    public function handle()
    {
        $url = $this->argument('url');

        if (empty($url)) {
            $this->error('URL cannot be empty!');
            return;
        }

        SitemapGenerator::generate_sitemap($url);

        $this->info('Sitemap generated successfully!');
    }
}
