<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$notifications = Auth::user()->notifications()->paginate(15);

        Auth::user()->notifications_count = 0;
        Auth::user()->save();

        return view('notifications.index', compact('notifications'));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Notification::destroy($id);

        return redirect()->route('notifications.index');
	}

}
