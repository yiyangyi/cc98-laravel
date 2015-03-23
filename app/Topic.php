<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = [];


    /**
     *
     * Relationships with other models
     *
     */

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

    /**
     *
     * Scope method for easier query.
     *
     */

    public function scopePin($query)
	{
		return $query->orderBy('order', 'desc');
	}

	public function scopeWhose($query, $user_id)
	{
		return $query->where('user_id', '=', $user_id)->with('node');
	}

	public function scopeRecent($query)
	{
		return $query->orderBy('created_at', 'desc');
	}

    public function scopeRecentReplied($query)
    {
        return $query->where('created_at', '>', Carbon::today()->subMonth())
                     ->orderBy('updated_at', 'desc');
    }

	public function scopeExcellent($query)
	{
		return $query->where('excellent', '=', true);
	}

    public function applyFilter($filter)
    {
        switch($filter) {
            case 'noreply':
                return $this->orderBy('reply', 'asc')->recent();
                break;
            case 'vote':
                return $this->orderBy('vote_count', 'desc')->recent();
                break;
            case 'excellent':
                return $this->excellent()->recent();
                break;
            case 'recent':
                return $this->recent();
                break;
            default:
                return $this->pin()->recentReply();
                break;
        }
    }

    public function getSameNodeTopics($limit = 8)
    {
        return Topic::where('node_id', '=', $this->node_id)
                    ->recent()
                    ->take($limit)
                    ->remember()
                    ->get();
    }

    public function getTopicsWithFilter($filter, $limit = 20)
    {
        return $this->applyFilter($filter)
                    ->with('');
    }

    public static function makeExcerpt($body)
    {
        $body = strip_tags($body);
        $excerpt = trim(preg_replace('/\s\s+/', '', $body));
        return str_limit($excerpt, 200);
    }

}
