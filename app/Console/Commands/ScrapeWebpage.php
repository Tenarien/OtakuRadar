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

        $response = $client->get('https://asuracomic.net/');
        $html = (string) $response->getBody();
        $crawler = new Crawler($html);


        $crawler->filter('.listupd .utao')->each(function ($node) use ($client) {
            $title = $node->filter('a.series')->attr('title');
            $image = $node->filter('a.series img')->attr('src');
            $url = $node->filter('a.series')->attr('href');


            $manga = Manga::updateOrCreate(
                ['title' => $title],
                ['image' => $image, 'url' => $url]
            );

            usleep(500000);

            $mangaPageResponse = $client->get($url);
            $mangaPageHtml = (string) $mangaPageResponse->getBody();
            $mangaPageCrawler = new Crawler($mangaPageHtml);


            $mangaPageCrawler->filter('.eplister ul.clstyle li')->each(function ($chapterNode) use ($manga) {
                $chapterNumber = trim($chapterNode->filter('.chapternum')->text());
                $chapterLink = $chapterNode->filter('a')->attr('href');


                $chapter = Chapter::updateOrCreate(
                    ['chapter_number' => $chapterNumber, 'manga_id' => $manga->id]
                );


                Link::updateOrCreate(
                    ['chapter_id' => $chapter->id, 'url' => $chapterLink]
                );

                usleep(200000);
            });
        });

        $this->info('Webpage data scraped and saved successfully!');
    }
}
