<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>夜市學堂 - 登入</title>
</head>

<body>
    <div class="loginbg">
        <div class="container">
        <div class="row">
            <div class="col text-center">
            <div class="logo">
                <img src="./assets/imgs/login.png" alt="">
            </div>
            <div class="mb-3">
                <h2>夜市學堂</h2>
            </div>
            <form enctype="multipart/form-data" action="set_cookie.php" method="POST">
                <div class="form-group">
                    <input type="text" class="btn-lg btn-block form-control" name="nickname" id="nickname" placeholder="請填入您的暱稱" required>
                </div>
                <div class="form-group">
                    <input type="file" class="btn-lg btn-block form-control" name="user_photo" id="user_photo" placeholder="請上傳圖片" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block" style="color:white;">
                  開始上課</button>
                <button type="button" class="btn btn-lg btn-block line" onclick="LineAuth()">Line 登入</button>
            </form>
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
    <script>
        function LineAuth() {
            var URL = 'https://access.line.me/oauth2/v2.1/authorize?';
            URL += 'response_type=code';
            URL += '&client_id=1571656432';
            URL += '&redirect_uri=http://localhost/nightmarket/set_cookie.php';
            URL += '&state=abcde';
            URL += '&scope=openid%20profile';
            window.location.href = URL;
        }
    </script>
</body>
</html>