<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
    START Core Helper        
*/

function create_slug($string){
    $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return strtolower($slug);
}

function csrf_init(){
    $CI =& get_instance();  

    $csrf   = strEncrypt('csrf');
    $value  = strEncrypt(date('YmdHis'));

    $CI->session->unset_userdata($csrf);    
    $CI->session->set_userdata([$csrf => $value]);
}


function hlp_inputEssen($data){
    $CI =& get_instance();

    $tmp = [
        'CREATED_BY'    => $CI->session->userdata('USER')['USER_USERNAME'],
        'CREATED_IP'    => $CI->input->ip_address(),
        'CREATED_TIME'  => time()
    ];

    return array_merge($data, $tmp);
}


function hlp_log_history($type='', $activity='', $id=''){
    $CI =& get_instance();

    $data['log_us_id']          = $CI->session->userdata('USER')['USER_ID'];    $data['log_ip_address']     = $CI->input->ip_address();
    $data['log_created_date']   = date("Y-m-d H:i:s");
    $data['log_type']           = $type;
    $data['log_activity']       = $activity;
    $data['log_param_id']       = $id;
    $data['log_other_user']     = @$CI->session->userdata('USER')['USER_OTHER_USER'];
    $data['log_role_id']         = @$CI->session->userdata('USER')['USER_ROLE_ID'];
    $CI->db->insert('sys_log_history', $data); 
   
}

function csrf_get_token(){
    $CI =& get_instance();
    $csrf   = strEncrypt('csrf');
    $data   = @$CI->session->userdata($csrf);

    $data   = ($data != '') ? $data : '-';

    return $data;
}

function strEncrypt($str, $forDB = FALSE){
    $CI =& get_instance();  
    $key    = $CI->config->item('encryption_key');

    $str    = ($forDB) ? 'md5(concat(\'' . $key . '\',' . $str . '))' : md5($key . $str);   
    return $str;
}

