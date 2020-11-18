<?php namespace App\Controllers;

use App\Models\UserModel;

class Confirm extends BaseController 
{
	public function index($email, $hash)
	{
		if(!isset($email) || !isset($hash)){
			return redirect()->to('/');
		}

		$model = new UserModel();
		$user = $model->where('email', $email)->first();
		if($user['hash'] == $hash){
			//correct hash, confirm email
			$data = [
				'active' => 1
			];
			$model->update($user['UserId'], $data);
			$session = session();
			$session->setFlashdata('confirmSuccess', 'Twoje konto zostało aktywowane. <br />Możesz się teraz zalogować.');
		}

		return redirect()->to('/login');


	}
	//--------------------------------------------------------------------

}
