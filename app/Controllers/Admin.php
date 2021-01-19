<?php namespace App\Controllers;

use App\Models\LoanModel;
use App\Models\UserModel;
use App\Models\ReportModel;
use App\Models\ReportCommentModel;
use App\Models\UserContactModel;


class Admin extends BaseController 
{
	public function index()
	{
		$data = [];

		$reports = new ReportModel();
		$comments = new ReportCommentModel();
        $users = new UserModel();

        $data['reports'] = $reports->getAllReports();
        $data['users'] = $users->getAllUsers();

		$i = 0;
		foreach($data['reports'] as $r){
			$data['reports'][$i]['messages'] = $comments->getReportComments($r['ReportId']);
			$i += 1;
		}

		
		echo view('templates/header');
		echo view('admin', $data);
		echo view('templates/footer');

    }
    
    public function message(){
		$rid = $this->request->getVar('reportid');
		$msg = $this->request->getVar('msg');

        $session = session();

		$comment = new ReportCommentModel();
		$comment->addComment($rid, $msg, $session->get('id'));

		
		//$session->setFlashdata('editprofile', 'Pomyślnie edytowano profil.');
		return redirect()->to('/admin');
    }
    public function closeReport($id){
        $model = new ReportModel();

        $model->set('Status', 1)->where('ReportId', $id)->update();
        $session = session();
        $session->setFlashdata('reportRemove', 'Pomyślnie zamknięto zgłoszenie (ID: '.$id.')');
		return redirect()->to('/admin');
	}

	

}
