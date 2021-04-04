<?php

require_once __DIR__.'/db.class.php';

class Account_Setting extends Db {

    // Get Account Setting
    public function GetAccountSetting(){
        $sql = "SELECT * FROM account_setting;";

        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';
            }
            else{
                return $result;
            }
        }
        else{
            return '0';
        }
    }

    //Update Account Setting
    public function UpdateAccountSetting($organization, $logo, $logo_local_path, $contact, $email, $facebook, $twitter, $instagram){
        $sql = "UPDATE account_setting SET organization=?, logo=?, logo_local_path=?, contact=?, email=?, facebook=?, twitter=?, instagram=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssissss', $organization, $logo, $logo_local_path, $contact, $email, $facebook, $twitter, $instagram);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //Remove Logo
    public function RemoveLogo(){
        $sql = "UPDATE account_setting SET logo='', logo_local_path='';";

        if($this->conn->query($sql)){
            return 1;
        }
        else{
            return 0;
        }
    }

}