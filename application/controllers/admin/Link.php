<?php
/************************************************************
** @Description: file
** @Author: george
** @Date:   2018-04-11 08:55:06
** @Last Modified by:   george
** @Last Modified time: 2018-04-11 13:13:13
*************************************************************/
class Link extends MY_Controller
{

	protected $model_name;

	public function __construct()
	{
		parent::__construct();
		$this->model_name = "link_model";
	}

	public function index()
	{
		$this->data['page_title'] = '友情链接列表';
		$this->display('admin/link_list.html');
	}

	public function table()
	{
        $post = $this->input->post();
        $post['status|='] = 0;
		$this->query($post);
	}

	public function listDataFormat($data)
    {
        if(empty($data)) return [];
        foreach ($data['data'] as $key => $value) {
        	$data['data'][$key]['add_time'] = date("Y-m-d H:i:s",$value['add_time']);
        }
        return $data;
    }

    public function add()
    {
    	$this->data['page_title'] = '新增友情链接';
    	$this->display('admin/link_add.html');
    }

    public function edit()
    {
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$id = $this->input->get('id');
    	$link = $this->$model->getConditionData("id,link_name,link_url,sort",'id='.(int)$id);
    	$this->data['link'] = $link[0];
    	$this->data['page_title'] = '编辑友情链接';
    	$this->display('admin/link_edit.html');
    }

    public function del(){
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$id = $this->input->post('id');
    	$data['id'] = (int)$id;
    	$data['status'] = 1;
    	$result = $this->$model->editData($data,'id='.(int)$id);

    	if (!$result) {
    		$this->ajaxReturn($result,300,'删除失败');
    	}else{
    		$this->ajaxReturn($result);
    	}
    }

    public function save()
    {
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$form_data = $this->input->post();
        if (isset($form_data['id'])) {
        	$result = $this->$model->editData($form_data,'id='.(int)$form_data['id']);
        }else
        {
        	$result = $this->$model->addData($form_data);
        }

        if($result===false || $result<1)
        {
        	$this->ajaxReturn($result,300,'保存失败');
        }else
        {
        	$this->ajaxReturn($result);
        }
    }

}