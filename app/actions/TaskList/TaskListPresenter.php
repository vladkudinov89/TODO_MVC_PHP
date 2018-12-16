<?php

namespace App\Actions;

use App\Models\TasksList;

class TaskListPresenter
{
    public static function present(TasksList $tasksLists): array
    {
        return [
            'task_id' => $tasksLists->id,
            'task_name' => $tasksLists->task_name,
            'task_text' => $tasksLists->task_text,
            'task_img' => $tasksLists->task_img,
            'task_username' => $tasksLists->user->username,
            'task_useremail' => $tasksLists->user->email,
            'task_isComplete' => $tasksLists->is_complete
        ];

    }
}