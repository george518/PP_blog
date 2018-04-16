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
		$this->load->model('admin/article_model');
		$this->data['art_num'] = $this->article_model->getCount('where status=0');

		$this->load->model('admin/tag_model');
		$this->data['tag_num'] = $this->tag_model->getCount('where status=0');

		$this->load->model('admin/image_model');
		$this->data['img_num'] = $this->image_model->getCount('where status=0');

		$this->load->model('admin/category_model');
		$this->data['cat_num'] = $this->category_model->getCount('where status=0');

		#文章增长图
		// count_by_date
		$time = time();
		$start_time = date('Y-m-d',strtotime("-10 Day",$time));
		$end_time = date("Y-m-d",$time);
		$res = $this->article_model->count_by_date($start_time,$end_time);
		// print_r($res);
		// exit();
		$date = '';
		$count = '';
		foreach ($res as $key => $value) {
			$date .= $value['timedate'].',';
			$count .= $value['counter'].',';
		}
		$this->data['dates'] = $date;
		$this->data['count'] = $count;
		$this->data['page_title'] = '系统首页';
		$this->display('admin/start.html');
	}

}