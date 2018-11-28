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
        FROM
        task_list as t
        LEFT JOIN users u
           on u.id = t.user_id
        order by t.id DESC
        '
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

        $userIDAddTask = !User::isGuest() ? 1 : 4;

        $sql = 'INSERT INTO task_list(task_name, task_text, user_id, task_img) '
            . 'VALUES(:task_name,:task_text ,' . $userIDAddTask . ' , :task_img)';

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

    public static function taskEdit($taskId , $task_name , $task_text)
    {
        $db = Db::getConnection();

        $sql = "UPDATE task_list SET task_name=:task_name , task_text=:task_text WHERE id=:taskId";
        $result = $db->prepare($sql);
        $result->bindParam(':task_name', $task_name, \PDO::PARAM_STR);
        $result->bindParam(':task_text', $task_text, \PDO::PARAM_STR);
        $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);

        return $result->execute();

    }

    public static function taskDelete($taskId)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM app . task_list WHERE id = :taskId';

        $result = $db->prepare($sql);
        $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getCurrentTask($taskID)
    {
        $db = Db::getConnection();

        $taskStore = array();

        $result = $db->query('SELECT * FROM app.task_list WHERE id = ' . $taskID);
        if ($result) {
            while ($row = $result->fetch()) {
                $taskStore['id'] = $row['id'];
                $taskStore['task_name'] = $row['task_name'];
                $taskStore['task_text'] = $row['task_text'];
            }
        }
        return $taskStore;
    }
}