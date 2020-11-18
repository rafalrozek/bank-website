<?php namespace App\Controllers;

use App\Models\UserModel;


class Register extends BaseController 
{

	public function index()
	{
		$data = [];
		helper(['form']);

		//	
		if($this->request->getMethod() == "post"){
			$rules = [
				'firstname' => [
					'rules'  => 'required|min_length[3]|max_length[20]',
					'errors' => [
						'required' => 'Musisz podać swoje imię.',
						'min_length' => 'Imie musi mieć co najmniej 3 litery.',
						'max_length' => 'Imie nie może być dłuższe niż 20 liter.',
					]
				],
				'lastname' => [
					'rules'  => 'required|min_length[3]|max_length[20]',
					'errors' => [
						'required' => 'Musisz podać swoje nazwisko.',
						'min_length' => 'Nazwisko musi mieć co najmniej 3 litery.',
						'max_length' => 'Nazwisko nie może być dłuższe niż 20 liter.',
					]
				],
				'email' => [
					'rules'  => 'required|min_length[6]|max_length[50]|valid_email|is_unique[IAB_User.email]',
					'errors' => [
						'required' => 'Musisz podać swój adres email.',
						'min_length' => 'Email musi mieć co najmniej 6 znaków.',
						'max_length' => 'Email nie może być dłuższy niż 50 znaków.',
						'valid_email' => 'Podany email jest niepoprawny.',
						'is_unique' => 'Podany email jest już zarejestrowany.',
					]
				],
				'password' => [
					'rules'  => 'required|min_length[8]|max_length[255]',
					'errors' => [
						'required' => 'Musisz podać hasło.',
						'min_length' => 'Hasło musi mieć co najmniej 8 znaków.',
						'max_length' => 'Hasło nie może być dłuższe niż 255 znaków.',
					]
				],
				'password_confirm' => [
					'rules'  => 'matches[password]',
					'errors' => [
						'matches' => 'Podane hasła się różnią.',
					]
				],
			];
/*
			$rules=[
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[100]|valid_email|is_unique[users.email]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]',
			];
*/
			if($this->validate($rules)){
				$model = new UserModel();
				$newUser = [
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'active' => 0,
					'hash' => md5($this->request->getVar('email') . "+salt")
				];

				$model->addUser($newUser, $this->request->getVar('firstname'),$this->request->getVar('lastname'));

				$session = session();
				$session->setFlashdata('registerSuccess', 'Zarejestrowano pomyślnie. <br />Potwierdź adres email, aby się zalogować.');
				$this->sendVerificationEmail($this->request->getVar('firstname'), $this->request->getVar('email'));

				return redirect()->to('/login');
				
			}
			
		}
		$data['validation'] = $this->validator;
		echo view('templates/header');
		echo view('register', $data);
		echo view('templates/footer');

	}
	//--------------------------------------------------------------------
	private function sendVerificationEmail($name, $useremail){
		$email = \Config\Services::email();

        $email->setTo("rafal98.poczta@gmail.com");
        $email->setFrom('kontakt@rafalrozek.pl', 'MyBank');
        
		$email->setSubject("Potwierdzenie adresu email.");
		$link = "http://iab.rafalrozek.pl/confirm/".$useremail."/".md5($useremail . "+salt")."";
        $email->setMessage("Cześć ".$name."!<br/> Przejdź na poniższy link aby aktowować konto: <a href=".$link.">".$link."</a>");

        if ($email->send()) 
		{
            echo 'Email successfully sent';
        } 
		else 
		{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
	}
}


