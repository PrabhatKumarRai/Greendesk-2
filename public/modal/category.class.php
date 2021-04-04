<?php

require_once __DIR__.'/db.class.php';

class Category extends Db{

    //----------Get All Category----------//
    public function getAllCategory(){
        $sql = "SELECT * FROM category ORDER BY position asc;";
        
        if($result = $this->conn->query($sql)){
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

    //----------Get Single Category By Name----------//
    public function getSingleCategory($name){
        $sql = "SELECT * FROM category WHERE name=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $name);

        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }

    //----------Get Single Category By ID----------//
    public function getSingleCategoryByID($id){
        $sql = "SELECT * FROM category WHERE c_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }

}