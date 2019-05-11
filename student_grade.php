<?php
    include("header.php");

    if(isset($_COOKIE["login"])){
        $servername = "localhost";
        $dbname = "nightmarket";
        $account = "root";
        $password = "1234";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $account, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT * FROM lesson_stu_list WHERE student_id = :uid"); //prepareStatement

        $stmt->bindParam(':uid', $user_id); //加入參數

        $stmt->execute(); //執行查詢

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/table.css">
    <title>夜市學堂-成績單</title>
</head>

<body>
    <div class="loginbg">
        <div class="container">
            <div class="row">
                <table class="table table-radius">
                    <thead>
                        <tr>
                            <th colspan="2">
                                <div class="table-title">上課成果表</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <th>課程名稱</th>
                            <th>完成時間</th>
                        </tr>
                        <?php
                foreach ($result as $key) {
                    echo "<tr>";
                        echo "<td>".$key['lesson_name']."</td>";
                        echo "<td aling='right'>".$key['lesson_time']."</td>";
                    echo "</tr>";
                }
            ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><button type="button" class="btn btn-info btn-lg btn-block"><a class="return" href=".">回首頁</a></button></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>

</html>