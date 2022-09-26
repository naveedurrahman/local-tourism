<?php

class like
{
    function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        try {
            $this->db = new PDO("mysql:host=$servername;dbname=local_tourism", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function likePost()
    {
        try {
            $post_id = $_POST['post_id'];
            $user_id = $_POST['user_id'];

            $query = "INSERT INTO likes(user_id,post_id) VALUES(?,?)";
            $stmt = $this->db->prepare($query);
            $resp = $stmt->execute(array($user_id, $post_id));

            if ($resp)
                return "ok";
            else
                return 'error occure';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    function unlikePost()
    {
        try {
            $post_id = $_POST['post_id'];
            $user_id = $_POST['user_id'];

            $query = "DELETE from likes Where post_id = ? and user_id = ?";
            $stmt = $this->db->prepare($query);
            $resp = $stmt->execute(array($post_id, $user_id));

            if ($resp)
                return 'ok';
            else
                return 'error occure';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    function getAuthUserLikes($user_id, $post_id)
    {
        try {
            $query = "SELECT * From likes Where likes.user_id=? and likes.post_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute(array($user_id, $post_id));

            return $stmt->rowCount();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    function getSinglePostLikes($post_id)
    {
        try {
            $query = "SELECT * From likes where likes.post_id=? ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(array($post_id));

            return $stmt->rowCount();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
