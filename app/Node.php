<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model {

	protected $fillable = [];

	public function topics()
	{
		return $this->hasMany('Topic');
	}

}
