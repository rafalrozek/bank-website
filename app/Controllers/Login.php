<?php namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController 
{
	public function index()
	{
		$data = [];
		helper(['form']);

		$data['validation'] = $this->validator;
		if($this->request->getMethod() == "post"){
			$rules = [
				'email' => [
					'rules'  => 'required|min_length[6]|max_length[50]|valid_email',
					'errors' => [
						'required' => 'Musisz podać swój adres email.',
						'min_length' => 'Email musi mieć co najmniej 6 znaków.',
						'max_length' => 'Email nie może być dłuższy niż 50 znaków.',
						'valid_email' => 'Podany email jest niepoprawny.',
					]
				],
				'password' => [
					'rules'  => 'required|min_length[8]|max_length[255]|validateUser[email,password]|validateUserActive[email]',
					'errors' => [
						'required' => 'Musisz podać hasło.',
						'min_length' => 'Hasło musi mieć co najmniej 8 znaków.',
						'max_length' => 'Hasło nie może być dłuższe niż 255 znaków.',
						'validateUser' => 'Błędne dane logowania.',
						'validateUserActive' => 'Musisz aktywować swoje konto aby móc się zalogować.'
					]
				],
			];
			
			if($this->validate($rules)){
				$model = new UserModel();
				$user = $model->where('email', $this->request->getVar('email'))->first();
				$firstname = $model->getContact($user['UserId'])['FirstName'];
				print_r($firstname);
				$data = [
					'id' => $user['UserId'],
					'email' => $user['Email'],
					'firstname' => $firstname,
					'isLoggedIn' => '1'

				];
				echo "ESSA";
				session()->set($data);
				return redirect()->to('/client');
			}
			$data['validation'] = $this->validator;
			
		}
		

		echo view('templates/header');
		echo view('login', $data);
		echo view('templates/footer');

	}
}
