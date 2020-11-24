<?php namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model{

    protected $table = 'IAB_Loan';
    protected $primaryKey = 'LoanId';
    protected $allowedFields = ['UserId', 'Money', 'paid','addres', 'DateStart', "DateEnd"];
    #protected $beforeInsert = ['joinUser'];

    public function getUserLoans($id){
        $model = new LoanModel();
        $q = $model->select('*')->where('UserId',$id)->get()->getResultArray();
        //$loans = $q->getResult('array');

        return $q;
    }
}

