<?php
/************************************************************
** @Description: 文章管理
** @Author: haodaquan
** @Date:   2018-04-10 21:34:11
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-10 21:34:21
*************************************************************/
class Article extends MY_Controller
{

	protected $model_name;
	protected $category;

	public function __construct()
	{
		parent::__construct();
		$this->model_name = "article_model";

		$this->load->model('admin/category_model');
	}

	public function index()
	{
		$this->data['page_title'] = '文章列表';
		$this->display('admin/article_list.html');
	}

	public function table()
	{
		$post = $this->input->post();
        $post['status|='] = 0;
		$this->query($post);
	}

	public function listDataFormat($data)
    {
    	$category = $this->category_model->get_category();

    	$recommand_tag = ' <span class="layui-badge layui-bg-green">荐</span> ';
    	$top_tag = ' <span class="layui-badge">头</span> ';
    	$original_tag = ' <span class="layui-badge layui-bg-blue">原</span> ';
        if(empty($data)) return [];
        foreach ($data['data'] as $key => $value) {
        	$data['data'][$key]['cate_name'] = isset($category[$value['cate_id']]) ? $category[$value['cate_id']] : '未知';

        	if($value['recommand']==1){
        		$data['data'][$key]['title'] = $data['data'][$key]['title'].$recommand_tag;
        	}

        	// if($value['is_original']==1){
        	// 	$data['data'][$key]['title'] = $data['data'][$key]['title'].$original_tag;
        	// }

        	if($value['headline']==1){
        		$data['data'][$key]['title'] = $data['data'][$key]['title'].$top_tag;
        	}

        	$data['data'][$key]['add_time'] = date('Y-m-d',$value['add_time']);
        	
        }
        return $data;
    }

    public function add()
    {
    	$this->data['cate'] = $this->category_model->get_category();
    	$this->data['page_title'] = '新增分类';
    	$this->display('admin/article_add.html');
    }

    public function edit()
    {
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$id = $this->input->get('id');
    	$article = $this->$model->getConditionData("id,cate_name,is_nav,keywords,description,sort",'id='.(int)$id);
    	$this->data['cate'] = $article[0];
    	$this->data['page_title'] = '编辑分类';
    	$this->display('admin/article_edit.html');
    }

    public function tag_add()
    {
    	$this->load->model('admin/tag_model');
    	$this->data['tag'] = $this->tag_model->getConditionData('id,tag_name','status=0',' is_top ASC');
    	$this->display('admin/article_tag_add.html');
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