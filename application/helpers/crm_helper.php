<?php

function plugin_url($name = '') {
    return base_url('public/assets/crm/plugin/' . $name);
}

function lte_url($name = '') {
    return base_url('asset/lte/' . $name);
}

function img_url($name = '') {
    return base_url('asset/crm/img/' . $name);  
}

function css_url($name = '') {
    return base_url('public/assets/crm/css/' . $name);
}

function js_url($name = '') {
    return base_url('public/assets/crm/js/' . $name);
}

function h_pass_global() {
    return "r1n4";
}

function h_system_user() {
    return "'30','113'";
}

function h_cbo() {
    $CI =& get_instance();
    return $CI->session->userdata('USER')['USER_CBO'];;
}

function h_is_organic() {
    $CI =& get_instance();
    return @$CI->session->userdata('USER')['USER_ORGANIC'];;
}

//id GM 
function h_gm($tipe) { 
    if($tipe == 'name'){
        $val = "Nyoman Paramitha DL";
    }elseif($tipe == 'id'){
        $val = "12";
    }else{
        $val = "";
    }
    return $val; 
}

//id GM 
function h_vp($tipe) { 
    if($tipe == 'name'){
        $val = "Mohamad Arif Faisal";
    }elseif($tipe == 'id'){
        $val = "10";
    }else{
        $val = "";
    }
    return $val; 
}

//id GM 
function h_tbs($tipe) { 
    if($tipe == 'name'){
        $val = "Dyane Ghea Anggraini";
    }elseif($tipe == 'id'){
        $val = "104";
    }else{
        $val = "";
    }
    return $val; 
}


function h_get_color_level() {
    $color = array(
        1 => 'aqua',
        2 => 'green',
        3 => 'yellow',
        4 => 'red'
    );
    return $color;
}

function h_month_swift() {
    $key = array(
        '01' => 'Januari',
        '02' => 'Febuari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );
    return $key;
}

function h_month_rofo() {
    $key = array(
        '01' => 'Januari',
        '02' => 'Febuari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );
    return $key;
}


function h_cbo_ams() {
    $CI =& get_instance();
    $us_id = $CI->session->userdata('USER')['USER_ID'];
    //ams cbo
    $query  = "SELECT ac_us_id_ams FROM m_ams_cbo WHERE ac_us_id_cbo = '$us_id'";
    $ams_cbo = @$CI->db->query($query)->result()[0]->ac_us_id_ams;
     // echo $CI->db->last_query();exit;  
    return $ams_cbo;
}

function h_role_name($role_id='') {
    $CI =& get_instance();
     
    if($role_id == ''){
        $role_id = $CI->session->userdata('USER')['USER_ROLE_ID'];
    }

    //jika rolenya css maka foldernya TPR
    if($role_id == '9'){ $role_id = '4';}

    //select role name
    $query  = "SELECT ROLE_ID, ROLE_NAME FROM m_role ORDER BY ROLE_NAME ASC";
    $arr_role = $CI->db->query($query)->result();
    foreach ($arr_role as $row) {
        $role_name[$row->ROLE_ID] = $row->ROLE_NAME;
    }
    
    //result
    if($role_id == 'array') return $role_name;
    if($role_id == '') return '';
    return @$role_name[$role_id];
}

function h_role_folder($role_id='') {
    $CI =& get_instance();
    if($role_id == ''){
        $role_id = $CI->session->userdata('USER')['USER_ROLE_ID'];
    }

    //jika rolenya css maka foldernya TPR
    if($role_id == '9'){ $role_id = '4';}

    //select role name
    $query  = "SELECT ROLE_ID, ROLE_FOLDER FROM m_role ORDER BY ROLE_NAME ASC";
    $arr_role = $CI->db->query($query)->result();
    foreach ($arr_role as $row) {
        $role_name[$row->ROLE_ID] = $row->ROLE_FOLDER;
    }

    //result
    if($role_id == '') return '';
    return $role_name[$role_id];
}

function h_project_type($id){

    //jika datanya array
    $pecah = explode(',', $id);
    if(isset($pecah[1])){
        $status = '';
        foreach ($pecah as $val) {
            if($val=='1'){
                $status .= "PROJECT,";
            }else if($val=='0'){
                $status .= "RETAIL,";
            }else{
                $status .= "-,";
            }
        }
        return $status;
    }else{
        //jika datanya bukan array
        if($id=='1'){
            return "PROJECT";
        }elseif($id=='0'){
            return "RETAIL";
        }else{
            return "-";
        }
    }
}

function h_cus_company_type($id){
    if($id=='0'){
        return "Aviation";
    }else{
        return "Non-Aviation";
    }
}
function h_cus_company($id){
    if($id=='0'){
        return "GA";
    }else{
        return "NGA";
    }
}
function h_tpm($id){
    if($id=='0'){
        return "PBTH";
    }else{
        return "TMB";
    }
}
function h_tpm_project($id){
    if($id=='0'){
        return "Project";
    }else{
        return "Retail";
    }
}

function h_active($id){
    if($id=='0'){
        return "Non-Active";
    }else{
        return "Active";
    }
}
function h_cus_acc($id){
    if($id=='0'){
        return "KA";
    }else{
        return "NON-KA";
    }
}
function h_contract($id){
    if($id=='0'){
        return "Non Contract";
    }else{
        return "Contract";
    }
}

function h_tpm_project1($id = 'array') {
    $status = array(
        1 => 'Project',
        0 => 'Retail',
    );

    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{

            return $status[$id];
        }
    }
    
}

function h_status_salesplan($id = 'array') {
    $status = array(
        2 => '<span class="label label-sm label-danger"> Cancelled </span>',
        3 => '<span class="label label-sm label-success"> Closed </span>',
        0 => '<span class="label label-sm label-warning"> Open </span>',
        4 => '<span class="label label-sm label-info"> Reschedule </span>',
        5 => '<span class="label label-sm label-info"> Waiting Cancel </span>',
        1 => '<span class="label label-sm label-info"> Waiting Upgrade </span>',
    );
    
    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{

            return $status[$id];
        }
    }
    
}

