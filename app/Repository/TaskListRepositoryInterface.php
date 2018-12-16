<?php
namespace App\Repository;

use App\Models\TasksList;

interface TaskListRepositoryInterface
{
    public function findAll();

    public function getCurrentTask($task_id);

    public function save($task_name , $task_text , $imageRoute): TasksList;

    public function actionComplete($task_id): void;

    public function actionRollback($task_id): void;

    public function actionDelete($task_id): void;
}