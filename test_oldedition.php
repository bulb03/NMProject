<?php
	$id = $_COOKIE["login"];

	$ans = $_GET['data'];
	$data_arr = json_decode($ans,true);
	
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
        $search = $conn->prepare("SELECT * FROM lesson WHERE lesson_id = :lesson_id");
        $search->bindParam(':lesson_id', $ans);
        $search->execute();
        $default = $search->fetchAll(PDO::FETCH_ASSOC);

        if(strtotime($start) >= strtotime($default[0]['start_time']) && strtotime($start) <= strtotime($default[0]['end_time'])){
            $stmt = $conn->prepare("INSERT INTO lesson_stu_list(student_id,lesson_id,lesson_name,lesson_time) VALUE(:student_id,:lesson_id,:lesson_name,:lesson_time)");

            $stmt->bindParam(':student_id', $id);
            $stmt->bindParam(':lesson_id', $ans);
            $stmt->bindParam(':lesson_name', $default[0]['lesson_name']);
            $stmt->bindParam(':lesson_time', $start);

            $stmt->execute();

            echo "註冊成功";
            header("Refresh:1,url=./index.php");
        }
        else{
            echo "因您的時間因素，故無法註冊課程";
            header("Refresh:1,url=./index.php");
        }

    }
?>