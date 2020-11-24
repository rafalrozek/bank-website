<?php namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model{

    protected $table = 'IAB_Account';
    protected $primaryKey = 'AccountId';
    protected $allowedFields = ['UserId', 'DateOpened', 'Balance'];
    #protected $beforeInsert = ['joinUser'];

    public function getUserLoans($id){
        $model = new LoanModel();
        $q = $model->select('*')->where('UserId',$id)->get()->getResultArray();
        //$loans = $q->getResult('array');

        return $q;
    }
}

