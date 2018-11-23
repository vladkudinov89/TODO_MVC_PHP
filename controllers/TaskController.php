<?php

namespace Controllers;

use Components\Pagination;
use Models\TasksList;
use Models\User;

class TaskController
{

    public function actionIndex($page)
    {
        if (empty($page)) {
            $page = 1;
        }
        $tasks = TasksList::getTaskLists(TasksList::SHOW_BY_DEFAULT, $page);

        $totalTasks = TasksList::getTotalTasks();

        $pagination = new Pagination($totalTasks, $page, TasksList::SHOW_PAGINATION, 'page-');

        require_once(ROOT . '/views/task/index.php');
        return true;
    }

    public function actionAdd()
    {
        $taskName = '';
        $taskText = '';

        $imageRoute = "upload/default.png";

        if (isset($_POST['submit'])) {

            if (isset($_FILES['taskphoto'])) {

                $image = $_FILES['taskphoto'];

                $imageType = $image['type'];

                if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png') {

                    $saveto = 'upload/' . basename($image["name"]);
                    move_uploaded_file($image['tmp_name'], $saveto);
                    $imageRoute = $saveto;
                }
            }

            $taskName = $_POST['taskname'];
            $taskText = $_POST['tasktext'];

            $errors = false;

            if (empty($taskName)) {
                $errors[] = 'Name task is empty';
            }

            if (empty($taskText)) {
                $errors[] = 'Text task is empty';
            }

            if ($errors == false) {

                $result = TasksList::add($taskName, $taskText, $imageRoute);

                if ($result) {
                    $messages[] = "Task has been added!";
                }

            }
        }

        require_once(ROOT . '/views/task/add.php');
        return true;
    }

    public
    function actionComplete($taskId)
    {
        $completeTask = TasksList::taskComplete($taskId);
        if ($completeTask) {
            return true;
        }
        return false;
    }

    public
    function actionRollback($taskId)
    {
        $rollbackTask = TasksList::taskRollback($taskId);
        if ($rollbackTask) {
            return true;
        }
        return false;
    }

    public
    function actionEdit($taskId)
    {
        $editTask = TasksList::taskEdit($taskId);
        if ($editTask) {
            return true;
        }
        return false;
    }

    public
    function actionDelete($taskId)
    {
        $deleteTask = TasksList::taskDelete($taskId);
        if ($deleteTask) {
            return true;
        }
        return false;
    }
}