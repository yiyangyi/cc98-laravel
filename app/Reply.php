<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

	protected $fillable = [
		'body',
		'body_original',
		'user_id',
		'topic_id'
	];

	public static function boot()
	{
		parent::boot();

		static::created(function ($topic) {
			// Do something here.
		});
	}

	public function topic()
	{
		return $this->belongsTo('Topic');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function votes()
	{
		return $this->morphsMany('Vote', 'votable');
	}

	public function scopeWhose($query, $user_id) 
	{
		return $query->where('user_id', '=', $user_id)->with('topic');
	}

	public function scopeRecent($query) 
	{
		return $query->orderBy('created_at', 'desc');
	}

}
