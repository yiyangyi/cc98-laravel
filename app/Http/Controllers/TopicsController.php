<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateTopicRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TopicsController extends Controller {

	protected $topic;

	/**
	 * Instantiate a new TopicController instance.
	 * @param Topic $topic 
	 */
	public function __construct(Topic $topic)
	{
		parent::__construct();

		$this->middleware('auth', ['except' => 'index', 'show']);
		$this->topic = $topic;
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
	public function store(CreateTopicRequest $request)
	{
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
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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
		//
	}

}
