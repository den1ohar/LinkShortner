<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'views_count'
];
        //
    static function generateRandomUniqCode($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $link = Link::where('short_code', $randomString)->first();
        if($link) {
            self::generateRandomUniqCode();
        }
        return $randomString;
    }
}
