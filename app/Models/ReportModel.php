<?php namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model{

    protected $table = 'IAB_Report';
    protected $primaryKey = 'ReportId';
    protected $allowedFields = ['ReportId', 'UserId', 'ReportDate', 'Title', 'Status'];

    public function getUserReports($id){
        $model = new ReportModel();
        $q = $model->select('*')->where('UserId',$id)->get()->getResultArray();

        return $q;
    }
}

