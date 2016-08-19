<div >
    <div class="container">
        <div class="logo-login">
            <img src="<?php echo $res_url; ?>images/logo.png">
            <h2>Your Online Camp Attendance Management Program</h2>
            <!------ Success Alert  ------> 
            <div class="alert alert-success fade in" style="max-width: 740px;display:none;text-align:center;margin: 0 auto;margin-bottom: 20px;" id="login_success_msg">
                <a href="#" class="close"  data-dismiss="alert" aria-label="close" title="close">×</a>
                <span id="login_success_message">Successfully Logged In.</span>
            </div>
            <!------ Failure Alert  ------> 
            <div class="alert alert-danger fade in" style="max-width: 740px;display:none;text-align:center;margin: 0 auto;margin-bottom: 20px;" id="login_error_msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <span  id="login_error_message">Invalid Username OR Password.</span>
            </div>
            <?php $error_message = $this->session->flashdata("error_message"); ?> 
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger fade in" style="max-width:740px;text-align:center;margin: 0 auto;margin-bottom: 20px;" id="login_error_msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <span  id="login_error_message"><?php echo $error_message; ?></span>
                </div>
            <?php } ?>
            <div class="loginbox">
                <h3>WELCOME BACK</h3>
                <form id="login_form" action="<?php  echo remove_http(site_url("auth/validate"));  ?>" method="post">
                    <div class="logincls">
                        <span> <img src="<?php echo $res_url; ?>images/uname.png"> </span>
                        <input type="text" name="username" placeholder="Username" id="Username">
                        <span> <img src="<?php echo $res_url; ?>images/password.png"> </span>
                        <input type="password" name="password" placeholder="Password" id="Password">
                    </div>
                    <div class="clear"></div>
                    <input type="submit"id="submit_login1" value="Login">
                </form>
            </div><!---->
            <p class="rememberc hidden"><input type="checkbox" id="remember" > <label for="remember">Remember me</label></p>
        </div>
    </div><!--cont-->
</div><!--mainbg-->
<script type="text/javascript">
    $(document).ready(function () {

        $("#submit_login").on("click", function () {
            $('#login_error_msg').hide();
            var remember = '0';
            if ($("#remember").is(":checked"))
                remember = "1";
            var data = $.param({
                'username': $("#Username").val(),
                'password': $("#Password").val(),
                'remember': remember
            });
            ajax_request(data);
            return false;
        });

        $(document).keypress(function (e) {
            if (e.which == 13) {
//                $('#login_error_msg').hide();
//                var remember = '0';
//                if ($("#remember").is(":checked"))
//                    remember = "1";
//                var data = $.param({
//                    'username': $("#Username").val(),
//                    'password': $("#Password").val(),
//                    'remember': remember
//                });
//                ajax_request(data);
//                return false;
                 $("#login_form").submit();
             }
        });
    });

    function ajax_request(data) {

        $.ajax({
            url: "<?php echo site_url("auth/validate"); ?>",
            data: data,
            datatype: "json",
            type: "post",
            success: function (data) {
                if (data.status == true) {
                    /*$('#login_success_msg').show().fadeOut(5000);
                     setTimeout(function() {
                     }, 2000);*/
                    $(location).attr('href', "<?php echo site_url("/dashboard"); ?>");
                } else if (data.status == false) {
                    

//                        alert(data.status);
//                        $("#login_error_message").html(data.message);
//                        $('#login_error_msg').show().fadeOut(15000);
//                        $('#login_error_msg').html(data.message).show();
                    $('#login_error_msg').html(data.message).show();
                    $('#login_error_msg').fadeIn('fast').fadeOut(15000);

//                        $('#login_error_msg').css('display','block').fadeOut(15000);
                }
            }, error: function (data) {
                console.log("server side error");
                return false;
            }
        });

    }
</script>
