<?php

namespace App\Controllers;

use App\Actions\TaskListPresenter;
use App\Models\TasksList;
use App\Models\TodosEloq;
use App\Models\User;
use App\Models\UserEloq;
use App\Repository\TaskListRepository;
use App\Repository\TaskListRepositoryInterface;
use App\Requests\Request;
use App\Requests\ValidationRequest\TaskValidation;
use App\Services\PhotoService;


class TaskController extends Controller
{
    private $photoService;
    protected $content;
    private $taskValidation;
    private $task_list;

    public function __construct()
    {
        parent::__construct();
        $this->photoService = new PhotoService();
        $this->taskValidation = new TaskValidation();
        $this->content['flash_messages'] = $this->session->display();
        $this->task_list = new TaskListRepository();
    }

    public function actionIndex()
    {
        $task_present = [];
        foreach ($this->task_list->findAll() as $tasksList) {
            $task_present[] = TaskListPresenter::present($tasksList);
        }
        $this->content['tasks'] = $task_present;
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

                $task_test = $this->task_list->save($task_name, $task_text, $imageRoute);

                if ($task_test) {
                    $this->session->success("Task ~ $task_name ~ is success add!", '/');
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
        $this->task_list->actionComplete($taskId);
    }

    public
    function actionRollback($taskId)
    {
        $this->task_list->actionRollback($taskId);
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

                $result = TodosEloq::findOrFail($taskId)
                    ->update([
                        'task_name' => $task_name,
                        'task_text' => $task_text,
                        'task_img' => $task_img
                    ]);

                if ($result) {
                    $this->session->info("Task ~ $task_name ~ is success edit!", '/');
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
        $this->task_list->actionDelete($taskId);
    }
}