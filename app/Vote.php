<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

	//A user can vote both a topic or a reply
	
	protected $fillable = [
		'user_id',
		'votable_id',
		'votable_type',
	];

	public function votable()
	{
		return $this->morphTo();
	};

	public function scopeByWhom($query, $user_id)
	{
		return $query->where('user_id', '=', $user_id);
	};

	public function scopeWithType($query, $type)
	{
		return $query->where('votable_type', '=', $type);
	};

}
