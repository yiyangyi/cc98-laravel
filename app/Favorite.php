<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model {

	protected $fillable = [];

	public function user() 
	{
		return $this->belongsTo('User');
	}

	public function topic()
	{
		return $this->belongsTo('Topic');
	}

	public static function isUserFavoriteTopic(User $user, Topic $topic)
	{
		return Favorite::where('user_id', $user->id)
					   ->where('topic_id', $topic->id)
					   ->first();
	}

}
