<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserEloq extends Model
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
        return $this->hasOne(TodosEloq::class);

    }
}