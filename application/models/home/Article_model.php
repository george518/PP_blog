<?php
/************************************************************
** @Description: 
** @Author: haodaquan
** @Date:   2017-01-17 23:58:52
** @Last Modified by:   haodaquan
** @Last Modified time: 2017-02-13 10:54:43
*************************************************************/

class Article_model extends MY_Model
{
	protected $_table;
	/**
	 * [__construct 初始化方法]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'pp_article';
	}

}