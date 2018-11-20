<?php

namespace Controllers;

use Models\TasksList;
use Models\User;

class SiteController
{
//    public function __construct()
//    {
//        echo "~SiteController Work~";
//    }
    public function actionIndex()
    {

//        $categories = [];
//        $categories = Category::getCategoriesList();
//
//        $latestProducts = [];
//        $latestProducts = Product::getLatestProducts(3);
//
//        $recommendedProducts = [];
//        $recommendedProducts = Product::getRecommendedProducts();
        //print_r($recommendedProducts);

//        require_once (ROOT . '/views/site/index.php');
//        return true;

        $users = TasksList::getTaskLists(3, 2);
//
        print_r($users);

    }
}