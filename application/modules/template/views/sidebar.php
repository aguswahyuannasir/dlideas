<?php
    $menu       = get_menu();
    $uri        = $this->uri->uri_string();
    $segment_1  = $this->uri->segment(2);
    $folder     = h_role_name();
?>
    
<div class="page-sidebar navbar-collapse collapse">

    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    
    <ul class="page-sidebar-menu page-sidebar-menu-according-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

        <?php

            // var_dump($menu);die();
            foreach($menu as $row):
                //param
                $menu_module    = trim($row->MENU_MODULE);
                $menu_controler = $row->MENU_CONTROLLER;
                $menu_icon      = trim($row->MENU_ICON);
                $menu_nama      = $row->MENU_NAME;
                $menu_sub       = @$row->sub;
                $pecah  = explode('/',$menu_controler);
                $folder = @$pecah[0];
                //menu global
                if($folder == 'global'){ 
                    $folder = 'global';
                    $menu_controler = @$pecah[1];
                }else{
                    $folder = h_role_name();
                }
                //url
                $url            = $folder.'/'.$menu_module.($menu_module != '' ? '/' : '').$menu_controler;
                $url_1          = $folder.'/'.$menu_module.'/true';
                $url_segment    = @explode('/', $url)[1];
                // echo '<pre>';print_r($url_segment.'-'.$segment_1);
                ?>
                <li class="start <?php echo ($segment_1 == $url_segment ? 'active' : '') ?>">
                    
                    <a title="<?= $menu_nama; ?>" href="<?= ($url == $url_1 ? 'javascript:;' : site_url($url)); ?>" class="<?=($url == $url_1 ? '' : "ajaxify"); ?>">
                        <i class="icon-<?= ($menu_icon == '' ? 'folder' : $menu_icon); ?>"></i>
                        <span class="title"><?= $menu_nama; ?></span>
                        <?= (isset($menu_sub) ? "<span class='arrow'></span>" : '') ?>
                    </a>
                    
                    <?php if(isset($menu_sub)){
                        
                        echo "<ul class='sub-menu'>";
                        foreach($menu_sub as $sub){
                            //param
                            $sub_module    = trim($sub->MENU_MODULE);
                            $sub_controler = $sub->MENU_CONTROLLER;
                            $sub_menu       = $sub->MENU_NAME;
                            $sub_icon       = trim($sub->MENU_ICON);
                            //sub menu global
                            if(substr($sub_controler, 0,6) == 'global'){ 
                                $sub_folder = 'global';
                                $sub_controler = substr($sub_controler, 7);
                            }
                            if(substr($sub_controler, 0,6) == 'master'){ 
                                $sub_folder = 'master';
                                $sub_controler = substr($sub_controler, 7);
                            }else{
                                $sub_folder = h_role_name();
                            }
                            //url
                            $url = $sub_folder.'/'.$sub_module.($sub_module != '' ? '/' : '').$sub_controler;
                            ?>


                            <li class="<?=($uri == $url ? 'active': '')?>" >

                                <a title="<?=$sub_menu;?>" href="<?=site_url($url)?>" href_1="<?=site_url($url)?>" href_2="javascript:;" class="ajaxify">

                                    <!-- tambahan jumlah notif -->
                                    <?php if($menu_module == 'user'){ ?>
                                        <span id='<?=$sub_controler;?>' class='badge badge-danger notif_request'>+</span>
                                    <?php } ?>
                                     <ul class='sub-menu'>ok
                                     </ul>
                                    <!-- END tambahan jumlah notif -->

                                    <i class="icon-<?=($sub_icon == '' ? 'folder' : $sub_icon); ?>"></i> 
                                    <?=$sub_menu;?>
                                </a>


                            </li>

                    <?php }
                        echo "</ul>";
                    } ?>

                </li>
                    <?php endforeach; ?>


    </ul>
    <!-- END SIDEBAR MENU -->
</div>








<!-- START Popup change Pass -->
<div id="popup_change_pass" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background:lightblue;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color:black;text-align:center;font-weight:bold;">Change Password</h4>
            </div>
            <div class="modal-body">
                <form id="form_change_pass" method="post" action="javascript:;" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-4">OLD PASSWORD</label>
                                    <div class="col-md-7">
                                        <input name="old_pass" type="password" class="form-control required" placeholder="Old Passeord">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-4">NEW PASSWORD</label>
                                    <div class="col-md-7">
                                        <input name="new_pass" type="password" class="form-control required" placeholder="New Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12" align="center">
                                <button id="btn_save_change_pass" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Popup change Pass -->



<script type="text/javascript">
$(document).ready(function () {

    //change password
    $('#btn_save_change_pass').die().live('click',function(){
        var url = "<?php echo site_url();?>/template/template_base/change_password";
        var param = $('#form_change_pass').serialize();
        Metronic.blockUI({ target: '#form_change_pass',  boxed: true});
        $.post(url, param, function(msg){
            if(msg.status == '1'){
                $('#popup_change_pass').modal('hide');
                swal("Success", msg.message, "success");
            }else{
                swal("Failed", msg.message, "error");
            }
            Metronic.unblockUI('#form_change_pass');
        },'json');
    });



});
</script>