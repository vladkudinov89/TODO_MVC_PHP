<?php

namespace App\Repository;

use App\Models\TodosEloq;
use App\Models\UserEloq;

class TaskListRepository implements TaskListRepositoryInterface
{
    public function findAll()
    {
        return TodosEloq::with('user')->get();
    }

    public function save($task_name, $task_text, $imageRoute): TodosEloq
    {
        return TodosEloq::create([
            'task_name' => $task_name,
            'task_text' => $task_text,
            'user_id' => 1,
            'is_complete' => 0,
            'task_img' => $imageRoute
        ]);
    }

    public function actionComplete($task_id): void
    {
        TodosEloq::findOrFail($task_id)
            ->update(['is_complete' => 1]);
    }

    public function actionRollback($task_id): void
    {
        TodosEloq::findOrFail($task_id)
            ->update(['is_complete' => 0]);
    }

    public function actionDelete($task_id): void
    {
        TodosEloq::findOrFail($task_id)
            ->delete();
    }


}