<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/">
    <link rel="icon" href="data:,">
    <title><?php echo $pageData['title']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/css/main/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/main/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/css/main/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Задачи</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="/login/"><i class="fa fa-user fa-fw"></i> Профиль</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="/login/logout"><i class="fa fa-sign-out fa-fw"></i> Выйти</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

            </div>
            <!-- /.sidebar-collapse -->
        </div>
    </nav>

    <div id="page-wrapper" data-ng-app="main" data-ng-controller="mainController">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Статистика</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" data-ng-view></div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Список задач
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>
                                                <a data-ng-click="reloadPage()"
                                                   href="<?php echo $pageData['sortHref'] ?>&sort=user">Пользователь</a>
                                                <a data-ng-click="reloadPage()"
                                                   href="<?php echo $pageData['directHref'] ?>&direct=<?php echo $pageData['reverseDirect'] ?>">
                                                    <img src="/images/sort.png" width="15">
                                                </a>
                                            </th>
                                            <th><a data-ng-click="reloadPage()"
                                                   href="<?php echo $pageData['sortHref'] ?>&sort=email">Email</a>
                                                <a data-ng-click="reloadPage()"
                                                   href="<?php echo $pageData['directHref'] ?>&direct=<?php echo $pageData['reverseDirect'] ?>">
                                                    <img src="/images/sort.png" width="15">
                                                </a>
                                            </th>
                                            <th>Текст задачи</th>
                                            <th><a data-ng-click="reloadPage()"
                                                   href="<?php echo $pageData['sortHref'] ?>&sort=is_done">Выполнено</a>
                                                <a data-ng-click="reloadPage()"
                                                   href="<?php echo $pageData['directHref'] ?>&direct=<?php echo $pageData['reverseDirect'] ?>">
                                                    <img src="/images/sort.png" width="15">
                                                </a>
                                            </th>
                                            <th>Отредактировано администратором</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($pageData['tasksOnPage'] as $value) { ?>
                                            <tr>
                                                <td><?php echo $value['user']; ?></td>
                                                <td><?php echo $value['email']; ?></td>
                                                <td><a data-ng-click="getInfoByTaskId(<?php echo $value['id']; ?>)"
                                                       href="<?php echo $value['id']; ?>">
                                                        <?php echo $value['content']; ?></a></td>
                                                <td>
                                                    <a data-ng-click="getInfoByTaskId(<?php echo $value['id']; ?>)"
                                                       href="<?php echo $value['id']; ?>">
                                                        <input type="checkbox" disabled
                                                               <?php echo $value['is_done'] ? 'checked' : ''; ?>>
                                                    </a>
                                                </td>
                                                <td><input type="checkbox" disabled
                                                           <?php echo $value['is_edited'] ? 'checked' : ''; ?>>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.col-lg-4 (nested) -->
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <?php echo $pageData['pagination']; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="col-lg-12">
                            <form class="form-horizontal" name="addTaskForm" data-ng-submit="addTask()">
                                <legend>Добавить задачу</legend>
                                <div class="form-group">
                                    <label for="newTaskUser" class="col-sm-3">Пользователь</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="newTaskUser" data-ng-model="newTaskUser"
                                               id="newTaskUser" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newTaskEmail" class="col-sm-3">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="newTaskEmail" data-ng-model="newTaskEmail"
                                               id="newTaskEmail" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newTaskContent" class="col-sm-3">Текст задачи</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="newTaskContent" data-ng-model="newTaskContent"
                                               id="newTaskContent" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button class="btn btn-default">Добавить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.panel-body -->

                </div>
                <!-- /.panel -->
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="/js/jquery.js"></script>

<!-- Angular -->
<script src="/js/angular.min.js"></script>
<script src="/js/main/main.js"></script>
<!-- Angular Route -->
<script src="/js/angular-route.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/js/main/metisMenu.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/js/main/sb-admin-2.js"></script>

</body>

</html>