function h_status_reschedule($id = 'array') {
    $status = array(
        1 => '<span class="label label-sm label-success"> Closed </span>',
        0 => '<span class="label label-sm label-warning"> Open </span>',
    );

    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{

            return $status[$id];
        }
    }
    
}

function h_status_billing($id = 'array') {
    $status = array(
        
        0 => '<span class="label label-sm label-danger"> Open </span>',
        1 => '<span class="label label-sm label-warning"> WIP </span>',
        2 => '<span class="label label-sm label-success"> Closed </span>',
    );

    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{

            return $status[$id];
        }
    }
    
}

function h_change_ams_status($id = 'array') {
    $status = array(
        0 => '<span class="label label-sm label-warning"> Open </span>',
        1 => '<span class="label label-sm label-success"> Done </span>',
    );
    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{

            return $status[$id];
        }
    }
}

function h_status_monitoring($id = 'array') {
    $status = array(
        0 => '<span class="label label-sm label-danger"> Not Yet </span>',
        1 => '<span class="label label-sm label-warning"> On Progress </span>',
        2 => '<span class="label label-sm label-success"> Done </span>',
    );

    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{
            return $status[$id];
        }
    }
}

// function h_status_monitoring($status){
//     $data = array(
//         0 => '<span class="label label-sm label-danger"> Not Yet </span>',
//         1 => '<span class="label label-sm label-warning"> On Progress </span>',
//         2 => '<span class="label label-sm label-success"> Done </span>',
//     );
//     return @$data[$status];
// }

function h_status_priority($id = 'array') {
    $status = array(
        1 => '<span class="label label-sm label-danger"> Urgent </span>',
        2 => '<span class="label label-sm label-warning"> Normal </span>',
        3 => '<span class="label label-sm label-info"> Slow </span>',
    );
    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{
            return $status[$id];
        }
    }
}

function h_tpm_status($id){

    //jika datanya array
    $pecah = explode(',', $id);
    if(isset($pecah[1])){
        $status = '';
        foreach ($pecah as $val) {
            if($val=='0'){
                $status .= "OPEN,";
            }elseif($val=='1'){
                $status .= "PICKUP,";
            }else{
                $status .= "DROP,";
            }
        }
        return $status;
    }else{
        //jika datanya bukan array
        if($id=='0'){
            return "OPEN";
        }elseif($id=='1'){
            return "PICKUP";
        }else{
            return "DROP";
        }
    }
}

