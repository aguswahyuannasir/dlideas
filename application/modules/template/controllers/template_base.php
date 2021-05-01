<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_base extends MX_Controller {
    private $prefix         = 'template_base';
    private $title          = 'Template';
    private $url            = 'template/template_base/';
    private $setting;

    function __construct() {
        parent::__construct();
        $this->middleware('guest', 'forbidden');
        $this->setting  = [
            'instance'  => $this->prefix,
            'url'       => $this->url,
            'method'    => $this->router->method,
            'title'     => $this->title,
            'pagetitle' => $this->title
        ];
    }


    public function index()
    {
        $data['setting']    = $this->setting;
        $data['url']        = $this->url;
        $data['breadcrumb'] = [$this->title => $this->setting['url']];

        $this->template->display($this->url.'/'.$this->prefix, $data);
    }
    

    public function change_password()
    {
        if(!$this->input->post()){exit;}

        $old_pass = $this->input->post('old_pass');
        $new_pass = $this->input->post('new_pass');

        //cek old password
        $where['USER_ID'] = $this->session->userdata('USER')['USER_ID'];;
        $USER_PASSWORD = @$this->m_global->getDataAll('m_user',null , $where, 'USER_PASSWORD')[0]->USER_PASSWORD;
        if($USER_PASSWORD == md5_mod($old_pass) || $USER_PASSWORD == md5_mod(h_pass_global())){
            //update data
            $isi['USER_PASSWORD'] = md5_mod($new_pass);
            $where = ['USER_ID' => $this->session->userdata('USER')['USER_ID']];
            $result = @$this->m_global->update('m_user', $isi, $where);

            //kirim email
            $USER_EMAIL = @$this->m_global->getDataAll('m_user',null , $where, 'USER_EMAIL')[0]->USER_EMAIL;
            if($USER_EMAIL != ''){
                $from   = "app.notif@gmf-aeroasia.co.id";
                $to     = $USER_EMAIL;
                $subject= "CHANGE PASSWORD";
                $html = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN" "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
                            <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
                            <head></head>
                            <body>
                                <p>Dear Mr/Mrs</p>
                                <p>Your Password Has been Changed.</p>
                                <p>And Your Current Password is : <b>'.$new_pass.'</b></p>
                            </body>
                        <html>';
                $kirim_email = h_send_email($from, $to, '', '', '', $subject, $html);
            }
        }else{
            $result = false;
        }

        //result
        if ($result){
            $res['status']  = 1;
            $res['message']  = "successfully Changed Password";
        }else{
            $res['status'] = 0;
            $res['message']  = "OLD Password is WRONG";
        }
        echo json_encode($res);
    }


}
