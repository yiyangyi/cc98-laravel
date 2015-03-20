<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateTopicRequest;
use App\Http\Controllers\Controller;

use App\Services\Markdown;
use App\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller {

	/**
	 * Instantiate a new TopicController instance.
	 * @param Topic $topic 
	 */
	public function __construct()
	{
		parent::__construct();

		$this->middleware('auth', ['except' => 'index', 'show']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('topics.index', compact('topics', 'nodes', 'links'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('topics.create', compact('nodes', 'node'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateTopicRequest $request, Topic $topic, Markdown $markdown)
	{
        $user_id = Auth::user()->id;
        $body_original = $request->input('body_original');
        $body = $markdown->convertMarkdownToHtml($body_original);
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();
        $topic = Topic::create(['user_id'       => $user_id
                                'body'          => $body,
                                'body_original' => $body_original,
                                'created_at'    => $created_at,
                                'updated_at'    => $updated_at]);
        if (!$topic) {
            redirect('topic.create');
        }
        Auth::user()->increment('topic_count', 1);
		return redirect('topics.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $topic = Topic::findOrFail($id);
        $replies = $topic->getRepliesWithLimit(80);
        $node = $topic->node;
        $nodeTopics = $topic->getSameTopic();

        $topic->increment('view_count', 1);

		return view('topics.show', compact('topics', 'replies', 'nodeTopics', 'node'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('topics.edit', compact('topic', 'nodes', 'node'));
	}


    /**
     * Add an append to the original topic.
     *
     * @param int $id
     * @return Response
     */
    public function append($id)
    {
        $topic = Topic::findOrFail($id);
        $this->adminOrAuthorPermissionRequired($topic->user_id);


    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
	}

    /**
     * Upvote the specified topic.
     *
     * @param $id topic_id
     * @return Response
     */
    public function upvote($id)
    {

    }

    /**
     * Downvote the specified topic.
     *
     * @param $id topic_id
     * @return Response
     */
    public function downvote($id)
    {

    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$topic = Topic::findOrFail($id);
        $topic->destroy();
        return redirect('topics/index')->with('Deleted successfully!');
	}

    public function pin($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->order > 0 ? $topic->decrement('order', 1) : $topic->increment('order', 1);
        return redirect('topics/index');
    }

    public function sink($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->order >= 0 ? $topic->decrement('order', 1) : $topic->increment('order', 1);
        return redirect('topic/index');
    }

    public function recommend($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->excellent = (!$topic->excellent);
        $topic->save();
        return redirect()->route('topics.show', [$topic])->with('message', 'Operation succeeded!');
    }
}
