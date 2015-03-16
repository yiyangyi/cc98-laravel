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

    public function scopeAtTopic($query, $topic_id)
    {
        return $query->where('topic_id', '=', $topic_id);
    }

    public function scopeWithType($query, $type)
    {
        return $query->where('type', '=', $type);
    }

    public function scopeToWhom($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function scopeFromWhom($query, $user_id)
    {
        return $query->where('from_user_id', '=', $user_id);
    }

}
