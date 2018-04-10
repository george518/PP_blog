<?php

/************************************************************
** @Description: The file is ...
** @Author: haodaquan
** @Date:   2018-04-07 18:01:55
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-10 21:40:23
*************************************************************/
class Home extends MY_Controller
{
	public $user;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('public/user_model');
		$this->user = $this->user_model->check_user();
	}

	public function index()
	{
		$this->data['user']           = $this->user;
		$this->load->view('admin/main.html',$this->data);
	}

	public function start()
	{
		echo "起始页";
	}

}