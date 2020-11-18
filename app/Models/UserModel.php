<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserContactModel;
use CodeIgniter\Database\ConnectionInterface;

class UserModel extends Model{
    protected $db;


    protected $table = 'IAB_User';
    protected $primaryKey = 'UserId';
    protected $allowedFields = ['UserId','email', 'password','active', 'hash'];
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
     
       
     }
}

