<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\MakeReplyRequest;
use App\Reply;
use App\Topic;
use App\Services\Markdown;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller {

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(MakeReplyRequest $request, Reply $reply, Topic $topic, Markdown $markdown)
	{
		$user_id = Auth::user()->id;
        $body_original = $request->input('body');
        $body = $markdown->convertMarkdownToHtml();
        $reply = Reply::create(['body' => $body,
                                'body_original' => $body_original,
                                'user_id' => $user_id]);

        $topic = Topic::find($reply->topic_id);
        $topic->last_reply_user_id = Auth::user()->id;
        $topic->reply_count++;
        $topic->updated_at = Carbon::now()->toDateTimeString();
        $topic->save();

        Auth::user()->increment('reply_count', 1);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    /**
     * Support one specified user reply.
     *
     * @param $id
     * @return Response
     */
    public function vote($id)
    {

    }

}
