<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 
        'email', 
        'email_verified_at', 
        'photo', 
        'role', // Opcional
        'password', 
        'remember_token'
    ];
    protected $hidden = ['password', 'created_at', 'updated_at'];

   public function getUsers()
    {
        return $this->all();
    }

    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function createUser(array $data)
    {
        return $this->create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = $this->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function deleteUser($id)
    {
        $user = $this->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();  
    }
}
