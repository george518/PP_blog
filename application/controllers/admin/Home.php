<?php

/************************************************************
** @Description: The file is ...
** @Author: haodaquan
** @Date:   2018-04-07 18:01:55
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-11 08:56:55
*************************************************************/
class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('admin/main.html',$this->data);
	}

	public function start()
	{
		$this->data['page_title'] = '系统首页';
		$this->display('admin/start.html');
	}

}