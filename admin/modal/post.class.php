<?php

require_once __DIR__.'/db.class.php';

class Post extends Db{
    
    //-------------------------------INSERT OPERATION-------------------------------//

    //Create Post Method Section
    public function InsertPost($title, $content, $tags, $c_id, $f_id, $position, $draft="0"){
        $sql = "INSERT INTO posts (title, content, tags, c_id, f_id, draft, position) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssiiii', $title, $content, $tags, $c_id, $f_id, $draft, $position);

        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    //Draft Post Method Section
    public function DraftPost($title, $content, $tags, $c_id, $f_id, $draft='1', $position){
        $sql = "INSERT INTO posts (title, content, c_id, f_id, tags, draft, position) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssiiii', $title, $content, $tags, $c_id, $f_id, $draft, $position);

        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }


    //-------------------------------SELECT OPERATION-------------------------------//

    //Read All Post Method Section
    public function ReadAllPost(){
        $sql = "SELECT * FROM posts ORDER BY position;";
        
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
    
    //Read All Post Reverse Method Section
    public function ReadAllPostReverse($f_id){
        $sql = "SELECT * FROM posts WHERE f_id=? ORDER BY position;";

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

    //Read All Post By Category Method Section
    public function ReadAllPostByCategory($c_id){
        $sql = "SELECT * FROM posts WHERE c_id=$c_id;";
        
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

    //Read Single POST Method Section
    public function ReadSinglePost($post_id){
        $sql = "SELECT * FROM posts WHERE post_id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $post_id);

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

    //Read Latest Post Method Section
    public function ReadLatestPost(){
        $sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 1;";
        
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

    //Read Draft Post Method Section
    public function ReadDraftPost(){
        $sql = "SELECT * FROM posts WHERE draft=1 ORDER BY post_id DESC;";
        
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

    //Count Total Views method section
    public function ViewCount(){
        $sql = "SELECT sum(views) as view FROM posts;";
        
        if($result = $this->conn->query($sql)){
            return $result;       //Success
        }
        else{
            return '0';       //SQL ERROR
        }
    }

    //-------------------------------UPDATE OPERATION-------------------------------//

    //Update Post Method Section
    public function UpdatePost($id, $title, $content, $tags, $draft='0', $c_id, $f_id){
        $sql = "UPDATE posts SET title=?, content=?, tags=?, draft=?, c_id=?, f_id=? WHERE post_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssiiii', $title, $content, $tags, $draft, $c_id, $f_id, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    
    //Update Post Draft Method Section
    public function UpdatePostDraft($id, $title, $content, $tags, $draft='1', $c_id, $f_id){
        $sql = "UPDATE posts SET title=?, content=?, tags=?, draft=?, c_id=?, f_id=? WHERE post_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssiiii', $title, $content, $tags, $draft, $c_id, $f_id, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //Update Post Position
    public function updatePostPosition($position, $id){
        $sql = "UPDATE posts SET position=? WHERE post_id=?;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $position, $id);
        
        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    //Update Post Category
    public function updatePostCategory($c_id, $f_id){
        $sql = "UPDATE posts SET c_id=? WHERE f_id=?;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $c_id, $f_id);
        
        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    
    //-------------------------------DELETE OPERATION-------------------------------//

    //Delete Single Post Method Section
    public function DeletePost($id){
        $sql = "DELETE FROM posts WHERE post_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }
}