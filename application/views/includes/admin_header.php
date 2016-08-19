<!DOCTYPE html>
<html>
    <head>
        <title><?php if(!empty($page_title)) echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="<?php echo $res_url; ?>/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- styles -->
        <link href="<?php echo  $res_url; ?>/admin/css/styles.css" rel="stylesheet">
    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- Logo -->
                        <div class="logo">
                            <h1><a href="<?php echo site_url("admin/dashboard");?>">ShopNow Deals</a></h1>
                        </div>
                    </div>
                    <div class="col-md-5">
                       
                    </div>
                    <div class="col-md-2">
                        <div class="navbar navbar-inverse" role="banner">
                            <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                                        <ul class="dropdown-menu animated fadeInUp">
                                            <li><a href="#">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar content-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->
                            <li class="current"><a href="#">Manage Deals</a></li>
                            <li><a href="#">Weekly Deals</a></li>
                            <li><a href="#">Top Deals</a></li>
                            <li><a href="#">Top Companies</a></li>
                        </ul>
                    </div>
                </div>