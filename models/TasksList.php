<?php

namespace Models;

use Components\Db;

class TasksList
{
    const SHOW_BY_DEFAULT = 3;
    const SHOW_PAGINATION = 3;

    public static function getTaskLists($count = self::SHOW_BY_DEFAULT, $page = 1): array
    {
        $count = intval($count);
        $page = intval($page);

        $offset = ($page - 1) * self::SHOW_PAGINATION;
        $db = Db::getConnection();

        $tasksList = array();

        $result = $db->query('SELECT u.username , u.email , t.task_name , t.is_complete , t.id as task_id
        from (select * from task_list 
        order by task_list.id DESC 
        limit ' . $count . ' offset ' . $offset . '
        )  as t
        left join users u
           on u.id = t.user_id'
        );
        if ($result) {
            $i = 0;
            while ($row = $result->fetch()) {
                $tasksList[$i]['task_id'] = $row['task_id'];
                $tasksList[$i]['task_name'] = $row['task_name'];
                $tasksList[$i]['username'] = $row['username'];
                $tasksList[$i]['email'] = $row['email'];
                $tasksList[$i]['is_complete'] = $row['is_complete'];
                $i++;
            }

        }
        return $tasksList;
    }

    public static function getTotalTasks()
    {

        $db = Db::getConnection();

        $result = $db->query("SELECT count(id) as count FROM task_list");
        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }

    public static function add($taskName, $taskText)
    {

        $db = Db::getConnection();

        $sql = 'INSERT INTO task_list (task_name , task_text , user_id) '
            . 'VALUES (:task_name,:task_text , 4)';

        $result = $db->prepare($sql);
        $result->bindParam(':task_name', $taskName, \PDO::PARAM_STR);
        $result->bindParam(':task_text', $taskText, \PDO::PARAM_STR);

        return $result->execute();
    }

    public static function taskComplete($taskId)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE task_list SET is_complete = 1 WHERE id = :taskId';

         $result = $db->prepare($sql);
         $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);

        return $result->execute();
    }

    public static function taskRollback($taskId)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE task_list SET is_complete = 0 WHERE id = :taskId';

         $result = $db->prepare($sql);
         $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);

        return $result->execute();
    }

    public static function taskEdit($taskId)
    {
        $db = Db::getConnection();

//        $sql = 'UPDATE task_list SET is_complete = 0 WHERE id = :taskId';
//
//         $result = $db->prepare($sql);
//         $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);
//
//        return $result->execute();
    }

    public static function taskDelete($taskId)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM app.task_list WHERE id = :taskId';

        $result = $db->prepare($sql);
        $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);

        return $result->execute();
    }
}