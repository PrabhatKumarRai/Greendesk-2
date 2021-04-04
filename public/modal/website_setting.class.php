<?php

require_once __DIR__.'/db.class.php';

class Website_setting extends Db{
    
    //Get Website Setting
    public function GetWebsiteSetting(){
        $sql = "SELECT * FROM website_setting";

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