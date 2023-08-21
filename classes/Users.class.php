<?php 


class users extends Model{



    public function login($email,$role,$password){
        $userData = $this->get(filter: "email = '$email' AND role = '$role'");
        if(!empty($userData)){
            if($userData[0]['email'] == $email){
                if(password_verify($password, $userData[0]['password'])){
                    $_SESSION['role_user']          = 'role_user';
                    $_SESSION['role_user_email']    = $userData[0]['email'];
                    $_SESSION['role_user_username'] = $userData[0]['username'];
                    $_SESSION['role_user_phone']    = $userData[0]['phone'];
                    $_SESSION['role_user_user_id']  = $userData[0]['id'];
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