<?php
/************************************************************
** @Description: file
** @Author: george
** @Date:   2018-04-11 13:36:30
** @Last Modified by:   george
** @Last Modified time: 2018-04-12 17:29:37
*************************************************************/
class Article_tag_model extends MY_Model
{
	protected $_table;
	/**
	 * [__construct 初始化方法]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'pp_article_tag';
	}

	/**
	 * [edit_art_tag 编辑标签和文章关系]
	 * @param  [int] $article_id [文章ID]
	 * @param  [arr] $tag_id_arr [标签id]
	 * @param  [int] $type [1-新增，0-修改]
	 * @return [type]             [description]
	 */
	public function save_art_tag($article_id,$tag_id_arr,$type=1)
	{
		#删除 再添加
		if($type===0)
		{
			$sql = ' delete from '.$this->_table .' where article_id='.$article_id;
			$this->db_pp->query($sql);
		}
		$add_sql = ' insert into '.$this->_table.' (article_id,tag_id) values';
		foreach ($tag_id_arr as $key => $value) {
			$add_sql .= '('.$article_id.','.$value.'),';
		}
		$add_sql = rtrim($add_sql,',');
	
		return $this->db_pp->query($add_sql);
	}
}