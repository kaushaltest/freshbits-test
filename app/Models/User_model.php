<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_model extends Model
{
    public $timestamps=false;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email'
    ];
    public function getUser()
    {
        return User_model::select('id','name','email')->get();
    }

    public function addUser($addData)
    {
        return  User_model::insert($addData);
    }

    public function editUser($userId, $editData)
    {
        return User_model::where('id', $userId)->update($editData);
    }

    public function deleteUser($userId)
    {
        return  User_model::where('id', $userId)->delete();
    }
}
