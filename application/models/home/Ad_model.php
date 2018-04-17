<?php
/************************************************************
** @Description: 
** @Author: haodaquan
** @Date:   2017-02-08 13:57:23
** @Last Modified by:   haodaquan
** @Last Modified time: 2017-02-13 10:54:38
*************************************************************/
class Ad_model extends MY_Model
{
	protected $_table;
	/**
	 * [__construct 初始化方法]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'pp_ad';
	}

}