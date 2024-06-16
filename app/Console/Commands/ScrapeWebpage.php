<?php

namespace App\Console\Commands;

use App\Models\Chapter;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Manga;
use App\Models\Link;

class ScrapeWebpage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:webpage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape a webpage and save manga data to the database';


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client();

        $this->info('Starting to scrape data from AsuraComic...');

        $response = $client->get('https://asuracomic.net/');
        $html = (string) $response->getBody();
        $crawler = new Crawler($html);

        $mangaNodes = $crawler->filter('.listupd .utao')->slice(0, 15);

        $mangaNodes->each(function ($node) use ($client) {
            $title = $node->filter('a.series')->attr('title');
            $image = $node->filter('a.series img')->attr('src');
            $url = $node->filter('a.series')->attr('href');

            $this->info("Processing manga: $title");

            $manga = Manga::updateOrCreate(
                ['title' => $title],
                ['image' => $image, 'url' => $url]
            );

            usleep(2000000);

            $this->info("Fetching details for manga: $title from URL: $url");

            $mangaPageResponse = $client->get($url);
            $mangaPageHtml = (string) $mangaPageResponse->getBody();
            $mangaPageCrawler = new Crawler($mangaPageHtml);

            $isMangaNew = $manga->wasRecentlyCreated;
            $chapterNodes = $mangaPageCrawler->filter('.eplister ul.clstyle li');

            $chapterNodesArray = iterator_to_array($chapterNodes->getIterator());
            $reversedChapterNodes = array_reverse($chapterNodesArray);

            if (!$isMangaNew) {
                $reversedChapterNodes = array_slice($reversedChapterNodes, 0, 5);
            }

            foreach ($reversedChapterNodes as $chapterNode) {
                $chapterNode = new Crawler($chapterNode);
                $chapterNumber = trim($chapterNode->filter('.chapternum')->text());
                $chapterLink = $chapterNode->filter('a')->attr('href');

                $this->info("Processing chapter: $chapterNumber for manga: {$manga->title}");

                $chapter = Chapter::firstOrNew(
                    ['chapter_number' => $chapterNumber, 'manga_id' => $manga->id]
                );

                if (!$chapter->exists) {
                    $chapter->save();

                    Link::updateOrCreate(
                        ['chapter_id' => $chapter->id, 'url' => $chapterLink]
                    );

                    $this->info("Saved chapter link: $chapterLink");
                } else {
                    $this->info("Chapter $chapterNumber already exists. Skipping update.");
                }

                usleep(150000);

            }
            $this->info("Finished processing manga: $title");
        });

        $this->info('Webpage data scraped and saved successfully!');
    }
}
