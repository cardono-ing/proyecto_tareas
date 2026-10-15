<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name','email','password','image','active','is_admin','token','reset_token','reset_expires','remember_token'];
    protected $useTimestamps = true;
}