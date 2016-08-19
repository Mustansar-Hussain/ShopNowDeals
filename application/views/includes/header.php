<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php if (!empty($page_title)) echo $page_title; ?></title>
        <link href="<?php  echo $res_url; ?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php  echo $res_url; ?>css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php  echo $res_url; ?>css/slick-theme.css">
        <link rel="stylesheet" type="text/css" href="<?php  echo $res_url; ?>css/slick.css">
        <link rel="stylesheet" type="text/css" href="<?php  echo $res_url; ?>css/style.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <header>
            <div class="header_top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="social_box">
                                <a href="javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a><a href="javascript:void(0)"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container">
                    <div class="row">
                        <div class="logo_box">
                            <a href="javascript:void(0)"><img src="<?php  echo $res_url;  ?>images/logo.png" width="215" height="56" alt=""/></a>
                        </div>
                        <div class="nav_box clearfix">
                            <div class="top_nav_container">                
                                <ul class="topnav" id="myTopnav">
                                    <li><a class="active" href="javascript:void(0)">Home</a></li>
                                    <li><a href="javascript:void(0)">Circulars</a></li>
                                    <li><a href="javascript:void(0)">Weekly Deals</a></li>
                                    <li><a href="javascript:void(0)">Top Deals</a></li>
                                    <li><a href="javascript:void(0)">Featured Deals</a></li>
                                    <li class="icon">
                                        <a href="javascript:void(0);" style="font-size:18px;" onclick="myFunction()"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="digital_version">Digital Version</button>
                        </div>
                    </div>        
                </div>    
            </div>
        </header>
