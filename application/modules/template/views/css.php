<?php
    foreach ((array)@$custom as $key => $value) {
        echo '<link src="'.base_url('public/assets/admin/pages/css/'.$value.'.css').'" rel="stylesheet"></link>';
    }
?>