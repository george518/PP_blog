<?php
/************************************************************
** @Description: 
** @Author: haodaquan
** @Date:   2017-01-15 13:33:07
** @Last Modified by:   haodaquan
** @Last Modified time: 2017-01-15 13:37:32
*************************************************************/

class Category_model extends MY_Model
{
	protected $_table;
	/**
	 * [__construct 初始化方法]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'pp_category';
	}

	public function get_category($is_nav=0)
	{
		$where = 'status=0';
		if ($is_nav==1) {
			$where .= ' AND is_nav=1';
		}
		$category_ = $this->getConditionData('*',$where,' sort ASC');
		foreach ($category_ as $key => $value) {
			$category[$value['id']] = $value['cate_name'];
		}

		return $category;
	}

}