<?php
    foreach ((array)@$custom as $key => $value) {
        echo '<link src="'.base_url('public/assets/crm/css/'.$value.'.css').'" rel="stylesheet"></link>';
    }
?>