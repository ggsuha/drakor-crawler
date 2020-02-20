<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte;

class InputController extends Controller
{

    const SERVERS = [
        'MirrorAce' => 'MR',
        'Tusfiles' => 'TF',
        'Userscloud' => 'UC',
        'MEGA' => 'MG',
        'Letsupload' => 'LU',
        'MediaFire' => 'MF',
        'SolidFiles' => 'SF',
        'Google Drive' => 'GD',
        'Mirror' => 'MO',
        'MegaUp' => 'MU',
        'BayFiles' => 'BF',
        '1fichier' => '1fic',
        'UppiT' => 'UP',
        'Openload:filesim' => 'Oload',
        'Racaty' => 'RC',
        'SolidFiles:Uptocloud' => 'SFU',
        'Zippyshare' => 'ZS',
        'Uptobox' => 'UTB',
    ];

    const DIFF_DRAMAS = [
        'xx' => 'web-drama-xx-blue-moon',
        'beautiful-love-wonderful-life' => 'love-is-beautiful-life-is-wonderful',
        'dr-romantic-2' => 'romantic-doctor-teacher-kim-2',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crawler = Goutte::request('GET', 'https://smallencode.com/category/k-drama/page/1');
        $resources = $crawler->filter('.post')->each(
            function ($node) {
                $title = $node->filter('.title a')->text();
                $title = strpos($title, " Episo") ? 
                        substr($title, 0, strpos($title, " Episo")) : 
                        $title;
                $url = str_replace('https://smallencode.com', '', $node->filter('.title a')->attr('href'));

                return [
                    'title' => $title, 
                    'url' => $url,
                    'img' => $node->filter('.thumb a noscript img')->attr('src'),
                ];
            }
        );

        $crawler2 = Goutte::request('GET', 'https://kdramamusic.com/');
        $resources2 = $crawler2->filter('.pt-cv-ifield')->each(
            function ($node) {
                $title = $node->filter('.pt-cv-title a')->text();
                $url = str_replace('https://kdramamusic.com/', '', $node->filter('.pt-cv-title a')->attr('href'));

                return [
                    'title' => $title, 
                    'url' => $url,
                    'img' => 'https:' . $node->filter('.pt-cv-ifield a noscript img')->attr('src'),
                ];
            }
        );

        return view('welcome', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function tes()
    {
        $slug = str_replace('download-drama-korea-','', request()->path());

        $slug = self::DIFF_DRAMAS[$slug] ?? $slug;

        $kordrama = $slug . '-subtitle-indonesia';


        $crawler = Goutte::request('GET', 'https://smallencode.com/' . request()->path());
        $crawler2 = Goutte::request('GET', 'https://kordramas.com/' . $kordrama);

        $kor = $crawler2->filter('.entry-content p')->each(
            function ($node) {
                if (strpos($node->text(), '|')) {
                    $list = [];
                    $b = substr($node->text(), 0, strpos($node->text(), "540"));
                    $count = substr_count($b, '|');

                    if ($node->filter('a')->count() < 25) {
                        return 'zonk';
                    } 

                    for ($i=0; $i < $count ; $i++) { 
                        array_push($list, [
                            'server' => self::SERVERS[$node->filter('a')->eq($i)->text()] ?? $node->filter('a')->eq($i)->text(),
                            'link' => $node->filter('a')->eq($i)->attr('href')
                        ]); 
                    }

                    return $list;
                }
            }
        );

        $kor = array_values(array_filter($kor));
        // dump($kor);

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

        $image = $crawler->filter('p noscript img')->first()->attr('src');
        $title = $crawler->filter('h1.title')->first()->text();

        $plot = $crawler->filter('.entry p')->eq(5)->text();
        $plot = $plot == "\u{00a0}" ? $crawler->filter('.entry p')->eq(6)->text() : $plot;
        $plot = $plot == "\u{00a0}" ? $crawler->filter('.entry p')->eq(7)->text() : $plot;

        

        $s = $crawler->filter('.entry p')->each(
            function ($node) {
                return $node->text();
            }
        );

        unset($episodes[0], $episodes[1]);

        $episodes = array_values(array_filter($episodes));
        $links    = array_values(array_filter($links));

        // dump($links);
        $links = array_map(function ($key, $value) use ($kor) {
            array_unshift($value, $kor[$key] ?? 'zonk');

            return $value;

        }, array_keys($links), $links);

        $list = array_combine($episodes, $links);
        // dd($list, $links);

        return view('post', compact('title', 'list', 'details', 'image', 'plot'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
      
            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
 
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
             
            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }
    }
}
