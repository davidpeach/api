<?php

namespace App\Http\Controllers\Api;

use App\Album;
use App\Http\Controllers\Controller;
use App\Http\Resources\DateGroupListenCollection;
use App\Http\Resources\ListenCollection;
use App\Listen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlbumListenController extends Controller
{
    public function index(Request $request)
    {
    	$albumQuery = "
            SELECT albums.title as album, albums.id as album_id
            FROM `listens`
            JOIN `songs` ON `songs`.`id` = `listens`.`song_id`
            JOIN `albums` ON `albums`.`id` = `songs`.`album_id`
            JOIN `artists` ON `artists`.`id` = `albums`.`artist_id`
            WHERE albums.title != ''
            GROUP BY albums.title, albums.id
            -- ORDER BY listens.listened_at DESC
            -- LIMIT 100
        ";

        $sql = "
            SELECT albumQuery.album,
            GROUP_CONCAT(songs.title) as song
            FROM ($albumQuery) as albumQuery
            JOIN `songs` ON `songs`.`album_id` = `albumQuery`.`album_id`
            JOIN `listens` ON `listens`.`song_id` = `songs`.`id`
            GROUP BY listens.listened_at, albumQuery.album
            ORDER BY listens.listened_at DESC, albumQuery.album DESC
            limit 10
        ";


        // dd(\DB::select(\DB::raw($albumQuery)));
        dd(\DB::select(\DB::raw($sql)));

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
