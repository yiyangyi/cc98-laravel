<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class MakeReplyRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'body'      => 'required|min:10',
			'user_id'   => 'required|numeric',
			'topic_id'  => 'required|numeric'
 		];
	}

}