function h_pica_status($id = 'array') {
    $status = array(
        0 => '<span class="label label-sm label-warning"> Open </span>',
        1 => '<span class="label label-sm label-success"> Closed </span>',
    );
    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{
            return $status[$id];
        }
    }
}




function h_upgrade_status($status){
        $data = array(
            0 => '<span class="label label-sm label-warning"> Open </span>',
            1 => '<span class="label label-sm label-danger"> Rejected </span>',
            2 => '<span class="label label-sm label-success"> Approved </span>',
            3 => '<span class="label label-sm label-success"> Send To GM </span>',
        );
        return @$data[$status];
}

function h_upgrade_status_gm($status){
    $data = array(
        0 => '<span class="label label-sm label-warning"> Open </span>',
        1 => '<span class="label label-sm label-danger"> Rejected </span>',
        2 => '<span class="label label-sm label-success"> Approved </span>',
    );
    return @$data[$status];
}


function h_cancel_status($status){
        $data = array(
            0 => '<span class="label label-sm label-warning"> Open </span>',
            1 => '<span class="label label-sm label-danger"> Rejected </span>',
            2 => '<span class="label label-sm label-success"> Approved </span>',
            3 => '<span class="label label-sm label-success"> Send To VP </span>',
            4 => '<span class="label label-sm" style="color: #FFFFFF;background-color: #8e5fa2;"> Send To TPM </span>',
        );
        return @$data[$status];
}

function h_cancel_status_vp($status){
    $data = array(
        0 => '<span class="label label-sm label-warning"> Open </span>',
        1 => '<span class="label label-sm label-danger"> Rejected </span>',
        2 => '<span class="label label-sm label-success"> Approved </span>',
    );
    return @$data[$status];
}

function h_accrued($status){
    $data = array(
        0 => '<span class="label label-sm label-warning"> Accrued </span>',
        1 => '<span class="label label-sm label-danger"> Not Accrued </span>',
    );
    return @$data[$status];
}

function h_reject($id = 'array') {
    $status = array(
        0 => '<span class="label label-sm label-warning"> Open </span>',
        1 => '<span class="label label-sm label-success"> Approved </span>',
        2 => '<span class="label label-sm label-danger"> Rejected </span>',
    );

    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{

            return $status[$id];
        }
    }
    
}

function h_status_wea($status){
    $data = array(
        0 => '<span class="label label-sm label-warning"> Open </span>',
        1 => '<span class="label label-sm label-danger"> Cancel </span>',
        2 => '<span class="label label-sm label-success"> Closed </span>',
    );
    return @$data[$status];
}


function h_aging_swift($id = 'array') {
    $status = array(
        '0' => '<span class="label label-sm label-danger">Current</span>',
        '1-30' => '<span class="label label-sm label-danger">1-30</span>',
        '31-60' => '<span class="label label-sm label-warning">31-60</span>',
        '61-90' => '<span class="label label-sm label-warning">61-90</span>',
        '91-180' => '<span class="label label-sm label-info">91-180</span>',
        '181-360' => '<span class="label label-sm label-info">181-360</span>',
        '361-720' => '<span class="label label-sm label-info">361-720</span>',
        '>720' => '<span class="label label-sm label-info">>720</span>',
    );
    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{
            return $status[$id];
        }
    }
}

function h_upload_ftp(){
    $CI =& get_instance();
    $CI->load->library('ftp');                
    $ftp_config['hostname'] = 'ftp-01.gmf-aeroasia.co.id'; 
    $ftp_config['username'] = 'usergmf';
    $ftp_config['password'] = 'aeroasia';
    $ftp_config['debug']    = TRUE;               
    $CI->load->library('upload');   

    return $ftp_config;
}

// function h_download_file($us_id,$file){
        
//     $url_download = "ftp://usergmf:aeroasia@ftp-01.gmf-aeroasia.co.id/File_App_CRM/pica/".$us_id."/".$file;
//     //var_dump($url_download);die();
//     redirect($url_download);
// }

function h_month($m = 'array'){
    $status = array(
        1 => 'Jan',
        2 => 'Feb',
        3 => 'Mar',
        4 => 'Apr',
        5 => 'May',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Aug',
        9 => 'Sep',
        10 => 'Oct',
        11 => 'Nov',
        12 => 'Des'
    );

    if($m == 'array'){
         return $status;
    }else{
        if (empty($m)) {
            return "-"; 
        }else{

            return $status[$m];
        }
    }
}

