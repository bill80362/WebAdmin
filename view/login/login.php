<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>管理系統</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="/css/floating-labels.css" rel="stylesheet">
</head>
<body>
<form class="form-signin" action="/login" method="post">
    <div class="text-center mb-4">
        <img class="mb-4" src="" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">管理系統登入</h1>
        <p>請輸入您的登入資料，有問題洽0912-345678</p>
    </div>

    <div class="form-label-group">
        <input type="text" name="Account" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputEmail">帳號</label>
    </div>

    <div class="form-label-group">
        <input type="password" name="Password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">密碼</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2020</p>
</form>
</body>
</html>
