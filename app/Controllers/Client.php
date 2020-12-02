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
		print_r($newLoan);
		$model->insert($newLoan);

		//add money to user
		$user = new UserModel();
		$money = $this->request->getVar('money');
		$user->addMoney($_SESSION['id'], $money);
		$session = session();
		$session->setFlashdata('addLoan', 'Pomyślnie dodano pożyczke.  (+'.$money.',00 PLN)');
		return redirect()->to('/client');

	}
	public function payoff(){
		$user = new UserModel();
		$money = $this->request->getVar('loanmoney');
		//if not enough money..
		if($user->getMoney($_SESSION['id']) < $money){
			$session = session();
			$session->setFlashdata('payofferr', 'Brak wystarczających środków by spłacić pożyczke.');
			return redirect()->to('/client');
		}

		$model = new LoanModel();
		$id = $this->request->getVar('loanid');
		
		$model->delete(['loanid' => $id]);
		

		$user = new UserModel();
		$user->subMoney($_SESSION['id'], $money);


		$session = session();
		$session->setFlashdata('payoff', 'Pomyślnie spłacono pożyczke. (-'.$money.',00 PLN)');
		return redirect()->to('/client');

	}
	

}
