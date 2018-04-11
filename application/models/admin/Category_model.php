<?php
/************************************************************
** @Description: file
** @Author: george
** @Date:   2018-04-11 13:06:20
** @Last Modified by:   george
** @Last Modified time: 2018-04-11 13:06:44
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
}