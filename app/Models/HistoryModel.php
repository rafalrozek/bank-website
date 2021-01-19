<?php namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model{

    protected $table = 'IAB_AccountHistory';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'user_from', 'user_to', 'amount', 'date', 'email_from', "email_to"];
 

    public function getUserHistory($uid){
        $model = new HistoryModel();
        $q = $model->select('*')->where('user_from',$uid)->orWhere('user_to', $uid)->get()->getResultArray();

        return $q;
    }
}

