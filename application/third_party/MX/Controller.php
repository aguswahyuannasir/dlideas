<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @property Template template
 * @property m_global m_global
 * @property CI_Input input
 * @property CI_Form_validation form_validation
 * @property CI_Upload upload
 * @property CI_Loader load
 * @property CI_Router router
 **/
class MX_Controller 
{
	public $autoload        = array();
    public $is_login        = FALSE;
	public $user_role;
	public $aRole           = ['admin' => 'Admin', 'guest' => 'Guest'];
	public $logAction       = ['0' => '204', '1' => '207', '99' => '205', '98' => '206'];
	public $csrf_message    = "For security reason, we can't process your action!";
    public $class_login     = 'admin';
    public $method_login    = 'index';
    public $admin_path      = '/public/files/';
    public $redirectAdmin   = '';
    
	public function __construct() 
	{
        // Check User Role
		$this->role();
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;

		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);

		/* autoload module items */
		$this->load->_autoloader($this->autoload);

        //teminder harian 
        // $cek_daily = $this->reminder_daily();

	}
	
	public function __get($class) 
	{
		return CI::$APP->$class;
	}

    /**
     * Fungsi untuk mementukan jika user sudah login,
     * atau jika remember me token masih befungsi maka relogin otomatis
     *
     */
    
    public function role(){
        $user = $this->session->userdata('USER');
        if(!empty($user)){
            $this->user_role    = 'auth';
            $this->is_login     = TRUE;
        }else{
//            $remember_me = $this->input->cookie('rememberme');
//            if($remember_me != '')
//            {
//                $result = $this->m_global->getDataAll('authtoken', NULL, ['token' => $remember_me, 'status' => '1'], 'idUser');
//                if(!empty($result))
//                {
//                    $id = $result[0]->idUser;
//                    $join = [
//                        ['table' => 'role', 'on' => 'idRole=role.id']
//                    ];
//
//                    $result = $this->m_global->getDataAll('user', $join, ['user.id' => $id, 'user.status' => '1'], 'user.id as id, user.name, username, role.slug as role, role.name as roleName, image');
//                    if(!empty($result))
//                    {
//                        $this->user_role    = $result[0]->role;
//                        $this->session->set_userdata('user_data', $result[0]);
//                        $this->session->set_userdata('is_login', TRUE);
//                    }else{
//                        $this->destroy_rememberme_cookies();
//                    }
//                }
//                else
//                {
//                    $this->destroy_rememberme_cookies();
//                }
//            }else {
                $this->user_role = 'guest';
//            }
        }

        if($this->is_login){
            $class  = $this->router->class;
            $method = $this->router->method;

            if($class == $this->class_login && $method == $this->method_login){
                redirect(site_url());
            }

            //cek rolenya, apa bentuk array
            // $role_id = $this->session->userdata('USER')['USER_ROLE_ID'];
            // $arr_role_id    = explode(',', $role_id);
            // if(strpos($role_id,',') !== false){ 
            //     // redirect(site_url('login'));
            // }
        }
    }

    public function destroy_rememberme_cookies()
    {
        $data   = [
            'name'  => 'rememberme',
            'path'  => $this->admin_path
        ];

        $remember_me = $this->input->cookie('rememberme');
        if($remember_me != '')
        {
            $this->m_global->update('authtoken', ['status' => '0'], ['token' => $remember_me]);
        }
        delete_cookie($data);
    }

    /**
     * @param $role
     * @param $param
     * @param array $method
     * @return bool
     *
     * Method untuk menentukan middle ware User
     * terdapat beberapa atusan seperti :
     * forbidden    = role tsb tidak bisa mengakses semua class tsb
     * except       = role tsb bisa mengakses semua method dri class tb kecuali {except}
     * only         = role tsb bisa mengakses method dari class yg di pilih {only}
     *
     */
    public function middleware($role, $param, $method = []){
        $error = FALSE;
		$user_role          = $this->user_role;

		if($role == $user_role){
            switch($param){
                case 'forbidden':
                    $error = TRUE;
                    break;

                case 'except':
                    $inMethod = $this->router->fetch_method();
                    if(in_array($inMethod, $method)){
                        $error = TRUE;
                    }
                    break;

                case 'only':
                    $inMethod = $this->router->fetch_method();
                    if(!in_array($inMethod, $method)){
                        $error = TRUE;
                    }
                    break;
            }

            // Jika error
            if($error){
                // Jika User tsb guest dan mengakses menu admin maka dilempar ke menu login jika tidak maka dilemar ke
                // menu error/error_404
                if($user_role == 'guest'){
                    $isAjax = $this->input->is_ajax_request();
                    if($isAjax){
                        echo "<script>alert('Session Login is Failed!');location.reload();</script>";
                        // echo json_encode(['status' => '99', 'code' => 'logout']);
                        exit();
                    }else{
                        redirect();
                    }
                }else{
                    redirect('error');
                }
            }
		}

		return true;
	}

    /**
     * @return mixed
     *
     * Mendapatkan User index role
     */
	public function getUserRole(){
		return $this->user_role;
	}

    /**
     * @param $action
     * @param null $value
     * @param null $table
     * @param null $id
     *
     * Mencatat setiap aksi dari User
     */
	public function log($action, $value = NULL, $table = NULL, $id = NULL){
		$user = $this->session->userdata('user_data');
		if(empty($user)){
			$userId = NULL;
		}else{
			$userId = $user->id;
		}

		$data['log_user_id']        = $userId;
		$data['log_logaction_id']   = $action;
		$data['log_value']          = $value;
		$data['log_ip']             = $this->input->ip_address();
		$data['log_table']          = $table;
		$data['log_field_id']       = $id;

		$this->m_global->insert('log', $data);
	}



    public function reminder_daily(){
        //reminder_leveling
        $time = date('Y-m-d H:i:s');
        // $time = "2018-07-30 06:00:00";
        $where = " reminder_id='1' AND reminder_date <= '$time' ";
        $arr = @$this->m_global->getDataAll('sys_reminder', null, $where)[0];
        if($arr != ''){
            //bacth email ke ams
            // $this->send_email_to_ams();

            //update tanggal untuk hari berikutnya
            $data['reminder_date'] = date('Y-m-d', strtotime(" +1 days"))." 06:00:00";
            $where2['reminder_id'] = $arr->reminder_id;
            $this->m_global->update('sys_reminder', $data, $where2);
        }

        //reminder_update fbl3n so number and flag 
        $time = date('Y-m-d H:i:s');
        // $time = "2018-07-30 06:00:00";
        $where = " reminder_id='2' AND reminder_date <= '$time' ";
        $arr = @$this->m_global->getDataAll('sys_reminder', null, $where)[0];
        if($arr != ''){
            //bacth email ke ams
            // $this->send_email_to_ams();
            $sql = "UPDATE tbl_fbl3n AS a INNER JOIN t_so_number AS b ON b.id_swift=a.FBL3N_ID SET a.flag='1' WHERE a.flag='0'";
            $sql2 = "UPDATE tbl_fbl3n AS a INNER JOIN t_so_number AS b ON b.id_swift=a.FBL3N_ID SET a.ams_id=b.ams_id WHERE a.flag='1'";
            $result = $this->db->query($sql);
            $result = $this->db->query($sql2);

            //update tanggal untuk hari berikutnya
            $data['reminder_date'] = date('Y-m-d', strtotime(" +1 days"))." 06:00:00";
            $where2['reminder_id'] = $arr->reminder_id;
            $this->m_global->update('sys_reminder', $data, $where2);
        }
    }


}