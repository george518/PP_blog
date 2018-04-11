<?php
/************************************************************
** @Description: 分类管理
** @Author: george
** @Date:   2018-04-11 12:56:20
** @Last Modified by:   george
** @Last Modified time: 2018-04-11 13:34:40
*************************************************************/
class Category extends MY_Controller
{

	protected $model_name;

	public function __construct()
	{
		parent::__construct();
		$this->model_name = "category_model";
	}

	public function index()
	{
		$this->data['page_title'] = '栏目分类列表';
		$this->display('admin/category_list.html');
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
        	$data['data'][$key]['is_nav'] = $value['is_nav']==1 ? '是':'否';
        }
        return $data;
    }

    public function add()
    {
    	$this->data['page_title'] = '新增分类';
    	$this->display('admin/category_add.html');
    }

    public function edit()
    {
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$id = $this->input->get('id');
    	$category = $this->$model->getConditionData("id,cate_name,is_nav,keywords,description,sort",'id='.(int)$id);
    	$this->data['cate'] = $category[0];
    	$this->data['page_title'] = '编辑分类';
    	$this->display('admin/category_edit.html');
    }

    public function del(){
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	#判断分类下有无内容
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