/*function h_day($h = 'array'){
    $status = array(
        1 => 01,
        2 => 02,
        3 => 03,
        4 => 04,
        5 => 05,
        6 => 06,
        7 => 07,
        8 => 08,
        9 => 09,
        10 => 10,
        11 => 11,
        12 => 12,
        13 => 13,
        14 => 14,
        15 => 15,
        16 => 16,
        17 => 17,
        18 => 18,
        19 => 19,
        20 => 20,
        21 => 21,
        22 => 22,
        23 => 23,
        24 => 24,
        25 => 25,
        26 => 26,
        27 => 27,
        28 => 28,
        29 => 29,
        30 => 30,
    );

    if($h == 'array'){
         return $status;
    }else{
        if (empty($h)) {
            return "-"; 
        }else{

            return $status[$h];
        }
    }
}*/

function h_bulan($m = 'array'){
    $status = array(
        '1' => '01',
        '2' => '02',
        '3' => '03',
        '4' => '04',
        '5' => '05',
        '6' => '06',
        '7' => '07',
        '8' => '08',
        '9' => '09',
        '10' => '10',
        '11' => '11',
        '12' => '12',
       
    );

    if($m == 'array'){
         return $status;
    }else{
        if (empty($m)) {
            return "-"; 
        }else{

            return $status[$m];
        }
    }
}


function h_insert_token($type='',$nopeg='',$token='') {
    $CI     =& get_instance();

    $date_now           = date('Y-m-d H:i:s');

    $end_date = date('Y-m-d H:i:s', strtotime($date_now." +30 days"));
    
    $data   = array(
            'token_code'            => $token,
            'token_type'            => $type,
            'token_start_date'      => $date_now,
            'token_end_date'        => $end_date,
            'token_us_id'           => $nopeg,
    );


    $result = $CI->db->insert('sys_token', $data);
    $data   = []; //kosongkan data

   
}

function h_parsing_float($value) {
    return is_float($value) ? floatval(sprintf('%.2f', $value)) : intval($value);
}

function h_json_output($data = array(), $code = 200, $msg = NULL) {
    $CI =& get_instance();
    $output = array(
        'code' => $code,
        'message' => $msg, 
        'data' => $data
    );
    $json_data = json_encode($output);
    $res = $CI->output
        ->set_content_type('application/json')
        ->set_output($json_data);
    return $res;
}

function h_get_month() {
    $month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    return $month;
}

function h_replace_file_name($name) {
    $name = str_replace(' ', '_', $name); 
    $name = str_replace('"', '', $name); 
    $name = str_replace("'", '', $name); 
    return $name;
}

function h_format_date($date='', $format='') {
   
    if($date == NULL){
        $date = NULL;
    } else

    if($date =='0000-00-00'){
        $date = NULL;
    } else 

    if($date == ''){ 
        $date = "";
    }else{
        $date = date($format,strtotime($date));
    }

    return $date; 
}

function h_wea_number($type='',$msn='', $cus_code=''){

    // 446/TPC/WEA/25180/JMV01/IV/2016
    $year    = date('Y');
    $month   = date('m');


    $CI     =& get_instance();      
    $kode   = "GMF";            
    $query  = "SELECT MAX(wea_no) AS wea_no 
                  FROM tbl_add_project";
                  
    $row = $CI->db->query($query)->row_array();
    //   
    $id     = $row['wea_no'];
    $max_id = substr($id,-6);
    $plus = $max_id+1;           
        if($plus<10){                
            $kode = "00000".$plus."/".$kode."/".$type."/".$msn."/".$cus_code."/".$month."/".$year;
        }else if($plus<100){                
            $kode = "0000".$plus."/".$kode."/".$type."/".$msn."/".$cus_code."/".$month."/".$year;
        }else if($plus<1000){                
            $kode = "000".$plus."/".$kode."/".$type."/".$msn."/".$cus_code."/".$month."/".$year;
        }else if($plus<10000){                
            $kode = "00".$plus."/".$kode."/".$type."/".$msn."/".$cus_code."/".$month."/".$year;
        }else if($plus<100000){                
            $kode = "0".$plus."/".$kode."/".$type."/".$msn."/".$cus_code."/".$month."/".$year;
        }else if($plus<1000000){                
            $kode = $plus."/".$kode."/".$type."/".$msn."/".$cus_code."/".$month."/".$year;
        }       
    return $kode;
}



