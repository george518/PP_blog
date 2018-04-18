<?php
/************************************************************
** @Description: 
** @Author: haodaquan
** @Date:   2017-01-15 13:33:07
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-18 09:07:32
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

	/**
	 * [get_category 获取分类]
	 * @param  integer $is_nav [是否只要导航]
	 * @param  string  $type   [是否要全部字段]
	 * @return [type]          [description]
	 */
	public function get_category($is_nav=0,$type='cate_name')
	{
		$where = 'status=0';
		if ($is_nav==1) {
			$where .= ' AND is_nav=1';
		}
		$category_ = $this->getConditionData('*',$where,' sort ASC');
		foreach ($category_ as $key => $value) {
			if ($type=='cate_name') {
				$category[$value['id']] = $value['cate_name'];
			}else {
				$category[$value['id']] = $value;
			}
			
		}

		return $category;
	}
}