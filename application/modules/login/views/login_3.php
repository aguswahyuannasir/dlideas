<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from demo.themewizz.com/themes/bell/dark-video.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Aug 2017 03:07:04 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <title>G-SMART</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('public/assets/login/stylesheet/font-awesome.min.css');?>" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/assets/login/stylesheet/bootstrap.min.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('public/assets/login/stylesheet/animate.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('public/assets/login/stylesheet/style.css');?>" />

    <link rel="shortcut icon" href="<?php echo base_url('public/gmf-fav.png') ?>"/>

    <link href="<?php echo base_url('public/assets/global/plugins/bootstrap-toastr/toastr.min.css');?>" rel="stylesheet" type="text/css" />

    <style type="text/css">
        #btn_login:hover{ 
            cursor:pointer; 
        }

        .login{
            width:auto; 
            margin-top:-30px; 
            z-index: 99999 !important; 
            background:rgba(0, 0, 0, 0.72); 
        }
        
        @media only screen and (max-width: 575px) {
            .login{ 
                width:100%; 
                margin-top: 20px; 
            }
            header .social{
                margin-top:10px; 
                text-align:center;
            }
            header{
                padding: 9px 0 !important;
                background: black;
            }
            .txt_title{
                margin-top: 1.5vh !important;
            }
            
        }
    </style>

    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';
        var baseUrl  = '<?php echo base_url();?>';
    </script>
    <script type="text/javascript" src="<?php echo base_url('public/assets/login/javascript/jquery-3.2.1.min.js');?>"></script>




</head>

