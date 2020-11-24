<?php namespace App\Controllers;

use App\Models\LoanModel;
use App\Models\UserModel;

class Client extends BaseController 
{
	public function index()
	{
		$data = [];
		$loans = new LoanModel();
		$user = new UserModel();

		$data['loans'] = $loans->getUserLoans($_SESSION['id']);

		$data['balance'] = $user->getMoney($_SESSION['id']);

		echo view('templates/header');
		echo view('client', $data);
		echo view('templates/footer');

	}
	public function logout(){
		$session = session();
		$session->remove('isLoggedIn');
		$session->setFlashdata('logOut', 'Wylogowano pomyślnie.');
		return redirect()->to('/login');

	}
	public function addLoan(){
		$model = new LoanModel();
		$newLoan = [
			'UserId' => $_SESSION['id'],
			'Money' => $this->request->getVar('money'),
			'paid' => 0,
			'DateEnd' => date('Y-m-d', strtotime('+1 year'))
		];
		$model->insert($newLoan);

		//add money to user
		$user = new UserModel();
		$user->addMoney($_SESSION['id'], $this->request->getVar('money'));

		return redirect()->to('/client');

	}
	

}
