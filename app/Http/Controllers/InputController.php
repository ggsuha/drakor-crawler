<?php

namespace App\Http\Controllers;

use Goutte;
use Image;

class InputController extends Controller
{
    const SERVERS = [
        'MirrorAce'             => 'MR',
        'Tusfiles'              => 'TF',
        'Userscloud'            => 'UC',
        'MEGA'                  => 'MG',
        'Letsupload'            => 'LU',
        'MediaFire'             => 'MF',
        'SolidFiles'            => 'SF',
        'Google Drive'          => 'GD',
        'Mirror'                => 'MO',
        'MegaUp'                => 'MU',
        'BayFiles'              => 'BF',
        '1fichier'              => '1fic',
        'UppiT'                 => 'UP',
        'Openload:filesim'      => 'Oload',
        'Racaty'                => 'RC',
        'SolidFiles:Uptocloud'  => 'SFU',
        'Zippyshare'            => 'ZS',
        'Uptobox'               => 'UTB',
    ];

    const DRAMA_LIST = [
        'xx'                                => 'web-drama-xx-blue-moon',
        'beautiful-love-wonderful-life'     => 'love-is-beautiful-life-is-wonderful',
        'dr-romantic-2'                     => 'romantic-doctor-teacher-kim-2',
    ];

    const OST_LIST = [
        'dr-romantic-2' => 'romantic-doctor',
    ];

    public function kdramas(int $page = 1)
    {
        $crawler = Goutte::request('GET', "https://smallencode.me/category/k-drama/page/{$page}");

        $resources = $crawler->filter('.post')->each(
            function ($node) {
                $title  = $node->filter('.title a')->text();
                $title  = strpos($title, " Episo") ?
                            substr($title, 0, strpos($title, " Episo")) :
                            $title;
                $url    = str_replace('https://smallencode.me', '', $node
                            ->filter('.title a')->attr('href'));
                $img    = $node->filter('.thumb a noscript img')->attr('src');

                return [
                    'title' => $title,
                    'url' => $url,
                    'img' => $img,
                ];
            }
        );

        $first  = 1;
        $last   = abs(filter_var($crawler->filter('.last')->first()->attr('href'), FILTER_SANITIZE_NUMBER_INT));

        $prev = $page == $first ? null : 'kdrama/page/' . (string) ($page - 1);
        $next = $page == $last ? null : 'kdrama/page/' . (string) ($page + 1);

        return view('kdramas', compact('resources', 'first', 'last', 'page', 'prev', 'next'));
    }

