<?php
/************************************************************
** @Description: 
** @Author: haodaquan
** @Date:   2017-01-17 00:50:54
** @Last Modified by:   haodaquan
** @Last Modified time: 2017-01-17 00:51:16
*************************************************************/

class banner_model extends MY_Model
{
	protected $_table;
	/**
	 * [__construct 初始化方法]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'pp_banner';
	}

}