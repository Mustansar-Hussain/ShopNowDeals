<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="<?php echo $res_url; ?>/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- styles -->
        <link href="<?php echo $res_url; ?>/admin/css/styles.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-bg">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Logo -->
                        <div class="logo">
                            <h1><a href="<?php echo site_url("/"); ?>">ShopNowDeals</a></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-wrapper">
                        <div class="box">
                            <div class="content-wrap">
                                <h6>Sign In</h6>
                                <div class="social">
                                    <?php
                                    $error = $this->session->flashdata("error");
                                    if(!empty($error)) {
                                        ?>
                                        <div class="alert alert-danger fade in">
                                            <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close" title="close">*</a>
                                             <h4><?php echo $error; ?></h4>
                                        </div>
                                   <?php } ?>
                                </div>
                                <form action="<?php echo site_url("admin/login/validate"); ?>" method="post">
                                    <input class="form-control" type="text" name="user_name" placeholder="User Name" required="true">
                                    <input class="form-control" type="password" name="password" placeholder="Password" required="true">
                                    <div class="action">
                                        <button class="btn btn-primary signup" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo $res_url; ?>/admin/js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo $res_url; ?>/admin/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $res_url; ?>/admin/js/custom.js"></script>
    </body>
</html>