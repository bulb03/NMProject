<?php 
    include("header.php");

    if(isset($_COOKIE["login"])){
        //抓 id 跟 圖片
        $servername = "localhost";
        $dbname = "nightmarket";
        $account = "root";
        $password = "1234";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $account, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT * FROM app_user WHERE uid = :uid"); //prepareStatement

        $stmt->bindParam(':uid', $user_id); //加入參數

        $stmt->execute(); //執行查詢

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/info.css">
    <title>夜市學堂</title>
</head>

<body>
    <div class="loginbg">
        <div class="container">
            <div class="row">
                <div class="info shadow">
                    <div class="text">
                        <h4 class="dblue-text">Hi,<?php echo $result[0]['nickname']?></h4>
                        <p>歡迎來到夜市學堂<br>請點選下方小卡進行操作</p>
                    </div>
                    <div class="arrow dblue-arrow"></div>
                    <div class="block shadow dblue-bg">
                        <div class="letter dblue-text">
                            <img class="rounded-circle people-img"
                                src="<?php echo $result[0]['pic_url']?>" alt="people-img"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner row w-100 mx-auto">
                        <div class="carousel-item col-xs-12 col-md-4 active">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="http://placehold.it/800x600/f44242/fff"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title"><a href="class.html">上課報到</a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item col-xs-12 col-md-4">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="http://placehold.it/800x600/418cf4/fff"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title"><a href="student_grade.php">上課時數表</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>