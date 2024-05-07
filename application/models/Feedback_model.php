<?php
class Feedback_model extends CI_Model
{
	private $_table = "feedback";

	public function rules()
	{
		return [
			[
				'field' => 'name', 
				'label' => 'Name', 
				'rules' => 'required|max_length[32]'
			],
			[
				'field' => 'pass', 
				'label' => 'Password', 
				'rules' => 'required'
			],
			[
				'field' => 'message', 
				'label' => 'Message', 
				'rules' => 'required'
			],
		];
	}

}