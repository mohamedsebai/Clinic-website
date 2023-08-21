<?php 


class Booking extends Model{
    
    public function getJoin($filter = true){
        $query = "SELECT booking.*,
        majors.title,
        doctors.id AS doctor_id,
        doctors.name
        FROM booking
        INNER JOIN doctors
        ON booking.doctor_id = doctors.id
        INNER JOIN majors
        ON doctors.major_id = majors.id
        WHERE $filter
        ORDER BY id DESC";
        $stmt  = $this->connect()->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function getPaginateJoin($filter = true,$start_from, $results_per_page){
        $query = "SELECT booking.*,
        majors.title AS major_title,
        doctors.id AS doctor_id,
        doctors.name AS doctor_name
        FROM booking
        INNER JOIN doctors
        ON booking.doctor_id = doctors.id
        INNER JOIN majors
        ON doctors.major_id = majors.id
        WHERE $filter
        ORDER BY id desc LIMIT $start_from, $results_per_page";
        $stmt  = $this->connect()->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

}