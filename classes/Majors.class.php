<?php 


class Majors extends Model{

    function getPaginateJoin($start_from, $results_per_page)
    {        
        $query = "SELECT majors.*, doctors.id AS doctor_id
        FROM majors, doctors
        WHERE majors.id = doctors.major_id
        ORDER BY id desc LIMIT $start_from, $results_per_page";
        $stmt  = $this->connect()->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }


}

