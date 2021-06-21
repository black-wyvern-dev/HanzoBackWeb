<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;
use Auth;

use App\Models\User;
use App\Models\Shill;

class ShillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function PostShill(Request $request)
    {
        $shill = new Shill;
        $shill->name = $request['name'];
        $shill->handle = $request['id'];
        $shill->content = $request['content'];
        $shill->avatar = $request['avatar'];
        $shill->image = $request['image'];
        $shill->save();

        try{
            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            $result = Larafirebase::withTitle("New shill posted")
                ->withBody($shill->content)
                ->sendNotification($fcmTokens);
            return response('success');

        }catch(\Exception $e){
            report($e);
            return response('Fail');
        }

    }
   
}
