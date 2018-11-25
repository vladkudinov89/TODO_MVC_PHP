<?php

namespace Models;

use Components\Db;

class TasksList
{

    public static function getTaskLists(): array
    {
        $db = Db::getConnection();

        $tasksList = array();

        $result = $db->query(
            '
        SELECT
        u.username , u.email ,
        t.task_name , t.task_img, t.is_complete , t.id as task_id
        FROM task_list as t
        LEFT JOIN users u
           on u.id = t.user_id'
        );
        if ($result) {
            $i = 0;
            while ($row = $result->fetch()) {
                $tasksList[$i]['task_id'] = $row['task_id'];
                $tasksList[$i]['task_name'] = $row['task_name'];
                $tasksList[$i]['username'] = $row['username'];
                $tasksList[$i]['email'] = $row['email'];
                $tasksList[$i]['task_img'] = $row['task_img'];
                $tasksList[$i]['is_complete'] = $row['is_complete'];
                $i++;
            }

        }
        return $tasksList;
    }

    public static function add($taskName, $taskText, $task_img)
    {

        $db = Db::getConnection();

        $sql = 'INSERT INTO task_list(task_name, task_text, user_id, task_img) '
            . 'VALUES(:task_name,:task_text , 4 , :task_img)';

        $result = $db->prepare($sql);
        $result->bindParam(':task_name', $taskName, \PDO::PARAM_STR);
        $result->bindParam(':task_text', $taskText, \PDO::PARAM_STR);
        $result->bindParam(':task_img', $task_img, \PDO::PARAM_STR);

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

        $sql = 'DELETE FROM app . task_list WHERE id = :taskId';

        $result = $db->prepare($sql);
        $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);

        return $result->execute();
    }
}