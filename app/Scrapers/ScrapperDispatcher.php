<?php
namespace App\Scrapers;

class ScrapperDispatcher
{
    protected $scrapers = [
        'asuracomic' => AsuraComicScraper::class,
        'hivetoon' => HiveToonScraper::class,
    ];

    public function run($source)
    {
        if (!isset($this->scrapers[$source])) {
            throw new \Exception("Scraper for source $source not found.");
        }

        $scraperClass = $this->scrapers[$source];
        $scraper = new $scraperClass();
        $scraper->scrape();
    }
}
