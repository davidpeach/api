<?php

namespace App\Http\Controllers\Api;

use App\Artist;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistCollection;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
    	$artists = Artist::orderBy('name', 'asc')
    		->paginate(30);

    	return new ArtistCollection($artists);
    }

}
