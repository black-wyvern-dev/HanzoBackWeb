<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Support\Facades\Storage;
use Auth;

use App\Models\User;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function fileUpload(Request $request) {
         $file = $request->file('chatres');
         if($file)
         {
             $filename = $file->getClientOriginalName();
             $path = $file->storeAs("/public/ChatResoruces", $filename);
             return response('/storage/ChatResoruces/'.$filename);
         }
         return response('failed');
     }
}
