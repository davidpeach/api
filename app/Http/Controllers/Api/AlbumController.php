<?php

namespace App\Http\Controllers\Api;

use App\Album;
use App\Http\Controllers\Controller;
use App\Http\Resources\DateGroupListenCollection;
use App\Http\Resources\ListenCollection;
use App\Listen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        // dd(Listen::load('song')->toSql());

    	$listens = Listen::with('song.album')
            ->orderBy('listened_at', 'DESC')
            ->limit($request->limit ?? 50);

        dd($listens->get()->groupBy('song.album.title'));
        // dd($listens->toSql());

    	// if ($request->has('from')) {
    	// 	$from = new Carbon($request->from);
    	// 	$listens->where('listened_at', '>', $from);
    	// }

     //    if ($request->group ?? 'order' === 'date_grouped') {
     //        return new DateGroupListenCollection($listens->get());
     //    }

     //    return new ListenCollection($listens->get());
    }

}
