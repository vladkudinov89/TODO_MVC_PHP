<?php

namespace Controllers;

use Components\Pagination;
use Models\TasksList;

class TaskController
{

    public function actionIndex($page)
    {
        if(empty($page))
        {
            $page = 1;
        }
        $tasks = TasksList::getTaskLists(TasksList::SHOW_BY_DEFAULT,$page);

        $totalTasks = TasksList::getTotalTasks();

        $pagination = new Pagination($totalTasks, $page, TasksList::SHOW_PAGINATION, 'page-');

        require_once(ROOT . '/views/task/index.php');
        return true;
    }

    public function actionAdd()
    {
        $taskName = '';
        $taskText = '';

        if (isset($_POST['submit']))
        {
            $taskName = $_POST['taskname'];
            $taskText = $_POST['tasktext'];

            $errors = false;

            if ($errors == false) {
                $result = TasksList::add($taskName, $taskText);
//                echo $result;
            }
        }


        require_once(ROOT . '/views/task/add.php');
        return true;
    }
}