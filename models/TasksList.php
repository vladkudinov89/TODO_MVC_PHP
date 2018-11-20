<?php

namespace Models;

use Components\Db;

class TasksList
{
    const SHOW_BY_DEFAULT = 3;
    const SHOW_PAGINATION = 3;

    public static function getTaskLists($count = self::SHOW_BY_DEFAULT, $page = 1)
    {
        $count = intval($count);
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_PAGINATION;
        $db = Db::getConnection();

        $tasksList = array();

        $result = $db->query('SELECT u.username , u.email , t.task_name
from (select * from task_list limit ' . $count . ' offset ' . $offset . ')  as t
left join users u
   on u.id = t.user_id'
        );
        $i = 0;
        while ($row = $result->fetch()) {
            $tasksList[$i]['task_name'] = $row['task_name'];
            $tasksList[$i]['username'] = $row['username'];
            $tasksList[$i]['email'] = $row['email'];
            $i++;
        }
        return $tasksList;
    }
}