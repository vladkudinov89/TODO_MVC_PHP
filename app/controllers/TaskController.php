<?php

namespace App\Controllers;

use App\Models\TasksList;
use App\Models\User;
use App\Services\PhotoService;
use App\Views\MainView;

class TaskController
{
    private $photoService;
    protected $view;
    protected $content;

    public function __construct()
    {
        $this->photoService = new PhotoService();
        $this->view = new MainView();
    }


    public function actionIndex()
    {
        $this->content['content'] = "task/index.tmpl";
        $this->content['tasks'] =  TasksList::getTaskLists();
        $this->content['isGuest'] = User::isGuest();
        $this->view->generate($this->content);
    }

    public function actionAdd()
    {
        if (isset($_POST['addTask'])) {

            $imageRoute = $this->photoService->addImage($_FILES['addTaskPhoto']);

            $taskName = trim(filter_var($_POST['taskname'], FILTER_SANITIZE_STRING));
            $taskText = trim(filter_var($_POST['tasktext'], FILTER_SANITIZE_STRING));
            $this->content['taskName'] = $taskName;
            $this->content['taskText'] = $taskText;
            $errors = false;

            if (empty($taskName)) {
                $errors[] = 'Name task is empty';
                $this->content['errors'] = $errors;
            }

            if (empty($taskText)) {
                $errors[] = 'Text task is empty';
                $this->content['errors'] = $errors;
            }

            if ($errors == false) {

                $result = TasksList::add($taskName, $taskText, $imageRoute);

                if ($result) {
                    $messages[] = "Task has been added!";
                    $this->content['messages'] = $messages;
                    $this->content['taskName'] = '';
                    $this->content['taskText'] = '';
                    unset($taskName, $taskText, $_FILES['addTaskPhoto']);
                }

            }
        }

        $this->content['content'] = "task/add.tmpl";
        $this->view->generate($this->content);
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

        $this->content['task_name'] = $task_name;
        $this->content['task_text'] = $task_text;
        $this->content['task_img'] = '/'.$task_img;

        $result = false;

        if (isset($_POST['editTask'])) {

            $task_name = trim(filter_var($_POST['taskname'], FILTER_SANITIZE_STRING));
            $task_text = trim(filter_var($_POST['tasktext'], FILTER_SANITIZE_STRING));

            $task_image = $_FILES['editTaskPhoto'];

            $task_img = $this->photoService->editPhoto($task_img, $task_image);
            $this->content['task_img'] = '/'.$task_img;
            $errors = false;

            if (empty($task_name)) {
                $errors[] = 'Name task must not be empty';
                $this->content['errors'] = $errors;
            }

            if (empty($task_text)) {
                $errors[] = 'Text task must not be empty';
                $this->content['errors'] = $errors;
            }

            if ($errors == false) {
                $result = TasksList::taskEdit($taskId, $task_name, $task_text, $task_img);
            }

            if($result){
                $messages[] = "Task is success edit!";
                $this->content['messages'] = $messages;
            }

        }

        $this->content['content'] = "task/edit.tmpl";
        $this->view->generate($this->content);
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