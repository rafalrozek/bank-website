<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserContactModel;
use App\Models\AccountModel;
use CodeIgniter\Database\ConnectionInterface;

class UserModel extends Model{
    protected $db;


    protected $table = 'IAB_User';
    protected $primaryKey = 'UserId';
    protected $allowedFields = ['UserId','email', 'password','active', 'hash', 'admin'];
    protected $beforeInsert = ['passwordHash'];

    protected function passwordHash(array $data){
        if(isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }
    public function addUser($data, $firstname, $secondname){
        $insertId = $this->insert($data, true);
        $contactModel = new UserContactModel();
        $now = date('Y-m-d H:i:s');
        
        $newContact =[
            'UserId' => $insertId, 
            'firstname' =>  $firstname,
            'secondname' => $secondname,
        ];
        $this->set('JoinDate', 'NOW()');
        $contactModel->insert($newContact);

        //create account
        $account = new AccountModel();
        $newAccount =[
            'UserId' => $insertId, 
            'Balance' =>  0,
        ];
        $account->insert($newAccount);
     
       
     }
     public function getContact($id){
        $contactModel = new UserContactModel();
        $user = $contactModel->where('UserId', $id)->first();
        return $user;

     }
     public function addMoney($id, $money){
        $model = new AccountModel();
 
        $account = $model->set('Balance', $this->getMoney($id)+$money)->where('UserId', $id)->update();
    

     }
     public function subMoney($id, $money){
        $model = new AccountModel();
        $account = $model->set('Balance', $this->getMoney($id)-$money)->where('UserId', $id)->update();
    

     }
     public function getMoney($id){
        $model = new AccountModel();
        $account = $model->where('UserId', $id)->first();

        return $account['Balance'];
     }

     public function getAllUsers(){
        $model = new UserModel();
        $q = $model->select('*')->get()->getResultArray();

        return $q;
     }
}

