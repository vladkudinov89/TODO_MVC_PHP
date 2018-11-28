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
        $taskName = '';
        $taskText = '';
        $imageRoute = "upload/default.png";

        if (isset($_POST['addTask'])) {

            if (isset($_FILES['addTaskPhoto'])) {

                $image = $_FILES['addTaskPhoto'];

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

            if (isset($task_image)) {

                $imageType = $task_image['type'];

                if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png')
                {
                    $saveto = 'upload/' . basename($task_image["name"]);
                    move_uploaded_file($task_image['tmp_name'], $saveto);
                    $task_img = $saveto;
                }
            }

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