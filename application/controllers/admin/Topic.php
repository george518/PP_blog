<?php
/************************************************************
** @Description: 专题管理
** @Author: haodaquan
** @Date:   2018-07-28 21:34:11
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-23 10:42:08
*************************************************************/
class Topic extends MY_Controller
{

	protected $model_name;
	protected $category;

	public function __construct()
	{
		parent::__construct();
		$this->model_name = "topic_model";

		$this->load->model('admin/category_model');
	}

	public function index()
	{
		$this->data['page_title'] = '专题列表';
		$this->display('admin/topic_list.html');
	}

	public function table()
	{
		$post = $this->input->post();
        $post['status|='] = 0;
        $post['sort'] = " id.DESC";
		$this->query($post);
	}

	public function listDataFormat($data)
    {
        if(empty($data)) return [];
        $this->load->model("admin/article_topic_model");
        foreach ($data['data'] as $key => $value) {
			$article_topic = $this->article_topic_model->get_topic_article($value['id']);
			$data['data'][$key]['num'] = count($article_topic);
        }
        return $data;
    }

    public function add()
    {
    	$this->data['page_title'] = '新增专题';
    	$this->display('admin/topic_add.html');
    }

    public function edit()
    {
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$id = $this->input->get('id');
    	$topic = $this->$model->getConditionData("*",'id='.(int)$id);

    	$this->load->model("admin/article_topic_model");

		$this->data['article_topic'] = $this->article_topic_model->get_topic_article($id);
		// echo "<pre>";
		// print_r($this->data['article_topic']);

    	$this->data['topic'] = $topic[0];
    	$this->data['page_title'] = '编辑专题';
    	$this->display('admin/topic_edit.html');
    }

    public function save()
    {
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$form_data = $this->input->post();
    	
        if (isset($form_data['id'])) {

        	$data['title'] =  $form_data['title'];
        	$data['detail'] =  $form_data['detail'];
        	$result = $this->$model->editData($data,'id='.(int)$form_data['id']);
        	$relation = [];
        	$this->load->model('admin/article_topic_model');
        	foreach ($form_data as $key => $value) {
        		if (strpos($key, "sort_")!==false) {
        			$arr = explode("_", $key);
        			$re['article_id'] = $arr[1];
        			$re['topic_id'] = $form_data['id'];
        			$re['sort'] = $value;
        			$res = $this->article_topic_model->editData($re,' article_id='.$re['article_id'].' and topic_id='.$re['topic_id'],0);
        			
        		}
        	} 
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

    public function del()
    {
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	#判断topic下有无内容
    	
    	$id = $this->input->post('id');
    	$data['id'] = (int)$id;
    	$data['status'] = 1;
    	$result = $this->$model->editData($data,'id='.(int)$id);

    	$up['status'] = 1;
    	$this->load->model('admin/article_topic_model');
    	$this->article_topic_model->editData($up,' topic_id='.$id,0);

    	if (!$result) {
    		$this->ajaxReturn($result,300,'删除失败');
    	}else{
    		$this->ajaxReturn($result);
    	}
    }
}
