<?php namespace App\Controllers;

use App\Models\UserModel;

class Client extends BaseController 
{
	public function index()
	{
		$data = [];
		echo view('templates/header');
		echo view('client', $data);
		echo view('templates/footer');

	}
	

}
