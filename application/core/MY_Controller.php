<?php
/************************************************************
** @Description: base controller
** @Author: haodaquan
** @Date:   2018-04-07 09:44:32
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-11 11:38:12
*************************************************************/

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	#页面数据
	public $data = [];
	public $module = 'home';

	public function __construct($is_admin=true)
	{
		parent::__construct();
		if ($is_admin) {
			#后台
			$this->load->model('public/user_model');
			$this->data['user'] = $this->user_model->check_user();
			$this->module = 'admin';
		}
		$this->data['version'] = time();
		$this->data['web_info'] = $this->web_config();
	}


	public function web_config()
	{
		$this->load->model('admin/config_model');
        $config = $this->config_model->get_config();
        return $config;
	}


	public function ajaxReturn($data=[],$status=0,$messages="操作成功")
	{
		echo  json_encode(
			['status'=>$status,'msg'=>$messages,'data'=>$data]
		);
		exit();
	}

	/**
	* [display 后端加载模板]
	* @param  string $content_file [加载主要部分]
	* @param  array $data [页面数据]
	* @return [type]              [description]
	*/
	public function display($content_file='',$model="admin")
	{
		$this->load->view($model.'/header.html',$this->data);
        $this->load->view($content_file,$this->data);
        $this->load->view($model.'/footer.html',$this->data);
	}

	 /**
     * [query 查询列表数据]
     * @Author haodaquan
     * @Date   2016-04-07
     * @return [type]     [description]
     */
    public function query($requst_data)
    {
    	$model = $this->model_name;
    	if (!isset($this->$model)) {
    		$this->load->model($this->module.'/'.$model);
    	}
        $data  = $this->$model->queryList($requst_data);
      	$listData  =  $this->listDataFormat($data);
        echo json_encode($listData);
    }

    /**
     * [listDataFormat 列表数据格式化,子类一般需要重写]
     * @Author haodaquan
     * @Date   2016-04-07
     * @param  array      $data [description]
     * @return [type]           [description]
     */
    public function listDataFormat($listData)
    {
        if(empty($listData)) return [];
        return $listData;
    }
}