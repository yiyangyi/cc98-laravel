<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tip extends Model {

    const CACHE_KEY = 'tips';
    const CACHE_MINUTES = 1440;

	protected $fillable = ['body'];

    public static function getRandomTip()
    {
        $tips = Cache::remember(self::CACHE_KEY, self::CACHE_MINUTES, function()
        {
            return Tip::all();
        });

        return $tips->random();
    }

}
