<?php

require_once __DIR__.'/db.class.php';

class Category extends Db{

    //----------Insert Section----------//
    public function insertCategory($category, $position=0, $visibility=1){
        $sql = "INSERT INTO category(name, position, visibility) VALUES (?, ?, ?);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sii', $category, $position, $visibility);
        
        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    //----------Select Section----------//
    public function getAllCategory(){
        $sql = "SELECT * FROM category ORDER BY position;";
        
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

    //----------Update Section----------//
    public function updateCategory($category, $id, $visibility){
        $sql = "UPDATE category SET name=?, visibility=? WHERE c_id=?;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sii', $category, $visibility, $id);
        
        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    //Update Category Position
    public function updateCategoryPosition($position, $c_id){
        $sql = "UPDATE category SET position=? WHERE c_id=?;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $position, $c_id);
        
        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    //----------Delete Section----------//
    public function deleteCategory($id){
        $sql1 = "DELETE FROM category WHERE c_id=?;";
        $sql2 = "DELETE FROM folder WHERE c_id=?;";
        $sql3 = "DELETE FROM posts WHERE c_id=?;";

        $stmt1 = $this->conn->prepare($sql1);
        $stmt2 = $this->conn->prepare($sql2);
        $stmt3 = $this->conn->prepare($sql3);

        $stmt1->bind_param('i', $id);
        $stmt2->bind_param('i', $id);
        $stmt3->bind_param('i', $id);
        
        if($stmt1->execute() && $stmt2->execute() && $stmt3->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

}