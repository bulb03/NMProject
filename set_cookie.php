<?php
    // DB參數
    $servername = "localhost";
    $dbname = "nightmarket";
    $account = "root";
    $password = "1234";
    $db_success = false;
    $register_time = date("Y-m-d H:i:s");

    if(isset($_REQUEST["code"])) {
        //Line登入
        $line_code = $_REQUEST["code"];
        $url_post = "https://api.line.me/oauth2/v2.1/token";
        $post_data = array("grant_type"=>"authorization_code", "redirect_uri"=>"http://localhost/nightmarket/set_cookie.php", "client_id"=>"1571656432", "client_secret"=>"513078c229d86174b59e99f2b844ca41", "code"=>$line_code);
        $headers_post = array("Content-Type"=>"application/x-www-form-urlencoded");
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_post);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_post);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json_data = curl_exec($ch);
        curl_close($ch);
        
        //access_token
        $decode_json_data = json_decode((string)$json_data, true);
        $access_token = $decode_json_data['access_token'];
        
        //user_data
        $url_get = "https://api.line.me/v2/profile";
        $headers_get = array("Authorization: Bearer ".$access_token);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_get);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_get);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $user_data = curl_exec($ch);
        curl_close($ch);

        $decode_user_data = json_decode((string)$user_data, true);

        $uid = $decode_user_data['userId'];
        $nickname = $decode_user_data['displayName'];
        $pic_url = $decode_user_data['pictureUrl'];

        

        //////////////////Line////////////////////
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $account, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT * FROM app_user WHERE uid = :uid LIMIT 1"); //prepareStatement

        $stmt->bindParam(':uid', $uid); //加入參數

        $stmt->execute(); //執行查詢

        $if_id_exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if($if_id_exist){
            //do nothing
            $db_success = true;
        } else {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $account, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO app_user (uid, nickname, pic_url, register_time) VALUES (:uid, :nickname, :pic_url, :register_time)"); //prepareStatement

            $stmt->bindParam(':uid', $uid); //加入參數
            $stmt->bindParam(':nickname', $nickname);
            $stmt->bindParam(':pic_url', $pic_url);
            $stmt->bindParam(':register_time', $register_time);

            $stmt->execute(); //執行查詢

            $db_success = true;
        }

        setcookie("login", $uid, time()+2592000);
        

    } else {
        //自訂登入
        
        //產生user_id
        $uid = uniqid(uniqid());
        setcookie("login", $uid, time()+2592000);

        //暱稱
        $nickname = $_REQUEST["nickname"];
        //使用者圖片
        $pic_url = "user_img/".$uid.".jpg";

        if ($_FILES["user_photo"]["error"] > 0){
            echo "<script>window.alert('上傳失敗".$_FILES["user_photo"]["error"]."');</script>";
            echo "<script>location.replace('login_form.php');</script>";
            
        } else {
            if (move_uploaded_file($_FILES['user_photo']['tmp_name'], $pic_url)) {

            } else {
                echo "<script>window.alert('上傳失敗".$_FILES["user_photo"]["error"]."');</script>";
                echo "<script>location.replace('login_form.php');</script>";
            }
        }

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $account, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO app_user (uid, nickname, pic_url, register_time) VALUES (:uid, :nickname, :pic_url, :register_time)"); //prepareStatement

        $stmt->bindParam(':uid', $uid); //加入參數
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':pic_url', $pic_url);
        $stmt->bindParam(':register_time', $register_time);

        $stmt->execute(); //執行查詢

        $db_success = true;
    } 

    
    

    
    if($db_success) {
        header("Location: ./index.php"); 
    } else {
        echo "<script>window.alert('註冊失敗');</script>";
        echo "<script>location.replace('login_form.php');</script>";
    }
   
    
?>