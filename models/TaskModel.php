<?php

class TaskModel extends Model
{

    public function getTaskById($id)
    {
        $result = array();
        $sql = "SELECT id, 
                       content, 
                       is_done
                  FROM task 
                 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        if (!$stmt)
            return false;
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function saveTaskInfo($id, $content, $is_done)
    {
        $sql = "UPDATE task
                   SET is_edited = CASE 
                                     WHEN content != :content OR is_done != :is_done THEN 1
                                     ELSE 0
                                   END,
                       content = :content, 
                       is_done = :is_done
                  WHERE id = :id
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":is_done", $is_done, PDO::PARAM_INT);
        $stmt->bindValue(":content", $content);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        if (!$stmt)
            return false;
        else
            return true;
    }


    public function addTask($user, $email, $content)
    {
        $sql = "INSERT INTO 
                  task (user, email, content)
                VALUES
                   (:user, :email, :content)
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":content", $content);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":user", $user);
        $stmt->execute();
        if (!$stmt)
            return false;
        else
            return true;
    }

}

?>
