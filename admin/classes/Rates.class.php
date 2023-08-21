<?php


class Rates extends Model{
    function getJoin($filter = true)
    {
        $query = "SELECT rates.*,
        sum(rate) AS sum_of_rate,
        doctors.name As doctor_name,
        majors.title As major_name
        FROM rates
        INNER JOIN doctors
        ON doctors.id = rates.doctor_id
        INNER JOIN majors
        ON majors.id = doctors.major_id
        WHERE $filter
        group by doctors.name ORDER BY sum_of_rate desc";
        $stmt  = $this->connect()->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}