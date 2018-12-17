<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";

    protected $fillable = [

        'username', 'email', 'password','is_admin'

    ];


    protected $hidden = [

        'password'

    ];

    public function todo()

    {
        return $this->hasOne(TasksList::class);

    }

    public static function checkUserData(string $email,string $password): int
    {
        $auth = User::where([
            'email' => $email,
            'password' => $password,
        ])->first();

        if(isset($auth->id))
        {
            return $auth->id;
        }

        return false;

    }

    public static function isAdmin(): bool
    {
        if (isset($_SESSION['user'])) {
            return (bool)$_SESSION['user']['is_admin'];
        }
        return false;
    }

    public static function auth($userId)
    {
        $userAuth = User::where([
            'id' => $userId
        ])->first();

        $userInfo = [
          'id' => $userAuth->id,
          'username' => $userAuth->username,
          'email' => $userAuth->email,
          'is_admin' => $userAuth->is_admin,
        ];

        $_SESSION['user'] = $userInfo;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }

    public static function isLogged()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }

        return false;
    }
}