<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Entrust;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    public function adminOrAuthorPermissionRequired($user_id)
    {
        if (!Entrust::can('manage_topics') && $user_id != Auth::user()->id) {
            abort(401, "Admin or author permission required!");
        }
    }

}
