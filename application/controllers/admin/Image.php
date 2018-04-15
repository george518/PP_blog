<?php
/************************************************************
** @Description: 图片管理
** @Author: george
** @Date:   2018-04-11 16:14:00
** @Last Modified by:   george
** @Last Modified time: 2018-04-11 16:16:02
*************************************************************/

class Image extends MY_Controller
{

	protected $model_name;

	public function __construct()
	{
		parent::__construct();
		$this->model_name = "image_model";
	}

	public function index()
	{
		$this->data['page_title'] = '图片列表';
		$this->display('admin/image_list.html');
	}

	public function table()
	{
		$post = $this->input->post();
        $post['sort'] = 'add_time.desc';
        $post['status|='] = 0;
		$this->query($post);
	}

	public function listDataFormat($data)
    {
        if(empty($data)) return [];
        $type = ['banner','cover','md_img'];
        foreach ($data['data'] as $key => $value) {
            $data['data'][$key]['img_src'] = '<img src="'.$value['img_src'].'">';
            $data['data'][$key]['type'] = isset($type[$value['type']]) ? $type[$value['type']] : '<font color="red">未知</font>';
        	$data['data'][$key]['add_time'] = date('Y-m-d H:i:s',$value['add_time']);
        }
        return $data;
    }


    public function del()
    {
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$id = $this->input->post('id');
    	$img_source = $this->$model->getConditionData("img_src",'id='.(int)$id);
    	$data['id'] = (int)$id;
    	$data['status'] = 1;
    	$result = $this->$model->editData($data,'id='.(int)$id);

    	if (!$result) {
    		$this->ajaxReturn($result,300,'删除失败');
    	}else{
    		#同时删除实际图片资源
    		$filename = dirname(BASEPATH).$img_source[0]['img_src'];
    		if(file_exists($filename)){
		        unlink($filename);
		    }
    		$this->ajaxReturn($result);
    	}
    }


}