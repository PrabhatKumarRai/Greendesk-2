<?php

require_once __DIR__.'/db.class.php';


class Users extends Db{


    //--------------------------- Read Operation ---------------------------//
    
    //Read All Users Data Method
    public function ReadAllUser(){
        $sql = "SELECT * FROM users;";
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';       //No Records Found   
            }
            else{
                return $result;     //Success
            }
        }
        else{
            return '0';       //SQL Error
        }
    }

    //Read Single User Data Method
    public function ReadSingleUser($parameter, $value){
        $sql = "SELECT * FROM users WHERE $parameter=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $value);

        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows < 1){
                return '';       //No Records Found   
            }
            else{
                return $result;     //Success
            }
        }
        else{
            return '0';       //SQL Error
        }
    }

    //Select User based on username & Password (***** Login Method *****)
    public function ReadSingleUserLogin($username, $password){
        $sql = "SELECT * FROM users WHERE u_uname=? AND u_pass=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $username, $password);

        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows < 1){
                return '';       //No Records Found   
            }
            else{
                return $result;     //Success
            }
        }
        else{
            return '0';       //SQL Error
        }
    }


    //--------------------------- Update Operation ---------------------------//

    //Update Social Info Method
    public function UpdateUserSocialInfo($id, $facebook, $twitter, $instagram, $email){
        $sql = "UPDATE users SET u_facebook=?, u_twitter=?, u_instagram=?, u_email=? WHERE u_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssi', $facebook, $twitter, $instagram, $email, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //Update Privacy Info Method
    public function UpdateUserPrivacyInfo($id, $password){
        $sql = "UPDATE users SET u_pass=? WHERE u_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $password, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }


}