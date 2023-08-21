<?php 


class Doctors extends Model{
    
    public function getJoin($filter = true){
        $query = "SELECT doctors.*,
        majors.title
        FROM doctors
        INNER JOIN majors
        ON majors.id = doctors.major_id
        WHERE $filter
        ORDER BY id DESC";
        $stmt  = $this->connect()->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    function getPaginateJoin($filter = true, $start_from, $results_per_page)
    {
        $query = "SELECT doctors.*,
        majors.title As major_name,
        city.city_name As city_name
        FROM doctors
        INNER JOIN majors
        ON majors.id = doctors.major_id
        INNER JOIN city
        ON city.id = doctors.city_id
        WHERE $filter 
        ORDER BY id desc LIMIT $start_from, $results_per_page";
        $stmt  = $this->connect()->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }



    
}