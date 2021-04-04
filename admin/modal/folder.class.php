<?php

require_once __DIR__.'/db.class.php';

class Folder extends Db{

    //----------Insert Section----------//
    public function insertfolder($folder, $c_id, $position=0, $visibility=1){
        $sql = "INSERT INTO folder (name, c_id, position, visibility) VALUES (?, ?, ?, ?);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('siii', $folder, $c_id, $position, $visibility);
        
        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    //----------Select Section----------//
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

    public function getTotalfolder(){
        $sql = "SELECT * FROM folder;";

        $stmt = $this->conn->prepare($sql);
        
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

    //----------Update Section----------//
    public function updatefolder($name, $c_id, $f_id, $visibility){
        $sql = "UPDATE folder SET name=?, c_id=?, visibility=? WHERE f_id=?;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('siii', $name, $c_id, $visibility, $f_id);
        
        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    //Update Folder Position
    public function updateFolderPosition($position, $id){
        $sql = "UPDATE folder SET position=? WHERE f_id=?;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $position, $id);
        
        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    //----------Delete Section----------//

    //Delete Single FOlder
    public function deletefolder($id){
        $sql1 = "DELETE FROM folder WHERE f_id=?;";
        $sql2 = "DELETE FROM posts WHERE f_id=?;";

        $stmt1 = $this->conn->prepare($sql1);
        $stmt2 = $this->conn->prepare($sql2);

        $stmt1->bind_param('i', $id);
        $stmt2->bind_param('i', $id);
        
        if($stmt1->execute() && $stmt2->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

}