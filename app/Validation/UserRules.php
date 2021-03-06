<?php 
namespace App\Validation;
use App\Models\UserModel;

class UserRules
{

  public function validateUser(string $str, string $fields, array $data){
    $model = new UserModel();
    $user = $model->where('Email', $data['email'])
                  ->first();

    if(!$user)
      return false;


    return password_verify($data['password'], $user['Password']);
  }
  public function validateUserActive(string $str, string $fields, array $data){
    $model = new UserModel();
    $user = $model->where('Email', $data['email'])->first();

    if(!$user)
      return false;

    return $user['active']==1;

  }
}