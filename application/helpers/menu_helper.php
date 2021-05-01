<?php

function get_menu()
{
    $CI =& get_instance();

    $role = $CI->session->userdata('USER')['USER_ROLE_ID'];

    //get menu
    $arr_role = $CI->m_global->getDataAll('m_role',NULL, ['ROLE_STATUS' => '1'], 'ROLE_MENU', 'ROLE_ID IN('.$role.')');
    $arr_no   = [];
    foreach ($arr_role as $row) {
        $pecah = explode(',',$row->ROLE_MENU);
        $arr_no = array_merge($arr_no,$pecah);
    }
    $arr_menu = array_unique($arr_no);
    $arr_menu = implode(',', $arr_menu);
    $where_e = "MENU_ID IN(".$arr_menu.")";

    $tmp = $CI->m_global->getDataAll('m_menu', NULL, ['MENU_STATUS' => '1', 'MENU_PARENT' => '0'], 'MENU_ID, MENU_NAME, MENU_ICON, MENU_MODULE, MENU_CONTROLLER', $where_e, ['MENU_ORDER', 'asc']);
    $menu = [];
    foreach($tmp as $row){
        $menu[] = get_menu_rekursif($row, $row->MENU_ID, $where_e);
    }

    return $menu;
}

function get_menu_rekursif($row, $idmenu, $where_e)
{
    $CI =& get_instance();

    $tmp = $CI->m_global->getDataAll('m_menu', NULL, ['MENU_PARENT' => $idmenu, 'MENU_STATUS' => '1'], 'MENU_ID, MENU_NAME, MENU_ICON, MENU_MODULE, MENU_CONTROLLER', $where_e, ['MENU_ORDER', 'asc']);

    if(!empty($tmp)){
        $row->sub = $tmp;
    }

    return $row;

}

//untuk edit group
function checked_data($group, $var){
    return in_array($var, $group) ? 'checked' : '';
}

