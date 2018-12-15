<?php
namespace App\Repository;

use App\Models\TodosEloq;

interface TaskListRepositoryInterface
{
    public function findAll();

    public function save($task_name , $task_text , $imageRoute): TodosEloq;

    public function actionComplete($task_id): void;

    public function actionRollback($task_id): void;

    public function actionDelete($task_id): void;
}