<?php

return [
    'asuracomic' => [
        'url' => 'https://asuracomic.net/',
        'manga_list' => '.listupd .utao',
        'manga_title' => 'a.series',
        'manga_image' => 'a.series img',
        'manga_url' => 'a.series',
        'chapter_list' => '.eplister ul.clstyle li',
        'chapter_number' => '.chapternum',
        'chapter_url' => 'a',
    ],
    'hivetoon' => [
        'url' => 'https://hivetoon.com/',
        'manga_list' => '.listupd .utao',
        'manga_title' => '.luf a.series',
        'manga_image' => 'a.series img',
        'manga_url' => 'a.series',
        'chapter_list' => '.eplister ul li',
        'chapter_number' => '.chapternum',
        'chapter_url' => 'a',
    ],
];
