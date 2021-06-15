<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;

use App\Models\Musics;

class MusicController extends Controller
{
    public function getMusicList(Request $request) {
        $list = Musics::all();
        
        return response()->json(["data"=>$list]);
    }
}
