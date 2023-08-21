<?php 


class Majors extends Model{
    function getPaginateJoin($filter = true, $start_from, $results_per_page)
    {
        $query = "SELECT majors.*,
        doctors.id As doctor_id
        FROM majors
        INNER JOIN doctors
        ON doctors.major_id = majors.id 
        WHERE $filter 
        ORDER BY id desc LIMIT $start_from, $results_per_page";
        $stmt  = $this->connect()->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}

