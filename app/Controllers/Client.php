<?php namespace App\Controllers;

use App\Models\LoanModel;
use App\Models\UserModel;
use App\Models\ReportModel;
use App\Models\ReportCommentModel;
use App\Models\UserContactModel;

class Client extends BaseController 
{
	public function index()
	{
		$data = [];
		$loans = new LoanModel();
		$user = new UserModel();
		$reports = new ReportModel();
		$comments = new ReportCommentModel();
		$contact = new UserContactModel();

		$data['contact'] = $contact->getUserContact($_SESSION['id']);
		$data['loans'] = $loans->getUserLoans($_SESSION['id']);
		$data['balance'] = $user->getMoney($_SESSION['id']);
		$data['reports'] = $reports->getUserReports($_SESSION['id']);
		$i = 0;
		foreach($data['reports'] as $r){
			$data['reports'][$i]['messages'] = $comments->getReportComments($r['ReportId']);
			$i += 1;
		}

		
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
	public function report(){
		$title = $this->request->getVar('title');
		$msg = $this->request->getVar('message');
		
		$report = new ReportModel();
		$newReport =[
			'UserId' => $_SESSION['id'],
            'Title' => $title, 
        ];
		$report->insert($newReport);
		$rid = $report->insertID();
		
		$comment = new ReportCommentModel();
		$comment->addComment($rid, $msg);

		$session = session();
		$session->setFlashdata('reportAdd', 'Pomyślnie dodano raport.');
		return redirect()->to('/client');
	}

	public function editprofile(){
		$firstname = $this->request->getVar('firstname');
		$secondname = $this->request->getVar('secondname');
		$address = $this->request->getVar('address');

		$contact = new UserContactModel();
		$data = [
			'FirstName' => $firstname,
			'SecondName'  => $secondname,
			'Addres'  => $address
		];

		$contact->set($data)->where('UserId', $_SESSION['id'])->update();

		$session = session();
		$session->setFlashdata('editprofile', 'Pomyślnie edytowano profil.');
		return redirect()->to('/client');
	}

	public function message(){
		$rid = $this->request->getVar('reportid');
		$msg = $this->request->getVar('msg');

		$comment = new ReportCommentModel();
		$comment->addComment($rid, $msg);

		//$session = session();
		//$session->setFlashdata('editprofile', 'Pomyślnie edytowano profil.');
		return redirect()->to('/client');
	}
	public function transaction(){
		$email = $this->request->getVar('email');
		$amount = $this->request->getVar('amount');

		//find user by email
		$model = new UserModel();
		$user = $model->where('email', $email)->first();
		if($user == null){
			return redirect()->to('/client')->with('transactionerr', 'Brak konta z podanym adresem email.');
		}
		if($model->getMoney($_SESSION['id']) < $amount){
			return redirect()->to('/client')->with('transactionerr', 'Brak wystarczających środków na koncie.');
		}
		$model->transBegin();

		$model->addMoney($user['UserId'], $amount);
		$model->submoney($_SESSION['id'], $amount);
		
		if ($model->transStatus() === FALSE)
		{
				$model->transRollback();
				return redirect()->to('/client')->with('transactionerr', 'Niespodziewany błąd transakcji.');
		}

		$model->transCommit();
		return redirect()->to('/client')->with('transaction', 'Pomyślnie dokonano transakcji na adres ' .$email. ' (-' .$amount.',00 PLN).');
		

		
	}
	

}
