<?php
/************************************************************
** @Description: base controller
** @Author: haodaquan
** @Date:   2018-04-07 09:44:32
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-10 23:16:53
*************************************************************/

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	#页面数据
	public $data = [];

	public function __construct($is_admin=true)
	{
		parent::__construct();
		if ($is_admin) {
			#后台
			$this->load->model('public/user_model');
			$this->data['user'] = $this->user_model->check_user();
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


	public function ajaxReturn($data=[],$status=200,$messages="操作成功")
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
}