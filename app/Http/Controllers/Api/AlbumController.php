<?php

namespace App\Http\Controllers\Api;

use App\Album;
use App\Http\Controllers\Controller;
use App\Http\Resources\AlbumCollection;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $albums = Album::distinct()
            ->select(['artist_id', 'title'])
            ->where('title', '!=', '')
            ->limit(5)
            ->orderBy('title', 'ASC');

        return new AlbumCollection($albums->paginate(30));
    }

    public function latest()
    {
        //
    }


}
