<?php namespace App\Models;

use CodeIgniter\Model;

class UserContactModel extends Model{

    protected $table = 'IAB_UserContact';
    protected $primaryKey = 'UserId';
    protected $allowedFields = ['UserId', 'firstname', 'secondname','addres', 'joindate'];
    protected $beforeInsert = ['joinUser'];

    protected function joinUser(array $data){
        $data['data']['joindate'] = time();

        return $data;

    }
}

