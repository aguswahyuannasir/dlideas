<?php
    foreach ((array)@$custom as $key => $value) {
        echo '<script src="'.base_url('public/assets/crm/js/'.$value.'.js').'" type="text/javascript"></script>';
    }
?>