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

        $uploadOk = 0;

        $imageRoute = "upload/default.png";

        if (isset($_POST['submit'])) {

//
//            $task_img = $target_dir . basename($_FILES["taskphoto"]["tmp_name"]);
////            print_r($task_img);
//            $imageFileType = strtolower(pathinfo($task_img, PATHINFO_EXTENSION));
//            print_r($imageFileType);
//            $check = getimagesize($_FILES["taskphoto"]["tmp_name"]);
//
//            if ($check !== false) {
//                echo "File is an image - " . $check["mime"] . ".";
//                $uploadOk = 1;
//            } else {
//                echo "File is not an image.";
//                $uploadOk = 0;
//            }
//            if (file_exists($task_img)) {
//                echo "Sorry, file already exists.";
//                $uploadOk = 0;
//            }
//            if ($_FILES["taskphoto"]["size"] > 500000) {
//                echo "Sorry, your file is too large.";
//                $uploadOk = 0;
//            }
//            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//                && $imageFileType != "gif"
//            ) {
//                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//                $uploadOk = 0;
//            }


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

            if ($errors == false) {

                $result = TasksList::add($taskName, $taskText, $imageRoute);

                if ($result) {
                    $messages[] = "Task has been added!";
//                    $messages[] = "The file " . basename($_FILES["taskphoto"]["name"]) . " has been uploaded.";
                    header("Location: /");
//                    exit();
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