function h_send_email($from='', $to='', $cc='', $bcc='', $title='', $subject='', $html=''){
    $CI     =& get_instance();
    
    //param
    if($from == ''){ $from = 'app.notif@gmf-aeroasia.co.id'; }
    if($cc == ''){ $cc = 'list-tpr@gmf-aeroasia.co.id'; }
    if($bcc == ''){ $bcc = 'fds.firdaus@gmail.com'; }
    
    //config email
    $config = Array(
        'protocol'  => 'smtp',
        'smtp_host' => 'mail.gmf-aeroasia.co.id',
        'smtp_port' => 25,
        'smtp_user' => 'app.notif@gmf-aeroasia.co.id',
        'smtp_pass' => 'app.notif',
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1',
        'wordwrap'  => TRUE
    );
    $CI->load->library('email', $config);
    $CI->email->set_newline("\r\n");
    $CI->email->from($from, $title);        
    $CI->email->cc($cc);
    $CI->email->bcc($bcc);
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($html);
    $CI->email->send();

}

// function h_format_date($date='') {
//     if($date == NULL){
//         $date = NULL;
//     } else

//     if($date =='0000-00-00'){
//         $date = NULL;
//     } else {
//        $date = date('Y-m-d',strtotime($date));
//     }

//     return $date;
// }



function h_status_swift($id = 'array') {
    $status = array(
        1 => 'Document Uncomplete',
        2 => 'Potensi Reverse',
    );
    if($id == 'array'){
         return $status;
    }else{
        if ($id == '') {
            return "-"; 
        }else{
            return $status[$id];
        }
    }
}


function h_area_swift($id = 'array') {
    $status = array(
        'TP' => 'TP',
        'Related' => 'Related',
    );
    if($id == 'array'){
         return $status;
    }else{
        if ($id == '' || $id == '-') {
            return "-"; 
        }else{
            return $status[$id];
        }
    }
}


function h_keterangan_swift($id = 'array') {
    $status = array(
        'Mark up' => 'Mark up',
        'Proses rekonsiliasi' => 'Proses rekonsiliasi',
        'Mark up' => 'Mark up',
        'NPPA' => 'NPPA',
        'Tarikan' => 'Tarikan',
        'Denda late Payment' => 'Denda late Payment',
    );
    if($id == 'array'){
         return $status;
    }else{
        if ($id == '' || $id == '-') {
            return "-"; 
        }else{
            return $status[$id];
        }
    }
}


function h_read_more($val='',$length=0) {
    if(strlen($val) >= $length){ $read_more = "..."; }else{ $read_more = ""; }
    $res = '<a href="javascript:;" class="btn_more">'.
                '<div class="text_short">'.substr($val, 0,$length).' '.$read_more.'  </div>'.
                '<div class="text_full" style="display:none;">'.$val.'</div>'.
            '</a>';
    return $res;
}

function h_status_iw93($status){
    $data = array(
        0 => '<span class="label label-sm label-warning"> No Pickup </span>',
        1 => '<span class="label label-sm label-success"> Pickup </span>',
    );
    return @$data[$status];
}


function h_remove_duplicate_group($val = '') {
    if($val != ''){
        $arr = explode('_+_', $val);
        if(@$arr[1] == ''){
            $arr = explode(', ', $val);
        }
        if(@$arr[1] == ''){
            $arr = explode('+', $val);
        }
        $arr = array_unique($arr);
        $res = implode(' + ', $arr);
    }else{
        $res = '';
    }
    
    return $res;
}


function h_remove_format_number($val = '') {
    if($val == '' || $val == '0.00' || $val == '-'){
        $res = '0';
    }else{
        $res = str_replace(",","",$val);
    }
    return $res;
}



function h_status_ca($status=''){
        $CI =& get_instance();
        $db_logistic    = $CI->load->database('db_logistic',TRUE); 

        $rs = $db_logistic->query("select * from m_status_ca")->result();
        foreach ($rs as $key) {
            $data["$key->id"] = '<span class="label label-sm '.$key->label.' "> '.$key->ca_status.' </span>';
            //$data["$key->id"] = '<span class="form-control label-sm '.$key->label.' "> '.$key->ca_status.' </span>';
        }
        return @$data[$status];
}
