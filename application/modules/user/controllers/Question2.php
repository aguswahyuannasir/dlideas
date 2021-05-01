<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question2 extends MX_Controller {
    private $prefix         = 'question2';
    private $table_db       = 'm_item_pemeriksaan';
    private $title          = 'Question 2';
    private $logTable       = '';
    private $url            = 'user/question2/';
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
        $data['setting']        = $this->setting;
        $data['breadcrumb']     = [$this->title => $this->setting['url']];
        $data['question2']      = "Hello DL Ideas. Nice to meet you";

        $this->template->display('user/'.$this->prefix.'/'.$this->prefix, $data);
    }



}
