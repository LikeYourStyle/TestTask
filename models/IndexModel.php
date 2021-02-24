<?php

class IndexModel extends Model
{

    public function getTaskCount()
    {
        $sql = "SELECT count(*) as count FROM task";
        $result = array();
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        if (!$stmt)
            return false;

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public function getLimitTasks($leftLimit, $rightLimit, $sortColumn, $sortDirect)
    {
        switch ($sortColumn) {
            case "user" :
            case "email" :
            case "is_done" :
                break;
            default:
                $sortColumn = "id";
        }
        switch ($sortDirect) {
            case "asc" :
            case "desc" :
                break;
            default:
                $sortDirect = "desc";
        }

        $result = array();
        $sql = "SELECT task.id,
                       task.user,
                       task.email,
                       task.content,
                       task.is_done,
                       task.is_edited 
                FROM task
                order by $sortColumn $sortDirect
                LIMIT $leftLimit, $rightLimit";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        if (!$stmt)
            return false;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }

        return $result;
    }
}
