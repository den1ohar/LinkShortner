<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class GenerateUrlController extends Controller
{
    public function generate(Request $request){
        $url = $request->url;
        $code = Link::generateRandomUniqCode();
            $link = new Link();
            $link->link = $url;
            $link->short_code = $code;
            $link->save();
        return response()->json($link, 201);
    }

    public function show($code){
        $link = Link::where('short_code', $code)->firstOrFail();
        $count = (int)$link->views_count;
        $link->update(['views_count' => ++$count]);
        return redirect($link->link);
    }
}
