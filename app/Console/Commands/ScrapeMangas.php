<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scrapers\ScrapperDispatcher;

class ScrapeMangas extends Command
{
    protected $signature = 'scrape:mangas {source}';
    protected $description = 'Scrape mangas from the specified source';

    public function handle()
    {
        $source = $this->argument('source');

        try {
            $dispatcher = new ScrapperDispatcher();
            $dispatcher->run($source);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        $this->info('Scraping completed successfully!');
    }
}
