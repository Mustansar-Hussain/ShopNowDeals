<footer class="footer_bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <h1>Main Category</h1>
                <ul>
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li><a href="javascript:void(0)">Circulars</a></li>
                    <li><a href="javascript:void(0)">Weekly Deals</a> </li>
                    <li><a href="javascript:void(0)">Top Deals</a></li>
                    <li><a href="javascript:void(0)">Featured Deals</a></li>
                </ul>
            </div>
            <div class="col-sm-8 col-xs-12">
                <h1>About</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
            </div>
        </div>
    </div>
    <div class="copy_rights">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12 copy_right_text">
                    Copyright © 2016 Shop Now Deals
                </div>
                <div class="col-sm-6 col-xs-12 align_right">
                    <img src="<?php  echo $res_url;   ?>images/j&j.png" width="249" height="30" alt=""/> 
                </div>
            </div>
        </div>  
    </div>
</footer>
<?php   ?>
<script src="<?php  echo $res_url;   ?>js/jquery.min.js"></script>
<script src="<?php  echo $res_url;   ?>js/bootstrap.min.js"></script>
<script src="<?php  echo $res_url;   ?>js/box.js"></script>
<script src="<?php  echo $res_url;   ?>js/slick.min.js"></script>
<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }

    $(document).on('ready', function () {
        $(".regular").slick({
            dots: false,
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                }
            ]
        });
    });
</script>
</body>
</html>