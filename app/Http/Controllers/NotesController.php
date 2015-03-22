<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class NotesController extends Controller {


    /**
     * Instantiate a new NotesController instance.
     * Require user authentication.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $notes = Auth::user()->notes()->recent();
        return view('notes.index', compact('notes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('notes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		Note::create($request->input());

        return redirect('notes.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$note = Note::findOrFail($id);

        return view('notes.show', compact('note'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$note = Note::findOrFail($id);

        return view('notes.edit', compact('note'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$note = Note::findOrFail($id);

        $note->title = $request->input('title');
        $note->body  = $request->input('body');

        $note->save();

        return redirect()->route('notes.index')->with('message', 'Updated successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Note::destroy($id);

        return redirect()->route('notes.index')->with('message', 'Deleted succesfully');
	}

}
