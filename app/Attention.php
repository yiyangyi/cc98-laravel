<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Attention extends Model {

	protected $fillable = [];

	public function post()
	{
		return $this->belongsTo('Post');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

}
