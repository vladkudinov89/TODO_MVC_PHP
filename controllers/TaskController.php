<?php

namespace Controllers;

use Models\TasksList;
use Services\PhotoService;

class TaskController
{
    private $photoService;

    public function __construct()
    {
        $this->photoService = new PhotoService();
    }


    public function actionIndex()
    {
        $tasks = TasksList::getTaskLists();

        require_once(ROOT . '/views/task/index.php');
        return true;
    }

    public function actionAdd()
    {
        if (isset($_POST['addTask'])) {

            $imageRoute = $this->photoService::addImage($_FILES['addTaskPhoto']);

            $taskName = trim(filter_var($_POST['taskname'], FILTER_SANITIZE_STRING));
            $taskText = trim(filter_var($_POST['tasktext'], FILTER_SANITIZE_STRING));

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
                    unset($taskName, $taskText, $_FILES['addTaskPhoto']);
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

    public function actionEdit($taskId)
    {
        $taskStore = TasksList::getCurrentTask($taskId);

        $task_name = $taskStore['task_name'];
        $task_text = $taskStore['task_text'];
        $task_img = $taskStore['task_img'];

        $result = false;

        if (isset($_POST['editTask'])) {

            $task_name = trim(filter_var($_POST['taskname'], FILTER_SANITIZE_STRING));
            $task_text = trim(filter_var($_POST['tasktext'], FILTER_SANITIZE_STRING));

            $task_image = $_FILES['editTaskPhoto'];

            $task_img = $this->photoService::editPhoto($task_img, $task_image);

            $errors = false;

            if (empty($task_name)) {
                $errors[] = 'Name task is empty';
            }

            if (empty($task_text)) {
                $errors[] = 'Text task is empty';
            }

            if ($errors == false) {
                $result = TasksList::taskEdit($taskId, $task_name, $task_text, $task_img);
            }

            if($result){
                $messages[] = "Task is success edit!";
            }

        }
        require_once(ROOT . '/views/task/edit.php');
        return true;

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