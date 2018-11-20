<?php

namespace Controllers;

use Models\TasksList;

class SiteController
{

    public function actionIndex()
    {
        $tasks = TasksList::getTaskLists(3, 1);

//        print_r($tasks);
       require_once (ROOT . '/views/site/index.php');
       return true;

    }
}