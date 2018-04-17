<?php
/************************************************************
** @Description: The file is ...
** @Author: haodaquan
** @Date:   2018-04-07 10:47:55
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-07 10:50:31
*************************************************************/

class Home extends MY_Controller 
{
	public $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home/config_model');
		$this->load->model('home/category_model');
		$this->load->model('home/banner_model');
		$this->load->model('home/article_model');
		$this->data['config']   = $this->config_model->get_config();
		$this->data['category'] = $this->category_model->get_category(1);
		$this->data['version'] = time();
		$this->data['tags'] = $this->get_top_tag(40);
		$this->every_page = 10;
	}
	
	/**
	 * [index 首页]
	 * @Date   2017-02-03
	 * @return [type]     [首页]
	 */
	public function index()
	{
		$data = $this->data;
		#首页banner
		$banner = $this->banner_model->getConditionData("id,url,img_src,title",'status=0',' sort ASC',5);
		$data['banner'] = $banner;

		#头条
		$headline = $this->article_model->getConditionData("*",'status=0 and headline=1',' add_time DESC ',1);
		$data['headline'] = $headline[0];

		$data['cate'] = $this->category_model->get_category();

		#主列表
		$main_list = $this->article_model->getConditionData("*",'status=0 AND headline=0',' recommand DESC, add_time DESC ',10);
		$data['main_list'] = $main_list;

		#推荐阅读
		$data['recommand'] = $this->article_model->getConditionData("id,title",'status=0 AND recommand=1',' hits DESC',10);

		$data['hots'] = $this->article_model->getConditionData("id,title",'status=0',' hits DESC',10);

		#友情连接
		$this->load->model('admin/link_model');
		$data['link'] = $this->link_model->getConditionData("*",'status=0',' sort DESC');
		$data['tags'] = $this->get_top_tag(50);
		$this->show('home/index.html',$data);
	}
	/**
	 * [alist 列表页]
	 * @return [type] [description]
	 */
	public function alist()
	{
		$data = $this->data;

		if($this->input->get('page'))
		{
			$param[0] = $cid = $this->input->get('cid');
			$param[1] = $this->input->get('page');
		}else
		{
			$param = PU();
		}

		#搜索(标签)，分类
		$page = isset($param[1]) ? (int)$param[1] : 1;
		$every_page  = $this->every_page;
		$limit_start = ($page-1)*$every_page;
		$cid = isset($param[0]) ? (int)$param[0] : '';

		if(!$cid || !isset($data['category'][$cid])){
			$this->error_404();
			return;
		}
		$data['cid'] = $cid;
		$data['page_info'] = $data['category'][$cid];

		#优化
		$data['config']['title'] = $data['page_info']['cate_name'].'_'.$data['config']['web_name'];
		$data['config']['keywords'] = $data['page_info']['keywords'] ? $data['page_info']['keywords'] : $data['config']['keywords'];
		$data['config']['description'] = $data['page_info']['description'] ? $data['page_info']['description'] : $data['config']['description'];

		$where  = ' status=0 ';
		$where .= $cid ? ' AND cate_id='.(int)$cid : '';
		$data['main_list'] = $this->article_model->getConditionData("*",$where,' add_time DESC ',$limit_start.','.$every_page);
		
		if($data['main_list']) {
			$data['page']  = $page+1;
		}else{
			$data['page']  = $page;
		}

		$data['tags'] = $this->get_top_tag(50);

		#热门
		$data['comment'] = $this->article_model->getConditionData("*",'status=0',' hits DESC',10);
		$this->show('home/list.html',$data);
		
	}

	/**
	 * [content 内容页]
	 * @return [type] [description]
	 */
	public function content()
	{
		$data  = $this->data;
		$param = PU();

		$aid = $param[0];
		if(!$aid){
			$this->load->view('home/404.html',$data);
			return;
		}

		$content = $this->article_model->getConditionData("*",'status=0 AND id='.(int)$aid,'',1);
		if(!isset($content[0])){
			$this->error_404();
			return;
		}
		$data['content']  = $content[0];
		$data['page_info'] = $data['category'][$content[0]['cate_id']];

		#优化
		$data['config']['title'] = $data['content']['title'].'_'.$data['config']['web_name'];
		$data['config']['keywords'] = $data['content']['tag'] ? $data['content']['tag'] : $data['config']['keywords'];
		$data['config']['description'] = $data['content']['detail'] ? $data['content']['detail'] : $data['config']['description'];
		#相关
		$tag = explode(',',$content[0]['tag']);
		$where = '';

		if($tag)
		{
			foreach ($tag as $key => $value) {
				if(!$value) continue;
				$where .= ' tag like "%'.$value.'%" OR';
				
			}
		}
		if($where)
		{
			$where = trim($where,' OR');
			$where = ' status=0 AND ('.$where.')';
		}else
		{
			$where = ' status=0 ';
		}

		$data['tag']     = $tag;
		$data['relation'] = $this->article_model->getConditionData("*",$where,' add_time DESC ',5);
		#热门
		$data['comment'] = $this->article_model->getConditionData("*",'status=0',' hits DESC',10);

		#增加记录
		$this->article_model->fieldIncrease(' id='.$aid ,'hits');

		#获取评论数
		// $url = "http://api.duoshuo.com/threads/counts.json?short_name=".$data['config']['duoshuo_name']."&threads=".$aid;
		// $con = json_decode(http($url,[],'GET'),true);
		// $data['comments'] =  isset($con['response'][1]['comments']) ? $con['response'][1]['comments'] : 123;
		$data['comments'] =  123;

		$data['tags'] = $this->get_top_tag(50);
		$this->show('home/content.html',$data);
	}

	/**
	 * [tags 标签页面]
	 * @return [type] [description]
	 */
	public function tags()
	{
		$data = $this->data;
		$data['tags'] = $this->get_top_tag();
		$data['config']['title'] = '标签云_'.$data['config']['web_name'];
		$data['config']['keywords'] =  '标签云,'.$data['config']['keywords'];
		$data['config']['description'] = '标签云'.$data['config']['description'];
		$this->show('home/tags.html',$data);
	}

	/**
	 * [tag_search 标签搜索页面]
	 * @return [type] [description]
	 */
	public  function tag_search()
	{
		$data  = $this->data;

		if($this->input->get('page'))
		{
			$param[0] = $this->input->get('page');
			$param[1] = $this->input->get('tid');
			
		}else
		{
			$param = PU();
		}

		$page = $param[0]!='tag' ? (int)$param[0] : 1;
		$every_page  = $this->every_page;
		$limit_start = ($page-1)*$every_page;
		$tag_id = $param[1];
		$this->load->model('home/tag_model');

		$tag_info = $this->tag_model->getConditionData('*',' id='.(int)$tag_id);
		$data['tag_info'] = $tag_info[0];

		$this->load->model('home/tag_article_model');
		$aids = $this->tag_article_model->getConditionData('article_id',' tag_id='.(int)$tag_id);

		$aid_str = '';
		foreach ($aids as $key => $value) {
			$aid_str .= $value['article_id'].',';
		}

		$aid_str = rtrim($aid_str,',');

		$data['main_list'] = [];

		if($aid_str)
		{
			$where  = ' status=0 ';
			$where .= ' AND id in('.$aid_str.')';
			$data['main_list'] = $this->article_model->getConditionData('*',$where,' add_time DESC ',$limit_start.','.$every_page); 
		}

		if($data['main_list']) {
			$data['page']  = $page+1;
		}else{
			$data['page']  = $page;
		}

		$data['tags'] = $this->get_top_tag(50);

		#热门
		$data['comment'] = $this->article_model->getConditionData("*",'status=0',' hits DESC',10);

		$data['config']['title'] = $tag_info[0]['tag_name'].'_'.$data['config']['web_name'];
		$data['config']['keywords'] = $tag_info[0]['tag_name'].','.$data['config']['keywords'];
		$data['config']['description'] = $tag_info[0]['tag_name'].'-'.$data['config']['description'];
		$this->show('home/tag_search.html',$data);
	}

	/**
	 * [search 搜索页]
	 * @return [type] [description]
	 */
	public  function search()
	{
		$data  = $this->data;

		if($this->input->get('page'))
		{
			$param[0] = $this->input->get('page');
			$param[1] = $this->input->get('w');
			
		}else
		{
			$param[0] = 1;
			$param[1] = $this->input->post('keyword');
		}

		$page = isset($param[0]) ? (int)$param[0] : 1;
		$every_page  = $this->every_page;
		$limit_start = ($page-1)*$every_page;

		$word = addslashes($param[1]);
		$data['word'] = $word;

		$data['main_list'] = [];

		if($word)
		{
			$where  = ' status=0 ';
			$where .= ' AND title like "%'.$word.'%"';
			$data['main_list'] = $this->article_model->getConditionData('*',$where,' add_time DESC ',$limit_start.','.$every_page); 
		}

		if($data['main_list']) {
			$data['page']  = $page+1;
		}else{
			$data['page']  = $page;
		}

		$data['tags'] = $this->get_top_tag(50);

		#热门
		$data['comment'] = $this->article_model->getConditionData("*",'status=0',' hits DESC',10);

		$data['config']['title'] = $word.'_'.$data['config']['web_name'];
		$data['config']['keywords'] = $word.','.$data['config']['keywords'];
		$data['config']['description'] = $word.'-'.$data['config']['description'];

		$this->show('home/search.html',$data);
	}
	/**
	 * [show 前端加载模板]
	 * @param  string $content_file [加载主要部分]
	 * @param  array $data [页面数据]
	 * @return [type]              [description]
	 */
	public function show($content_file='',$data=[])
	{
		$this->load->view('home/header.html',$data);
		$this->load->view($content_file,$data);
		$this->load->view('home/footer.html',$data);
	}

	/**
	 * [error_404 description]
	 * @return [type] [description]
	 */
	public function error_404()
	{
		$this->load->view('home/header.html',$this->data);
		$this->load->view('home/404.html',$this->data);
		$this->load->view('home/footer.html',$this->data);
	}

	/**
	 * [get_top_tag 获取最高标签]
	 * @return [type] [description]
	 */
	public function get_top_tag($limit=0)
	{
		$this->load->driver('cache');
		$tags = $this->cache->file->get('tags'.$limit);	
		if (!$tags)
		{
		    $this->load->model('home/tag_model');
			$tags =  $this->tag_model->get_tag_order($limit);
		    // Save into the cache for 5 minutes
		    $res = $this->cache->file->save('tags'.$limit, $tags, 1800);
		}
		return $tags;
	}

}