<?php

namespace Controllers;

use Components\Pagination;
use Models\TasksList;

class SiteController
{

    public function actionIndex($page = 1): void
    {
        $tasks = TasksList::getTaskLists(TasksList::SHOW_BY_DEFAULT,$page);

        $totalTasks = TasksList::getTotalTasks();

        $pagination = new Pagination($totalTasks, $page, TasksList::SHOW_PAGINATION, 'page-');

        require_once(ROOT . '/views/site/index.php');

    }
}