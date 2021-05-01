<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question3 extends MX_Controller {
    private $prefix         = 'question3';
    private $table_db       = 'tbl_question3';
    private $title          = 'Question 3';
    private $logTable       = '';
    private $url            = 'user/question3/';
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
        $js['custom']           = ['table-ajax'];

        $this->template->display('user/'.$this->prefix.'/'.$this->prefix, $data, $js);
    }

    public function table_question3()
    {
        //parameter yg diperlukan
        $table      = "tbl_question3";
        $addSelect  = [ '*'];
        $search     = [
                        'task'        => 'task',
                        'category'    => 'category',
                      ];

        //seting pencarian data
        $where  = [];  $whereE = NULL;
        foreach ($search as $key => $value) {
            if(isset($_REQUEST[$key]) && $_REQUEST[$key] != ''){
                $where[$value.' LIKE '] = '%'.$_REQUEST[$key].'%';
            }
        }

        //select penampilan data
        if(isset($_REQUEST['data-status'])){
            $dataStatus     = $_REQUEST['data-status'];
            if($dataStatus != 'all'){
                $where['status']  = $dataStatus;
            }
        }

        //order
        $keys = array_keys($search);
        if(isset($_REQUEST['order'])){
            $order = [ $search[$keys[($_REQUEST['order'][0]['column'])]] , $_REQUEST['order'][0]['dir']];
        }else{
            $order = ['id','desc'];
        }

        //default datable setting
        $keys           = array_keys($search);
        $join           = NULL;
        $iTotalRecords  = $this->m_global->countDataAll($table, $join, $where, $whereE);
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart  = intval($_REQUEST['start']);
        $sEcho          = intval($_REQUEST['draw']);
        $end            = $iDisplayStart + $iDisplayLength;
        $end            = $end > $iTotalRecords ? $iTotalRecords : $end;
        $select         = implode(',', array_merge($addSelect, $search));
        $result         = $this->m_global->getDataAll($table, $join, $where, $select, $whereE, $order, $iDisplayStart, $iDisplayLength);

        // echo $this->db->last_query();exit;    
        $isi            = [];
        $i              = 1 + $iDisplayStart;

        foreach ($result as $rows) {
            
            //button action
            $btn_edit   = '<a data-original-title="Edit Data" href="'.site_url( $this->url.'show_edit/'. $rows->id ) . '" class="btn btn-sm blue-madison ajaxify tooltips"><i class="fa fa-edit"></i></a>';
            $btn_del    = '<a data-original-title="Delete Data" href="'.site_url($this->url. 'delete/' . $rows->id .'/true') . '" class="btn btn-sm red-sunglo tooltips" onClick="return f_status(2, this, event)"><i class="fa fa-times"></i></a>';
            
            //data
            $isi[] = [
                        $i,
                        $rows->task,
                        $rows->category,
                        $btn_edit.'&nbsp;'.$btn_del
                    ];
            $i++;
        }
        $records["data"]            = $isi;
        $records["draw"]            = $sEcho;
        $records["recordsTotal"]    = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }

    public function show_add()
    {
        csrf_init();

        $data['setting']    = $this->setting;
        $data['breadcrumb'] = [$this->title => $this->setting['url'], 'Tambah' => $this->setting['url'].$this->setting['method']];
        $js['custom']       = ['form-validation'];

        $this->template->display('user/'.$this->prefix.'/'.$this->prefix.'_add', $data, $js);
    }

    public function show_edit($id)
    {
        csrf_init();

        $record             = $this->m_global->getDataAll($this->table_db, NULL, [$this->table_db.'.id' => $id], '*')[0];
        $data['data']       = $record;
        
        $data['id']         = $id;
        $data['setting']    = $this->setting;
        $data['breadcrumb'] = ['Master' => TRUE, $this->title => $this->setting['url'], 'Ubah' => TRUE, $record->category => $this->setting['url'].$this->setting['method'].'/'.$id];
        $js['custom']       = ['form-validation'];

        $this->template->display('user/'.$this->prefix.'/'.$this->prefix.'_edit', $data, $js);
    }

    public function add()
    {
        $input['ex_csrf_token'] = @$this->input->post('ex_csrf_token');

        $res    = [];
        if (csrf_get_token() != $input['ex_csrf_token']){
            $res['status']  = 2;
            $res['message'] = $this->csrf_message;

            echo json_encode($res);
        }else{
            $this->form_validation->set_rules('task','task','required|trim|xss_clean');
            $this->form_validation->set_rules('category','category','required|trim|xss_clean');
         
            if ($this->form_validation->run($this))
            {
                $this->db->trans_start();
                $data               = [
                    'task'       => $this->input->post('task'),
                    'category'   => $this->input->post('category'),
                ];

                $result = $this->m_global->insert($this->table_db, $data);
                if ($result['status'])
                {   
                    $res['status']  = 1;
                    $res['message'] = 'Berhasil menambahkan data <strong>'.$this->input->post('pemeriksaan').'</strong>';
                    echo json_encode($res);
                }

                $this->db->trans_complete();
            }else{
                $res['status']      = 3;
                $str                = ['<p>', '</p>'];
                $str_replace        = ['<li>', '</li>'];
                $res['message']     = str_replace($str, $str_replace, validation_errors());
                echo json_encode($res);
            }
        }
    }

    public function edit($id)
    {
                $data = [
                    'task'      => @$this->input->post('task'),
                    'category'  => $this->input->post('category'),
                ];

                $result = $this->m_global->update($this->table_db, $data, ['id' => $id]);

                if ($result)
                {
                    $res['status'] = 1;
                    $res['message'] = 'successfully changed data';
                    echo json_encode($res);
                } else
                {
                    $res['status'] = 0;
                    $res['message'] = 'Failed Edit Data !';
                    echo json_encode($res);
                }
    }

    public function delete($id)
    {
        $result = $this->m_global->delete($this->table_db, ['id' => $id]);
        if($result){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        echo json_encode($data);
    }


}
