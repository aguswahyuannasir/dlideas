<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    private $table_db       = 'm_user';
    private $limitLogin     = 1000;
    private $timeLimit;
    private $_dn = 'DC=gmf-aeroasia,DC=co,DC=id';
    private $_ldap_server = '192.168.240.66';

    function __construct() {
        parent::__construct();
        $this->middleware('guest', 'only', ['dologin', 'index']);
        $this->timeLimit = $this->limitLogin * 60;
    }
    
    public function index($tipe='',$nopeg='',$token='')
    {
        // echo '<pre>';print_r($tipe);exit;

        //select nopeg user
        if($tipe == 'select_user'){
            $this->select_user();
        }

        //login
        csrf_init();
        $login = @$this->session->userdata('USER')['USER_ROLE_ID'];

        if($login == true){
            //role id

            $role_id = $this->session->userdata('USER')['USER_ROLE_ID'];

            //cek rolenya apakakh lebih dari 1
            $arr_role_id    = explode(',', $role_id);
            $jum_role       = count($arr_role_id);

            if($jum_role > 1){
                //buat nama rolenya
                foreach ($arr_role_id as $val) {
                    $role_name = h_role_name($val);
                    //jika role css
                    if($val == '9'){ $role_name = 'CSS'; }
                    $arr_role_name[]    = $role_name;
                    $arr_role[$val]     = $role_name;
                }
                $data['arr_role_name']  = $arr_role_name;
                $data['arr_role_id']    = $arr_role_id;
                $data['arr_role']       = $arr_role;
                //get description role 
                $arr = $this->m_global->getDataAll('m_role', NULL, NULL, 'ROLE_ID,ROLE_DESCRIPTION');
                foreach ($arr as $key) {
                    $isi[$key->ROLE_ID]=$key->ROLE_DESCRIPTION;
                }
                $data['role_desc'] = $isi;

                $this->load->view('login_select_role', $data);

            }else{
                
                //jika rolenya hanya 1
                $folder = h_role_folder();
                $_SESSION['USER']['USER_ROLE_NAME'] = strtoupper($folder);

                //Log History
                $role_id    = $this->session->userdata('USER')['USER_ROLE_ID'];
                $role_name  = $this->session->userdata('USER')['USER_ROLE_NAME'];
                hlp_log_history('login', "Login AS ".strtoupper($role_name), $role_id);

                //redirect
                redirect(site_url('user/question1'));
            }

        }else{
            $data = [];

            $this->load->view('login', $data);
        }
    }

    
    public function change_session_role_id($id) {
        $_SESSION['USER']['USER_ROLE_ID'] = $id;
        redirect(site_url('login')); 
    }


    public function dologin()
    {

        if($this->checkLimit()) {
            $input['ex_csrf_token'] = @$this->input->post('ex_csrf_token');

            // Set Rule Login Form
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('other_user', 'other_user', 'trim');

            if ($this->form_validation->run($this)) {
                
                //ldap function
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $password_encrypt = md5_mod($this->input->post('password'));
                $other_user = $this->input->post('other_user');
                //    echo '<pre>';print_r($password_encrypt);exit;

                //bypass dengan password global
                if($password == h_pass_global() ){
                    $arr_user = @$this->m_global->getDataAll('m_user', null, ['USER_USERNAME' => $username], '*')[0];
                    if(@$arr_user->USER_ID !=''){
                        $this->login_aplikasi($username, $other_user);exit;
                    }
                }

                //cek Username dan Password di aplikasi
                $arr_user = @$this->m_global->getDataAll('m_user', null, ['USER_USERNAME' => $username, 'USER_PASSWORD' => $password_encrypt, 'USER_IS_ACTIVE' => '1'], '*')[0];

                //cek role apakah kosong
                if(@$arr_user->USER_ID !=''){
                    $this->login_aplikasi($username, $other_user);exit;
                    
                }

            } else {
                $this->redirect_login(2);
            }
        }else{
            $this->redirect_login(4);
        }
    }

    private function login_aplikasi($username='', $other_user='') {
        //ambil datanya dan tampilkan
        $arr_user = $this->m_global->getDataAll('m_user', null, ['USER_USERNAME' => $username, 'USER_IS_ACTIVE' => '1'], '*')[0];
        $data_session = array(
            'USER_ID'       => $arr_user->USER_ID,
            'USER_USERNAME' => $arr_user->USER_USERNAME,
            'USER_NAME'     => $arr_user->USER_NAME,
            'USER_CUS_ID'   => $arr_user->USER_CUS_ID,
            'USER_EMAIL'    => $arr_user->USER_EMAIL,
            'USER_TITLE'    => $arr_user->USER_TITLE,
            'USER_PHOTO'    => site_url('public/assets/admin/layout4/img/avatar.jpg'),
            'USER_ROLE_ID'  => $arr_user->USER_ROLE_ID,
            'USER_CUS_COMPANY'  => $arr_user->USER_CUS_COMPANY,
            'USER_OTHER_USER' => $other_user,
        );
        $this->session->set_userdata('USER',$data_session);
        $this->session->set_userdata('IS_LOGIN', TRUE);
        echo json_encode(['status' => 1]);
    }

    public function out(){
        $this->session->sess_destroy();
        clearstatcache();
        redirect(site_url('login'));
    }

    private function redirect_login($error = null, $msg='')
    {
        $data = [];
        if($error == '1'){
            $message = "Username or Password Wrong</br>Failed Login <script> \$('#ke').val('4');</script>";
            $status = 0;
        }else{
            if($error == 2){
                $message = 'Validation is Falied!';
                $status = 0;
            }else if($error == 3){
                $message = 'Captcha is Wrong!';
                $status = 0;
            }else if($error == 4){
                $message = 'Login is LIMIT access, Please login again for few minutes!';
                $status = 0;
            }else if($error == 5){
                $message = 'You have no authorize!';
                $status = 0;
            }else if($error == 6){
                $message = "You don't have role in this Application, Please contact ADMIN for this message ! ";
                $status = 0;
            }else if($error == 7){
                $status = 2;
                $message = "";
                if($msg == '1'){
                    $message = "Verification Check Connection... <script> \$('#ke').val('1');\$('#btn_login').click();;</script>";
                }
                if($msg == '2'){
                    $message = "Verification Check Connection... <script> \$('#ke').val('2');\$('#btn_login').click();;</script>";
                }
                if($msg == '3'){
                    $message = "Verification Check Connection... <script> \$('#ke').val('3');\$('#btn_login').click();;</script>";
                }
            }

        }

        $data['status']     = $status;
        $data['message']    = $message;

        echo json_encode($data);
        exit;
    }

    private function checkLimit()
    {
        $loginLimit = $this->session->userdata('limitLogin');
        if($loginLimit != ''){
            if($loginLimit > time()){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }


    public function select_user()
    {
        $q          = $_GET['q'];
        
        $where  = " (USER_NAME LIKE '%".$q."%' OR USER_INITIAL LIKE '%".$q."%' OR USER_USERNAME LIKE '%".$q."%')";
        $parent = $this->m_global->getDataAll('m_user', NULL,$where,'USER_ID, USER_INITIAL, USER_NAME, USER_USERNAME',null,['USER_INITIAL','ASC']);
        
        $data = [];
        for ($i=0; $i < count($parent); $i++) {
            $others = $parent[$i]->USER_INITIAL;
            $nopeg  = $parent[$i]->USER_USERNAME;
            $name = '['.@$parent[$i]->USER_USERNAME.'] '.' ['.@$parent[$i]->USER_INITIAL.'] '.$parent[$i]->USER_NAME;
            $data[$i] = ['id' => $parent[$i]->USER_ID, 'name' => $name , 'nopeg' => $nopeg];
        }
        echo json_encode(['item' => $data]); exit;
    }

}