<body class="green-color dark-theme">
    <header id="header">
        <div class="background">
            <video autoplay loop muted style="z-index: -1;">
                <source src="http://www.gmf-aeroasia.co.id/wp-content/themes/aero/video/video.mp4" type="video/mp4" />
                <!-- <source src="<?php echo base_url('public/assets/login/video/GMF_AeroAsia_2016.mp4');?>" type="video/mp4" /> -->
                <!-- <source src="video/main.ogg" type="video/ogg"/> -->
            </video>
        </div>
        <div class="overlay"></div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-4"></div>
                    <div class="col-md-6 col-sm-6 col-xs-8">
                        <div class="login wow animated bounceIn">
                            <form class="login-form" action="javascript:;" method="post">
                                <input type="hidden" name="ex_csrf_token" value="<?= csrf_get_token(); ?>">
                                <input type="hidden" name="ke" id="ke" class="form-control" value="1" />
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <input name="username" class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key" id="btn_other_user"></i></span>
                                        <input name="password" class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" required/>
                                    </div>
                                </div>
                                <div class="input-group" style="margin-top: -5px; margin-bottom: 10px; display:none;" id="input_other_user">
                                    <span class="input-group-addon"><i class="fa fa-user" id="btn_view_user"></i></span>
                                    <input name="other_user" class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Other User: Nopeg/Name" />
                                </div>
                                <div class="form-group" style="padding-left:20px;">
                                  <div class="radio-list">
                                    <label class="radio-inline">
                                    <input type="radio" name="si" id="si_organic" value="1" checked> Organic &nbsp; &nbsp; </label>
                                    <label class="radio-inline">
                                    <input type="radio" name="si" id="si_non_organic" value="2"> Non Organic </label>
                                  </div>
                                </div>
                                <div style="padding-left:50px;">
                                    <input type="submit" class="btn btn-danger" style="margin-top: -10px;padding:5px 50px 5px 50px; border-radius: 10px;" id="btn_login" value=" LOGIN "> 
                                </div>
                                <div class="" style="display:none;" id="reload_page"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-4">
                        <img style="height: 50px;" src="<?php echo base_url('public/assets/login/img/logo_gmf.png');?>">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-8 social" id="login_button" >
                        <a href="javascript:;" class="wow animated bounceIn icon" data-wow-delay=".5s" style="display: inline-block;"><i class="fa fa-user-circle-o"></i></a> 
                        <a href="javascript:;"  class="wow animated bounceIn" data-wow-delay=".75s">
                            <h4 style="font-weight: 100;display: inline-block;">Login</h4>
                        </a>
                    </div>
                </div>
                <div class="row txt_title" style="text-align: center;margin-top: 25vh; z-index: 1px;">
                    <div class="col-md-12">
                        <div id="box" style="display: inline-block;" class="wow animated fadeInDown">
                            <span id="title">G&nbsp;-&nbsp;Smart</span>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding: 10px;font-style: italic;">
                        <p id="subtitle" class="wow animated fadeInDown">GMF Sales Monitoring And Revenue Tracking</p>
                    </div>
                </div>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active" style="">
                            <div class="carousel-caption d-none d-md-block">
                                <div id="caption">
                                    <h1 style="font-size: 30px;font-weight: 900;">GMF Vision</h1>
                                    <h1 style="font-size: 15px;font-weight: 100;">" Top 10 MROs In The World. "</h1>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption d-none d-md-block">
                                <div id="caption">
                                    <h1 style="font-size: 30px;font-weight: 900;">GMF Mission</h1>
                                    <h1 style="font-size: 15px;font-weight: 100;">" To provide integrated and reliable aircraft maintenance solution for a safer sky and secured quality of life of mankind. "</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <section class="bg bg-team">
        <!-- <img src="<?php echo base_url('public/assets/login/img/hanggar.jpg');?>"> -->
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-md-8" style="background-color: #0e2233;">
                    <h2 style="color: #fff; font-weight: 900;margin-bottom: 10px;">Passion For Quality Services</h2>
                </div>
                <div class="col-md-8" style="background-color: rgba(0,0,0,0.5);margin-top: 50px; ">
                    <p style="padding: 10px;">" Our ability to compete in this business is based on our capabilities, experience and ability to acquire and harness the best talents as well as the constant renewal of the professionals' skills. "</p>
                </div>
            </div>
        </div>
    </section>
    <section class="short">
        <div class="container">
            <div class="row justify-content-center">
                <div id="gmfvalues" class="col-md-2 col-sm-6 wow animated bounceIn" data-wow-delay=".5s">
                    <span class="fa-stack fa-lg" style="font-size: 32px;margin-bottom: 10px;">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                    </span>
                    <h5>Concern for People</h5>
                </div>
                <div id="gmfvalues" class="col-md-2 col-sm-6 wow animated bounceIn" data-wow-delay=".75s">
                    <span class="fa-stack fa-lg" style="font-size: 32px;margin-bottom: 10px;">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-link fa-stack-1x fa-inverse"></i>
                    </span>
                    <h5>Integrity</h5>
                </div>
                <div id="gmfvalues" class="col-md-2 col-sm-6 wow animated bounceIn" data-wow-delay="1s">
                    <span class="fa-stack fa-lg" style="font-size: 32px;margin-bottom: 10px;">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-suitcase fa-stack-1x fa-inverse"></i>
                    </span>
                    <h5>Professionals</h5>
                </div>
                <div id="gmfvalues" class="col-md-2 col-sm-6 wow animated bounceIn" data-wow-delay="1.25s">
                    <span class="fa-stack fa-lg" style="font-size: 32px;margin-bottom: 10px;">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-handshake-o fa-stack-1x fa-inverse"></i>
                    </span>
                    <h5>Team Work</h5>
                </div>
                <div id="gmfvalues" class="col-md-2 col-sm-6 wow animated bounceIn" data-wow-delay="1.5s">
                    <span class="fa-stack fa-lg" style="font-size: 32px;margin-bottom: 10px;">
                      <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-star fa-stack-1x fa-inverse"></i>
                    </span>
                    <h5>Customer Focused</h5>
                </div>
                
            </div>
        </div>
    </section>
    <footer>
        <div class="container wow animated fadeInUp">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-5 social">
                    <img style="height: 50px;" src="<?php echo base_url('public/assets/login/img/logo_gmf.png');?>">
                    <p>Soekarno Hatta International Airport Cengkareng - Indonesia PO. BOX 1303 BUSH 19100</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 contact">
                   <p><strong>CONNECT WITH US</strong></p><a href="#"><i class="fa fa-twitter-square"></i></a> <a href="#"><i class="fa fa-facebook-square"></i></a> <a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-google-plus-square"></i></a> 
                </div>
                <div class="col-md-12">
                    <hr/> </div>
                <div class="col-md-12 copyright"> <span>2017 <span id="btn_view_user">&copy;</span> GMF AeroAsia</span> </div>
            </div>
        </div>
        <a href="#header" class="fa fa-chevron-up move-up" data-smoothscroll="true"></a>
    </footer>
    

    <script type="text/javascript" src="<?php echo base_url('public/assets/login/javascript/main.js');?>"></script>
    <script src="<?php echo base_url('public/assets/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/assets/admin/pages/scripts/login.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/assets/global/plugins/bootstrap-toastr/toastr.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/assets/global/scripts/metronic.js');?>" type="text/javascript"></script>


    <script>
        $(document).ready(function() {

            $('.login-form').submit(function (e) {

                var data = $(this).serialize();
                var url = "<?php echo site_url('login/dologin'); ?>";

                //Metronic.blockUI({target: '.login-form', boxed: true});

                $.post(url, data, function (res) {

                    toastr.options = call_toastr_2('4000');
                    
                    if(res.status == '1'){

                        location.reload();

                    }else {

                        $('#reload_page').html(res.message);
                        // var cek_val = $('#ke').val();
                        // if(cek_val == '5'){
                            if(res.status == 2){
                                var $toast = toastr['info'](res.message, "Info");
                            }else{
                                var $toast = toastr['error'](res.message, "Error");
                            }
                        // }

                    }
                    //Metronic.unblockUI('.login-form');
                    
                }, 'json');

                return false;
            });

            $('.login-form input').keypress(function (e) {
                if(e.keyCode == 13){
                    $(this).trigger('submit');
                }
            });

            $('#btn_view_user').on('click',function(){
                window.location.href = "<?=site_url()?>/login/index/view_data_user/-/-/-";
            });

            $('#btn_other_user').on('click',function(){
                $('#input_other_user').toggle();
            }); 
        });

        $(document).ready(function() {
            var showChar = 200;
            var ellipsestext = "...";
            var moretext = "more";
            var lesstext = "less";

            $('.more').each(function() {
                var content = $(this).html();

                if(content.length > showChar) {

                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar-1, content.length - showChar);

                    var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';

                    $(this).html(html);
                }

            });

            $(".morelink").click(function(){
                if($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                }
                $(this).parent().prev().toggle();
                $(this).prev().toggle();
                return false;
            });

            $("#login_button").click(function(){
                $(".login").toggle();
                // $(".login").css("display", "block");
            });
            
        });

    </script>
</body>
<!-- Mirrored from demo.themewizz.com/themes/bell/dark-video.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Aug 2017 03:07:57 GMT -->

</html>