<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

    use EntrustUserTrait;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function topics()
	{
		return $this->hasMany('Topic');
	}

	public function replies()
	{
		return $this->hasMany('Reply');
	}

	public function notifications()
	{
		return $this->hasMany('Notification');
	}

	public function favoriteTopics()
	{
		return $this->belongsTo('Topic', 'favorites');
	}

	public function attentTopics()
	{
		return $this->belongsTo('Topics', 'attentions');
	}

    public function scopeRecent($query)
    {

        return $query->orderBy('created_at', 'desc');
    }

    public function getRememberTokenAttribute()
    {
        return $this->remember_token;
    }

    public function setRememberTokenAttribute($value)
    {
        $this->attributes["remember_token"] = $value;
    }
}