    public function kdrama()
    {
        $slug = str_replace('kdrama/download-drama-korea-','', request()->path());

        $ostSlug    = self::OST_LIST[$slug] ?? $slug;
        $slug       = self::DRAMA_LIST[$slug] ?? $slug;
        // $kordrama   = $slug . '-subtitle-indonesia';

        try {
            $crawler = Goutte::request('GET', 'https://smallencode.me/' . request()->path());
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            abort(500);
        }

        if ($crawler->filter('.error404')->count()) {
            abort(404);
        }

        // $crawler2 = Goutte::request('GET', 'https://kordramas.net/' . $kordrama);
        $ost = Goutte::request('GET', 'https://kdramaost.com/' . $ostSlug . '-ost');

        $ostExist = $ost->filter('.entry-title')->count() ?? null;

        // $kor = $crawler2->filter('.entry-content p')->each(
        //     function ($node) {
        //         if (strpos($node->text(), '|')) {
        //             $list = [];
        //             $b = substr($node->text(), 0, strpos($node->text(), "540"));
        //             $count = substr_count($b, '|');

        //             if ($node->filter('a')->count() < 25) {
        //                 return 'zonk';
        //             }

        //             for ($i=0; $i < $count ; $i++) {
        //                 array_push($list, [
        //                     'server' => self::SERVERS[$node->filter('a')->eq($i)->text()] ?? $node->filter('a')->eq($i)->text(),
        //                     'link' => $node->filter('a')->eq($i)->attr('href')
        //                 ]);
        //             }

        //             return $list;
        //         }
        //     }
        // );

        // $kor = array_values(array_filter($kor));

        $links = $crawler->filter('.su-table table tbody tr td')->each(
            function ($node) {
                if ($node->filter('a')->count()) {
                    $list = $node->filter('a')->each(
                        function ($a) {
                            $link = $a->attr('href');
                            $server = $a->text();

                            return [
                                'server' => $server,
                                'link' => $link
                            ];
                        }
                    );

                    $pieces = array_chunk($list, ceil(count($list) / 3));

                    return $pieces;
                }
            }
        );

        $episodes = $crawler->filter('.su-table table tbody tr td')->each(
            function ($node) {
                if (!$node->filter('a')->count()) {

                    return $node->text();
                }
            }
        );

        $details = $crawler->filter('table tbody tr td span strong')->each(
            function ($node) {
                return $node->text();
            }
        );

        $image = $crawler->filterXpath('//meta[@property="og:image"]')->attr('content');
        $title = $crawler->filter('h1.title')->first()->text();
        $title = strpos($title, " Episo") ?
                substr($title, 0, strpos($title, " Episo")) :
                $title;

        $plot = $crawler->filter('.entry p')->eq(5)->text();
        $plot = $plot == "\u{00a0}" ? $crawler->filter('.entry p')->eq(6)->text() : $plot;
        $plot = $plot == "\u{00a0}" ? $crawler->filter('.entry p')->eq(7)->text() : $plot;

        unset($episodes[0], $episodes[1]);

        $episodes = array_values(array_filter($episodes));
        $links    = array_values(array_filter($links));

        // $links = array_map(function ($key, $value) use ($kor) {
        //     array_unshift($value, $kor[$key] ?? 'zonk');

        //     return $value;

        // }, array_keys($links), $links);

        $list = array_combine($episodes, $links);

        return view('kdrama', compact('title', 'list', 'details', 'image', 'plot', 'ostExist', 'slug', 'ostSlug'));
    }

    public function ost()
    {
        $slug = str_replace('ost/','', request()->path());

        $slug = self::OST_LIST[$slug] ?? $slug;

        $ostSlug = $slug . '-ost';

        try {
            $ost = Goutte::request('GET', 'https://kdramaost.com/' . $ostSlug);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            abort(404);
        }

        if (!$ost->filter('.entry-title')->count()) {
            abort(404);
        }

        $title = $ost->filter('.entry-title')->first()->text();
        $image = $ost->filter('.inner-post-entry p img')->first()->attr('data-lazy-src');
        $spans = $ost->filter('.inner-post-entry p span')->each(
            function ($node) {
                    return $node->text();
                }
        );
        $links = $ost->filter('.inner-post-entry p span a')->each(
            function ($node) {
                    return [$node->text() => $node->attr('href')];
                }
        );

        $spans = array_unique($spans);

        array_pop($spans);
        array_pop($spans);

        return view('ost', compact('title', 'image', 'slug', 'spans', 'links'));
    }

    public function osts(int $page = 1) {
        $crawler = Goutte::request('GET', "https://kdramaost.com/?_page={$page}");

        $osts = $crawler->filter('.pt-cv-ifield ')->each(function ($node) {
            $title  = $node->filter('.pt-cv-title a')->text();
            $url    = str_replace('https://kdramaost.com', '/ost', $node
                        ->filter('.pt-cv-title a')->attr('href'));
            $url    = str_replace('-ost', '', $url);
            $img    = $node->filter('a img')->attr('src');

            $filename = basename($img);

            if (!file_exists(public_path('images/' . $filename))) {
                $image = Image::make($img)->fit(130);
                Image::make($image)->save(public_path('images/' . $filename));
            }

            $img = '/images/' . $filename;

            return [
                'title' => $title,
                'url' => $url,
                'img' => $img,
            ];
        });

        $first  = 1;
        $last   = abs(filter_var($crawler->filter('.pagination')->first()->attr('data-totalpages'), FILTER_SANITIZE_NUMBER_INT));

        $prev = $page == $first ? null : '/ost/page/' . (string) ($page - 1);
        $next = $page == $last ? null : '/ost/page/' . (string) ($page + 1);

        return view('osts', compact('osts', 'first', 'last', 'page', 'prev', 'next'));
    }
}
