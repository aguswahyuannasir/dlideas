<?php @$userdata = $this->session->userdata('USER'); ?>

<!-- <div class="page-header navbar navbar-fixed-top" style="background:#3B3F51;"> -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner" style="margin-top: -10px;">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a class="ajaxify" href="<?php echo site_url('login') ?>" style="text-align:center;text-decoration: none;">
                <div style="margin: 7px 0px 0px !important;  width:80px;font-size:30px;"/>
                    <img style="width:190px;height:60px;" src="<?php echo base_url(); ?>public/assets/global/img/logo1.png">
                </div>
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN PAGE TOP -->
        <div class="page-top">

            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
           <!--  <form class="search-form" action="extra_search.html" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                    <span class="input-group-btn">
                    <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                    </span>
                </div>
            </form> -->
            <!-- END HEADER SEARCH BOX -->

            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide">
                    </li>
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-success"> --
                                <?php 
                                    // $user_id    = @$this->session->userdata('USER')['USER_ID'];
                                    // $where      = ['notif_send_to LIKE'=> "%,".$user_id.",%", 'notif_read_by NOT LIKE'=> "%,".$user_id.",%"];
                                    // $arr_notif  = $this->m_global->getDataAll('v_notif', null, $where, '*');
                                    // $tot_notif  = count($arr_notif);
                                    // echo $tot_notif;
                                ?>
                            </span>
                        </a>
                     
                    </li>
                     <script type="text/javascript">
                        $(document).ready(function () {
                            // $('#btn_notif_view').on('click',function(){
                            //     var notif_id    = $(this).attr('notif_id');
                            //     var notif_us_id = $(this).attr('notif_us_id');
                            //     var notif_link  = $(this).attr('notif_link');
                            //     var url = "<?=site_url()?>template/template_base/update_notif";
                            //     var param = {notif_id:notif_id, notif_us_id:notif_us_id, notif_link:notif_link}
                            //     Metronic.blockUI({ target: 'body',  boxed: true});
                            //     $.post(url, param, function(msg){
                            //         Metronic.unblockUI('body');
                            //         // if(msg.status == '1'){
                            //             // window.location.href = "<?=site_url();?>"+msg.notif_link;
                            //             window.location.href = "<?=site_url();?>"+msg;
                            //         // }else{
                            //         //     alert('failed update!');
                            //         // }
                            //     });
                            // // },'json');
                            // });
                        });
                    </script>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <li class="separator hide">
                    </li>
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <span class="badge badge-danger"> -- </span>
                        </a>
                        <!-- <ul class="dropdown-menu">
                            <li class="external">
                                <h3>You have <span class="bold">0 New</span> Messages</h3>
                                <a href="inbox.html">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                    <li>
                                        <a href="inbox.html?a=view">
                                        <span class="photo">
                                        <img src="../../assets/admin/layout4/img/avatar.jpg" class="img-circle" alt="">
                                        </span>
                                        <span class="subject">
                                        <span class="from">
                                        Lisa Wong </span>
                                        <span class="time">Just Now </span>
                                        </span>
                                        <span class="message">
                                        Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul> -->
                    </li>
                    <!-- END INBOX DROPDOWN -->
                    <li class="separator hide">
                    </li>
                    <!-- BEGIN TODO DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-calendar"></i>
                            <span class="badge badge-primary"> -- </span>
                        </a>
                        <!-- <ul class="dropdown-menu extended tasks">
                            <li class="external">
                                <h3>You have <span class="bold">0 pending</span> tasks</h3>
                                <a href="page_todo.html">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                        <span class="task">
                                        <span class="desc">New release v1.2 </span>
                                        <span class="percent">30%</span>
                                        </span>
                                        <span class="progress">
                                        <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span>
                                        </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul> -->
                    </li>

                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"><?= @$userdata['USER_NAME'];?></span>
                            <span class="username username-hide-on-mobile"><?= @$userdata['USER_ROLE_name'];?></span>
                            <!-- <img alt="<?= @$userdata['USER_NAME'];?>" class="img-circle" src="<?php echo @$userdata['USER_PHOTO'];?>"/> -->
                            <img class="img-circle" src="<?=base_url();?>/public/assets/admin/layout4/img/avatar.png" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <!-- <li>
                                <a href="extra_profile.html"><i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="inbox.html"><i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">1 </span></a>
                            </li>
                            <li>
                                <a href="page_todo.html"><i class="icon-rocket"></i> My Tasks <span class="badge badge-success"> 1 </span></a>
                            </li>
                            <li class="divider"></li> -->
                            <li>
                                <a title="Change Password" class="btn_change_pass" data-toggle="modal" href="#popup_change_pass"><i class="icon-key"></i> <span class="title">Change Password</span></a>
                                <a href="javascript:;" class="btn_logout"><i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- <li class="dropdown dropdown-extended quick-sidebar-toggler">
                        <span class="sr-only">Toggle Quick Sidebar</span>
                        <i class="icon-logout"></i>
                    </li> -->
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
