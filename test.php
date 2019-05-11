<?php
	$id = $_COOKIE["login"];

	$ans = $_GET['id'];
    $ans2 = $_GET['name'];
	
    date_default_timezone_set("Asia/Taipei");
 	$start = date("Y-m-d H:i:s"); 

    $servername = "localhost";
    $dbname = "nightmarket";
    $account = "root";
    $password = "1234";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $account, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $search_ = $conn->prepare("SELECT * FROM lesson_stu_list WHERE student_id = :student_id and lesson_id = :lesson_id");
    $search_->bindParam(':student_id', $id);
    $search_->bindParam(':lesson_id', $ans);
    $search_->execute();
    $default_ = $search_->fetchAll(PDO::FETCH_ASSOC);

    if($default_){
        echo "已註冊，請勿重複註冊";
        header("Refresh:1,url=./index.php");
    }
    else{
        $stmt = $conn->prepare("INSERT INTO lesson_stu_list(student_id,lesson_id,lesson_name,lesson_time) VALUE(:student_id,:lesson_id,:lesson_name,:lesson_time)");

        $stmt->bindParam(':student_id', $id);
        $stmt->bindParam(':lesson_id', $ans);
        $stmt->bindParam(':lesson_name', $ans2);
        $stmt->bindParam(':lesson_time', $start);

        $stmt->execute();

        echo "註冊成功";
        header("Refresh:1,url=./index.php");
    }
?>