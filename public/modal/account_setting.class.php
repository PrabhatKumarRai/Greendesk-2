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

}