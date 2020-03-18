<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DramaController extends Controller
{
    /**
     * Show the list of drama.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breadcrumb = request()->segment(2);

        return view('ruler.drama.index', compact('breadcrumb'));
    }

    /**
     * Show input page for drama.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add()
    {
        $breadcrumb = request()->segment(2);

        return view('ruler.drama.add', compact('breadcrumb'));
    }
}
