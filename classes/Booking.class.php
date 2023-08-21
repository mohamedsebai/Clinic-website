<?php 


class Booking extends Model{
    
    public function getJoin($filter = true){
        $query = "SELECT booking.*,
        majors.title,
        doctors.id AS doctor_id,
        doctors.name,
        doctors.doctor_img
        FROM booking
        INNER JOIN doctors
        ON booking.doctor_id = doctors.id
        INNER JOIN majors
        ON doctors.major_id = majors.id
        WHERE $filter
        ORDER BY doctors.name DESC";
        $stmt  = $this->connect()->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}