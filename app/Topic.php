<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {

	protected $fillable = [];

	public function node()
	{
		return $this->belongsTo('Node');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function replies()
	{
		return $this->hasMany('Reply');
	}

	public function appends()
	{
		return $this->hasMany('Append');
	}

	public function votes()
	{
		return $this->morphMany('Vote', 'votable');
	}

	public function favoriteBy()
	{
		return $this->belongsToMany('User', 'favorites');
	}

	public function attentedBy()
	{
		return $this->belongsToMany('User', 'attentions');
	}

}
