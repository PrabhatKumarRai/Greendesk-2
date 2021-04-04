<?php

require_once __DIR__.'/db.class.php';

class Folder extends Db{
    
    //----------Get All Folder----------//
    public function getAllfolder($c_id){
        $sql = "SELECT * FROM folder WHERE c_id=? ORDER BY position;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $c_id);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows < 1){
                return '';   //No Records Exists
            }
            else{
                return $result;    //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }
    
    //----------Get Single Folder By Name----------//
    public function getSignlefolder($name){
        $sql = "SELECT * FROM folder WHERE name=?;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $name);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows < 1){
                return '';   //No Records Exists
            }
            else{
                return $result;    //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }
    
    //----------Get Single Folder By ID----------//
    public function getSignlefolderByID($id){
        $sql = "SELECT * FROM folder WHERE f_id=?;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows < 1){
                return '';   //No Records Exists
            }
            else{
                return $result;    //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }

}