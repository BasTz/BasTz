<?php
    include_once "dbcontrol.php";
    include_once "util.php";

    $debug_mode = false;

    if($_SERVER['REQUEST_METHOD']=='GET'){
        debug_text("For GET Method",$debug_mode);
        echo json_encode(show_data($debug_mode));
    }
    else if($_SERVER['REQUEST_METHOD']=='POST'){
        debug_text("For POST Method",$debug_mode);
        if(isset($_POST["u_id"]) && isset($_POST["u_name"])){
            $u_id = $_POST["u_id"];
            $u_name = $_POST["u_name"];
            insert_newdata($u_id,$u_name,$debug_mode);
            echo json_encode(show_data($debug_mode));
        }
        else if(isset($_POST["id"])){
            $id = $_POST["id"];
            delete_data($id,$debug_mode);
            echo json_encode(show_data($debug_mode));
        }
    }
    else{
        debug_text("Error Unknown this Request",$debug_mode);
        http_response_code(405);
    }

    function show_data($debug_mode){   
        $my_db = new db("root",null,"book",$debug_mode);
        $data = $my_db->sel_data("select * from user");
        $my_db->close();
        return $data;
    }

    function insert_newdata($new_id,$new_name,$debug_mode){
        $my_db = new db("root",null,"book",$debug_mode);
        $sql = "INSERT INTO user(id, name) VALUES ({$new_id},{$new_name})";
        $data = $my_db->query($sql);
        $my_db->close();
    }

    function delete_data($id,$debug_mode){
        $my_db = new db("root",null,"book",$debug_mode);
        $sql = "DELETE FROM `user` WHERE id={$id}";
        $data = $my_db->query($sql);
        $my_db->close();
    }
?>