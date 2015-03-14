<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

	protected $fillable = [
		'body',
		'type',
		'topic_id',
		'reply_id',
		'user_id',
		'from_user_id',
	];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function topic()
	{
		return $this->belongsTo('Topic');
	}

	public function fromUser()
	{
		return $this->belongsTo('User', 'from_user_id');
	}

}
