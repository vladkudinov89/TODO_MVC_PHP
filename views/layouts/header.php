<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BeeJee</title>
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/css/font-awesome.min.css" rel="stylesheet">
    <link href="/template/css/main.css" rel="stylesheet">

</head><!--/head-->

<body>
<div class="container">
    <header id="header"><!--header-->

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">BeeJee</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (\Models\User::isGuest()) : ?>
                        <li><a href="/user/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <!--                        <li><a href="/user/register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
                    <?php else: ?>
                        <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="/template/images/home/logo.png" alt=""/></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->


    </header>