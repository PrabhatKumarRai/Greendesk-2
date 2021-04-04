<?php

require_once __DIR__.'/db.class.php';

class Post extends Db{
    //-----------------Select Section-----------------//
    //Read All Post Method Section
    public function ReadAllPost($f_id){
        $sql = "SELECT * FROM posts WHERE f_id=? AND draft=0 ORDER BY position asc;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $f_id);

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

    //Read Single POST Method Section
    public function ReadSinglePost($title){
        $sql = "SELECT * FROM posts WHERE title = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $title);

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

    //--------Search Post Method Section--------//
    public function SearchPost($search){
        $sql = "SELECT * FROM posts WHERE tags LIKE '%$search%' OR title LIKE '%$search%' ORDER BY post_id DESC;";
        if($result = $this->conn->query($sql)){
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

    //Read Recent Post Method Section
    public function ReadLatestPost(){
        $sql = "SELECT * FROM posts ORDER BY date DESC LIMIT 5;";

        if($result = $this->conn->query($sql)){
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

    //-----------------Update Section-----------------//
    //Update View Count of Post Method Section
    public function updateViews($post_id){
        $sql = "UPDATE posts SET views=views + 1 WHERE post_id=?;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $post_id);

        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }
}
