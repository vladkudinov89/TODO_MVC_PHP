<?php

namespace App\Repository;

use App\Models\TasksList;

class TaskListRepository implements TaskListRepositoryInterface
{
    public function findAll()
    {
        return TasksList::with('user')->get();
    }

    public function save($task_name, $task_text, $imageRoute): TasksList
    {
        return TasksList::create([
            'task_name' => $task_name,
            'task_text' => $task_text,
            'user_id' => 1,
            'is_complete' => 0,
            'task_img' => $imageRoute
        ]);
    }

    public function getCurrentTask($task_id)
    {
        return TasksList::where('id' , $task_id)
            ->firstOrFail();
    }

    public function actionComplete($task_id): void
    {
        TasksList::findOrFail($task_id)
            ->update(['is_complete' => 1]);
    }

    public function actionRollback($task_id): void
    {
        TasksList::findOrFail($task_id)
            ->update(['is_complete' => 0]);
    }

    public function actionDelete($task_id): void
    {
        TasksList::findOrFail($task_id)
            ->delete();
    }


}