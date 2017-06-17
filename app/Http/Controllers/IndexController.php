<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Http\Service\UrlStoreService;
use App\Url;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('url.index',['u' => null]);
    }

    public function store(Request $request)
    {
        $url = $request->get('url');
        if(!$url || !filter_var($url, FILTER_VALIDATE_URL)){
            return ['status' => 'FAILED', 'status_code' => 403, 'message' => '非法的 URL '];
        }

        $randomShortKey = str_random(10);
        $customShortKey = $request->get('shortKey');
        $shortKey = $randomShortKey;
        if($customShortKey){
            $shortKey = $customShortKey;
        }
        $service = new UrlStoreService();
        return $service->store($url,$shortKey);
    }

    public function save($url,$shortKey)
    {
        $u = Url::uri($url)->first();
        if(!is_null($u)){
            return $u;
        }
        $u = new Url(parse_url($url));
        $u->uri = $url;
        $u->shortKey = $shortKey;
        $u->save();
        return $u;
    }
}