function generate_salt(){
    $CI =& get_instance();  
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 16; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function md5_mod($str, $salt=''){

	$str = md5(md5($str).$salt);
	return $str;
}

function bulan($bulan)
{
    $aBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    
    return $aBulan[$bulan];
}

function tgl_format($tgl)
{
    $tanggal    = date('j', strtotime($tgl));
    $bulan      = bulan( date('n', strtotime($tgl))-1 );
//    $bulan      = date('M', strtotime($tgl));
    $tahun      = date('Y', strtotime($tgl));
    return $tanggal.' '.$bulan.' '.$tahun;
}

function jam_format($tgl)
{
    return date('H:i', strtotime($tgl));
}

function religion_to_index($index)
{
    $religion = [
    'Islam'     => '1',
    'Protestan' => '2',
    'Katolik'   => '3',
    'Hindu'     => '4',
    'Budha'     => '5',
    'Konghucu' => '6'
    ];

    return $religion[$index];
}

function multi_encript($id)
{
    $data = [];
    foreach ($id as $key => $value) {
        $data[] = strEncrypt($value);
    }

    return $data;
}

function display($var)
{
    echo '<pre>';print_r($var);echo '</pre>';
}

/*
    END Core Helper        
*/

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

function Terbilang($x)
{
    $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($x < 12)
        return " " . $abil[$x];
    elseif ($x < 20)
        return Terbilang($x - 10) . "belas";
    elseif ($x < 100)
        return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
    elseif ($x < 200)
        return " seratus" . Terbilang($x - 100);
    elseif ($x < 1000)
        return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
    elseif ($x < 2000)
        return " seribu" . Terbilang($x - 1000);
    elseif ($x < 1000000)
        return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
    elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}

function rgb2hex($rgb) {
   $hex = '';
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex;
}

function tree_view($table, $where) {
    $CI = &get_instance();
    
    // get parent               
        $CI->db->select('*')->from($table);
        $CI->db->where($where);

        $query  = $CI->db->get();
        $parent     = $query->result();
        return $parent;
}

function tree_child($table, $where, $prefix) {
    $CI = &get_instance();
    
    // get parent               
    $CI->db->select('*')->from($table);
    $CI->db->where($where);

    $query  = $CI->db->get();
    $data   = $query->result();

    if (count($data) > 0) {
        $str    = "<ul>";

        foreach ($data as $rows) {  
            $name   = $prefix . "_long";
            $id     = $prefix . "_id";
            @$str .= '<li data-jstree=\'{ "opened" : true }\'><span onClick="f_edit(\''.$rows->$id.'\')">'. @$rows->$name.'</span>';

            // check lagi dong ah :D
            $str .= tree_child($table, [$prefix . "_parent" => $rows->$id], $prefix);

            $str .= '</li>';

        }

        $str    .= "</ul>";
    }       

    return @$str;
}

function lang($key, $param = array())
{
    $CI =& get_instance();

    if(empty($param)){
        $string = $CI->lang->line($key);
    }else{
        $string = $CI->lang->line($key);
        $string = vsprintf($string, $param );
    }

    return $string;
}

// function random_word($length = 5) {
//    $chars = "1234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
//    $i = 0;
//    $captcha = "";
//    while ($i < $length) {
//        $captcha .= $chars{mt_rand(0,strlen($chars)-1)};
//        $i++;
//    }
//    return $captcha;
// }


function sidebar_menu( $menu, $url )
{
    foreach ( $menu as $key => $value )
    {
        echo
            '<li ' .
            /*
                Jika nama controller dari menu helper sama dengan controller
            */
            ( $value['controller'] == $url
                ? 'class="start active"'
                : ''
            ).'>

        <a ' .
            /*
                Mempunyai sub menu atau tidak
                untuk link href
            */
            (is_array($value['link'])
                ? 'href="javascript:;"'
                : 'class="ajaxify" href="'.base_url($value['link']).'"') .
            '>

        <i class="icon-'.$value['icon'].'"></i>

        <span class="title">'.$value['name'].'</span>' .

            /*
                Mempunyai sedang aktif
            */
            ($key == 0
                ? '<span class="selected"></span>'
                : ''
            ) .

            /*
                Mempunyai sub menu atau tidak
                untuk menampilkan arrow
            */
            (is_array($value['link'])
                ? '<span class="arrow ' .
                ( $value['controller'] == $url
                    ? 'open'
                    : '')
                . '"></span>'
                : ''
            ) . '</a>';

        sub_menu( $value, $url, '2' );

        echo '</li>';
    }
}

function sub_menu( $value, $url, $segment ){

    /*
        Mempunyai sub menu atau tidak
        untuk menampilkan sub link
    */

    if ( is_array($value['link']) )
    {
        echo '<ul class="sub-menu">';

        $CI = &get_instance();

        /*
            Menampilkan sub menu
        */

        foreach ( $value['link'] as $kSub => $kValue )
        {
            $sub_url = $CI->uri->segment($segment);

            /*
                Jika controller parent sama dengan uri sebelumnya
                dan controller sekarang sama dengan uri sekarang
            */

            echo '<li ' .
                ($kValue['controller'] == $sub_url && $value['controller'] == $url
                    ? 'class="active"'
                    : ''
                ) . '>

            <a ' .

                /*
                    Jika mempunyai sub, maka href=javascript (tidak ada link)
                    jika tidak, maka href berisi link
                */

                (is_array($kValue['link'])
                    ? 'href="javascript:;"'
                    : 'class="ajaxify" href="'.base_url($kValue['link']).'"'
                ) .

                ' title="'.$kValue['title'].'">
                <i class="icon-'.$kValue['icon'].'"></i>
                ' . $kValue['name'] .

                /*
                    Jika mempunyai sub dan controller parent sama dengan uri sekarang
                    maka arrow open (sub menu sedang aktif)
                    selain itu, hanya menampilkan arrow (mempunyai sub menu tapi tidak aktif)
                */

                (is_array($kValue['link']) && $kValue['controller'] == $sub_url
                    ? '<span class="arrow open"></span>'
                    :
                    (is_array($kValue['link'] )
                        ? '<span class="arrow"></span>'
                        : ''
                    )
                ) . '
                </a>';

            /*
                cek lagi gan sub menu level selanjutnya
            */

            sub_menu( $kValue, $sub_url, $segment+1 );

            echo '</li>';
        }
        echo '</ul>';
    }

}

// Oracle Function for read CLOB
function read_clob($field){
    if(is_string($field) || $field == ''){
        return $field;
    }
    return $field->read($field->size());
}

// Group for Oracle
function groupDeter($group){
    $CI =& get_instance();
    $database = $CI->db->dbdriver;
    if($database == 'mysqli'){
        $tmp = explode(',', $group);
        $group = $tmp[0];
    }

    return $group;
}

function selectGroupDeter($field, $limiter = '</br>', $select = 'MERG', $order  = 'ID_BAHASA')
{
    $CI =& get_instance();
    $database = $CI->db->dbdriver;
    if($database == 'oci8'){
        $selectGroup = 'LISTAGG('.$field.', \''.$limiter.'\') WITHIN GROUP (ORDER BY '.$order.') "'.$select.'"';
    }else{
        $selectGroup = 'group_concat('.$field.' order by '.$order.' separator "'.$limiter.'") as '.$select;
    }

    return $selectGroup;
}