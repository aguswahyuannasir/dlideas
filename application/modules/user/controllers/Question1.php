<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question1 extends MX_Controller {
    private $prefix         = 'question1';
    private $table_db       = 'todos';
    private $title          = 'Question 1';
    private $logTable       = '';
    private $url            = 'user/question1/';
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
        $js['custom']           = ['table-question1'];

        $this->template->display('user/'.$this->prefix.'/'.$this->prefix, $data, $js);
    }

    public function table_question1()
    {
        $result = $this->arr_data();

        $search     = [
            'title'         => 'title',
            'completed'     => 'completed',
            'name'          => 'name',
            'username'      => 'username',
            'email'         => 'email',
            'phone'         => 'phone',
            'whebsite'      => 'whebsite',
            'company'       => 'company'        
        ];


        foreach ($search as $key => $value) {
            if(isset($_REQUEST[$key]) && $_REQUEST[$key] != ''){
                
                $input = $_REQUEST[$key];
                
                $res = array_filter($result, function ($item) use ($value,$input) {
                    if (stripos($item[$value], $input) !== false) {
                        return true;
                    }
                    return false;
                });
                
                $y=0;
                $result = [];
                foreach($res as $rs){
                    $result[$y]=$rs;
                    $y++;
                }

            }
            
        }
        
        $iTotalRecords  = count($result);
        $iDisplayLength = intval($_REQUEST['length']);

        if($iTotalRecords < 10 ){
            $iDisplayLength = $iTotalRecords;
        }

        if($iDisplayLength == -1 ){
            $iDisplayLength = $iTotalRecords;
        }

        $iDisplayLength = $iTotalRecords < 10 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart  = intval($_REQUEST['start']);
        $sEcho          = intval($_REQUEST['draw']);

        $isi            = [];
        $i              = 1 + $iDisplayStart;


        for($j=$iDisplayStart;$j<($iDisplayLength+$iDisplayStart);$j++){
            $isi[] = [
                        $i,
                        $result[$j]['title'],
                        $result[$j]['completed'],
                        $result[$j]['name'],
                        $result[$j]['username'],
                        $result[$j]['email'],
                        $result[$j]['address'],
                        $result[$j]['phone'],
                        $result[$j]['website'],
                        $result[$j]['company'],
                        '',
                    ];
            $i++;
        }
        $records["data"]            = $isi;
        $records["draw"]            = $sEcho;
        $records["recordsTotal"]    = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }

    public function get_data($url=''){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function arr_data(){

        $users  = $this->get_data('https://jsonplaceholder.typicode.com/users');
        $todos  = $this->get_data('https://jsonplaceholder.typicode.com/todos');

        $i = 0;
        foreach($todos as $rows){

            $idx        =  array_search($rows->userId, array_column($users, 'id'));
  
            $add        = $users[$idx]->address;
            $address    = "street: $add->street, suite: $add->suite, city: $add->city , zipcode :  $add->zipcode , geo : ".$add->geo->lat.",".$add->geo->lng;
            
            $comp       = $users[$idx]->company;
            $company    = "name: $comp->name, catchPhrase: $comp->catchPhrase, bs: $comp->bs";

            $name       = $users[$idx]->name;
            $username   = $users[$idx]->username;
            $email      = $users[$idx]->email;
            $phone      = $users[$idx]->phone;
            $website    = $users[$idx]->website;

            $data[$i]['id']        = $rows->id;
            $data[$i]['title']     = $rows->title;
            $data[$i]['completed'] = $rows->completed;
            $data[$i]['name']      = $name;
            $data[$i]['username']  = $username;
            $data[$i]['email']     = $email;
            $data[$i]['address']   = $address;
            $data[$i]['phone']     = $phone;
            $data[$i]['website']   = $website;
            $data[$i]['company']   = $company;
            
            $i++;
        }

        return $data;

    }

    


}
