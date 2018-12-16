<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TasksList extends Model
{
    protected $table = "task_list";

    protected $fillable = ['task_name','task_img','user_id','task_text','is_complete'];

    protected $hidden = [

        'created_at','updated_at'

    ];

    public function user()
    {
        return $this->belongsTo(UserEloq::class , 'user_id');
    }
}