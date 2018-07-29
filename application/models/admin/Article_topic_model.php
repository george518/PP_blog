<?php
/************************************************************
** @Description: file
** @Author: george
** @Date:   2018-04-11 13:36:30
** @Last Modified by:   george
** @Last Modified time: 2018-04-12 17:29:37
*************************************************************/
class Article_topic_model extends MY_Model
{
	protected $_table;
	/**
	 * [__construct 初始化方法]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'pp_article_topic';
	}


	public function get_topic_article($topic_id)
	{
		$sql = ' select a.title,a.id,at.sort,at.topic_id from '.$this->_table .' as at join pp_article as a on a.id=at.article_id where a.status=0 and at.status=0 and topic_id='.$topic_id.' order by at.sort ASC';

		$res = $this->db_pp->query($sql)->result_array();
		
		$data = [];
		if (count($res)<1) {
			return $data;
		}
		foreach ($res as $key => $value) {
			$data[$value['id']."-".$value['topic_id']] = $value;
		}

		return $data;
	}


	public function get_topic_aid($aid)
	{
		$res = $this->getConditionData('topic_id',' status=0 AND article_id='.$aid);
		$topic_id = [];
		if (count($res)<1) {
			return $topic_id;
		}

		foreach ($res as $key => $value) {
			$topic_id[] = $value['topic_id'];
		}
		return $topic_id;
	}

	/**
	 * [edit_art_tag 编辑专题和文章关系]
	 * @param  [int] $article_id [文章ID]
	 * @param  [arr] $topic_id_arr [标签id]
	 * @param  [int] $type [1-新增，0-修改]
	 * @return [type]             [description]
	 */
	public function save_art_topic($article_id,$topic_id_arr,$type=1)
	{
		#删除 再添加
		if($type===0)
		{
			$up['status'] = 1;
			$this->editData($up,' article_id='.$article_id,0);
		}

		foreach ($topic_id_arr as $key => $value) {
			$up['article_id'] = $article_id;
			$up['topic_id'] = $value;
			$up['status'] = 0;
			$this->saveData($up,' article_id='.$article_id.' and topic_id='.$value,0);
		}
		return count($topic_id_arr);
	}
}