<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SiteStatus extends Model {

	public static function newUser()
    {
        self::collect('new_user');
    }

    public static function newTopic()
    {
        self::collect('new_topic');
    }

    public static function newReply()
    {
        self::collect('new_reply');
    }

    public static function newImage()
    {
        self::collect('new_image');
    }

    public static function collect($subject)
    {
        $today = new Carbon::now()->toDateString();
        $todaySiteStatus = SiteStatus::where('day', $today)->first();

        if (!$todaySiteStatus) {
            $todaySiteStatus = new SiteStatus();
            $todaySiteStatus->day = $today;
        }

        switch($subject) {
            case 'new_user':
                $todaySiteStatus->users_count += 1;
                break;
            case 'new_topic':
                $todaySiteStatus->topics_count += 1;
                break;
            case 'new_reply':
                $todaySiteStatus->replies_count += 1;
                break;
            case 'new_image':
                $todaySiteStatus->images_count += 1;
                break;
        }

        $todaySiteStatus->save();
    }
}
