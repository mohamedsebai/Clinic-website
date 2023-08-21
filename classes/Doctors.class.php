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
        majors.title
        FROM doctors
        INNER JOIN majors
        ON majors.id = doctors.major_id
        WHERE $filter 
        ORDER BY id desc LIMIT $start_from, $results_per_page";
        $stmt  = $this->connect()->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function login($email,$password){
        $doctorData = $this->get(filter: "email = '$email' ");
        if(!empty($doctorData)){
            if($doctorData[0]['email'] == $email){
                if(password_verify($password, $doctorData[0]['password'])){
                    $_SESSION['role_doctor']            = 'role_doctor';
                    $_SESSION['role_doctor_email']      = $doctorData[0]['email'];
                    $_SESSION['role_doctor_name']   = $doctorData[0]['name'];
                    $_SESSION['role_doctor_phone']      = $doctorData[0]['phone'];
                    $_SESSION['role_doctor_doctor_id']  = $doctorData[0]['id'];
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
}