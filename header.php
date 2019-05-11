<?php 
    if(!isset($_COOKIE["login"])){
            header("Location: ./login_form.php"); 
    }else{  
        $user_id = $_COOKIE["login"];
    } 
?>