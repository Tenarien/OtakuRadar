<?php
namespace App\Scrapers;

use App\Models\Chapter;
use App\Models\Link;
use App\Models\Manga;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

abstract class BaseScraper
{
    protected $client;
    protected $config;

    public function __construct()
    {
        $this->client = new Client();
    }

    abstract protected function getConfigKey(): string;

    protected function getConfig()
    {
        $key = $this->getConfigKey();
        return config("scrapers.$key");
    }

    public function scrape()
    {
        $config = $this->getConfig();
        $response = $this->client->request('GET', $config['url']);
        $crawler = new Crawler($response->getBody()->getContents());

        $mangaNodes = $crawler->filter($config['manga_list'])->slice(0, 10);

        $mangaNodes->each(function ($node) use ($config) {
            $title = $node->filter($config['manga_title'])->text();
            $image = $node->filter($config['manga_image'])->attr('src');
            $url = $node->filter($config['manga_url'])->attr('href');

            $this->processManga($title, $image, $url);
        });
    }

    protected function processManga($title, $image, $url)
    {
        $sourceWebsite = $this->getConfigKey();

        $manga = Manga::updateOrCreate(
            [
                'title' => $title,
                'source_website' => $sourceWebsite,
            ],
            [
                'image' => $image,
                'url' => $url,
            ]
        );

        usleep(2000000);

        $this->fetchAndProcessChapters($manga, $url, !$manga->wasRecentlyCreated);
    }

    protected function fetchAndProcessChapters($manga, $url, $isNew)
    {
        $response = $this->client->get($url);
        $html = (string) $response->getBody();
        $crawler = new Crawler($html);

        $config = $this->getConfig();
        $chapterNodes = $crawler->filter($config['chapter_list']);

        $chapterNodesArray = iterator_to_array($chapterNodes->getIterator());
        $chapterNodes = array_reverse($chapterNodesArray);

        if ($isNew) {
            $chapterNodes = array_slice($chapterNodesArray, 0, 5);
        }


        foreach ($chapterNodes as $chapterNode) {
            $chapterNode = new Crawler($chapterNode);
            $chapterNumber = trim($chapterNode->filter($config['chapter_number'])->text());
            $chapterUrl = $chapterNode->filter($config['chapter_url'])->attr('href');

            $this->processChapter($manga, $chapterNumber, $chapterUrl);
        }
    }

    protected function processChapter($manga, $chapterNumber, $chapterUrl)
    {
        $chapter = Chapter::firstOrNew(
            ['chapter_number' => $chapterNumber, 'manga_id' => $manga->id]
        );

        usleep(150000);

        if (!$chapter->exists) {
            $chapter->save();

            Link::updateOrCreate(
                ['chapter_id' => $chapter->id, 'url' => $chapterUrl]
            );



            echo "Saved chapter link: $chapterUrl for chapter number: $chapterNumber\n";
        } else {
            echo "Chapter $chapterNumber already exists. Skipping update.\n";
        }
    }
}
