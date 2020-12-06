<?php namespace App\Models;

use CodeIgniter\Model;

class ReportCommentModel extends Model{

    protected $table = 'IAB_ReportComment';
    protected $primaryKey = 'CommentID';
    protected $allowedFields = ['CommentID', 'ReportID', 'comment', 'UserId'];

    public function addComment($id, $comment){
		$model = new ReportCommentModel();
		$newComment = [
			'ReportID' => $id,
            'comment' => $comment,
            'UserId' => $_SESSION['id']
		];
		$model->insert($newComment);
    }
    public function getReportComments($id){
        $model = new ReportCommentModel();
        $q = $model->select('*')->where('ReportID',$id)->get()->getResultArray();

        return $q;
    }
}

