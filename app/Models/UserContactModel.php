<?php namespace App\Models;

use CodeIgniter\Model;

class UserContactModel extends Model{

    protected $table = 'IAB_UserContact';
    protected $primaryKey = 'UserId';
    protected $allowedFields = ['UserId', 'FirstName', 'SecondName','Addres', 'joindate'];
    //protected $beforeInsert = ['joinUser'];

    protected function joinUser(array $data){
        $data['data']['joindate'] = time();

        return $data;

    }
    public function getUserContact($id){
        $model = new UserContactModel();
        $q = $model->select('*')->where('UserId',$id)->get()->getResultArray();

        return $q;
    
    }
}

