<?php
namespace App\Scrapers;

class HiveToonScraper extends BaseScraper
{
    protected function getConfigKey(): string
    {
        return 'hivetoon';
    }

    protected function processManga($title, $image, $url)
    {
        parent::processManga($title, $image, $url);
    }

    protected function fetchAndProcessChapters($manga, $url, $isNew)
    {
        parent::fetchAndProcessChapters($manga, $url, !$manga->wasRecentlyCreated);
    }

    protected function processChapter($manga, $chapterNumber, $chapterUrl)
    {
        parent::processChapter($manga, $chapterNumber, $chapterUrl);
    }
}
