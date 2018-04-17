<?php
/************************************************************
** @Description: 
** @Author: haodaquan
** @Date:   2017-02-12 17:55:18
** @Last Modified by:   haodaquan
** @Last Modified time: 2017-02-13 22:58:02
*************************************************************/

class Tag_model extends MY_Model
{
	protected $_table;
	/**
	 * [__construct 初始化方法]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'pp_tag';
	}

	/**
	 * [get_tag_order 获取tag顺序]
	 * @param  integer $limit [获取前几个]
	 * @return [type]         [description]
	 */
	public function get_tag_order($limit=0)
	{
		$sql = 'SELECT
					tag_id,
					count(*)AS num,
					tag_name,
					is_top
				FROM
					pp_article_tag AS at
				LEFT JOIN pp_tag AS t ON t.id = at.tag_id
				WHERE t.status=0
				GROUP BY
					tag_id
				ORDER BY
					t.is_top DESC,num DESC';
		if ($limit!=0) {
			$sql .= ' LIMIT '.(int)$limit;
		}
		return $this->db_pp->query($sql)->result_array();
	}
}