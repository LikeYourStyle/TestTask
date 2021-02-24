<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $pageData['title']; ?></title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<header>
</header>

<div id="content">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!------ Include the above in your HEAD tag ---------->

    <!-- no additional media querie or css is required -->
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form id="form-singin" action="" method="post" autocomplete="off">
                            <?php if (!empty($pageData['loginError'])) : ?>
                                <p><?php echo $pageData['loginError'] ?></p>
                            <?php endif; ?>

                            <div class="form-group">
                                <input type="text" class="form-control" name="login" id="login" placeholder="Логин"
                                       required/>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="Пароль" required/>
                            </div>
                            <button type="submit" id="sendlogin" class="btn btn-primary">Войти</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
</footer>
<script src="/js/jquery.js"></script>
<script src="/js/angular.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
