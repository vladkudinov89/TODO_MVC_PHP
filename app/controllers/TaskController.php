<?php

namespace App\Controllers;

use App\Models\TasksList;
use App\Models\User;
use App\Requests\Request;
use App\Requests\ValidationRequest\TaskValidation;
use App\Services\PhotoService;

class TaskController extends Controller
{
    private $photoService;
    protected $content;
    private $taskValidation;

    public function __construct()
    {
        parent::__construct();
        $this->photoService = new PhotoService();
        $this->taskValidation = new TaskValidation();
        $this->content['flash_messages'] =  $this->session->display();
    }

    public function actionIndex()
    {
        $this->content['tasks'] = TasksList::getTaskLists();
        $this->content['isGuest'] = User::isGuest();
        $this->content['content'] = "task/index.tmpl";
        $this->view->generate($this->content);
    }

    public function actionAdd()
    {
        if (Request::get('addTask')) {

            $task_name = trim(filter_var(Request::get('taskname'), FILTER_SANITIZE_STRING));
            $task_text = trim(filter_var(Request::get('tasktext'), FILTER_SANITIZE_STRING));

            $imageRoute = $this->photoService->addImage($_FILES['addTaskPhoto']);

            if ($this->taskValidation->rules()->passed()) {

                $result = TasksList::add($task_name,$task_text, $imageRoute);

                if ($result) {
                    $this->session->add("Task ~ $task_name ~ is success add!" , '/');
                }
            } else {
                $this->content['errors'] = $this->taskValidation->rules()->errors();
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
        $this->content['task_img'] = '/' . $task_img;

        if (Request::get('editTask')) {

            $task_name = trim(filter_var(Request::get('taskname'), FILTER_SANITIZE_STRING));
            $task_text = trim(filter_var(Request::get('tasktext'), FILTER_SANITIZE_STRING));

            $task_image = $_FILES['editTaskPhoto'];

            $task_img = $this->photoService->editPhoto($task_img, $task_image);
            $this->content['task_img'] = '/' . $task_img;

            if ($this->taskValidation->rules()->passed()) {
                $result = TasksList::taskEdit($taskId, $task_name, $task_text, $task_img);

                if ($result) {
                    $this->session->add("Task ~ $task_name ~ is success edit!" , '/');
                }
            } else {
                $this->content['errors'] = $this->taskValidation->rules()->errors();
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