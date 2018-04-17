<?php
/************************************************************
** @Description: 
** @Author: haodaquan
** @Date:   2017-02-13 23:23:51
** @Last Modified by:   haodaquan
** @Last Modified time: 2017-02-13 23:24:26
*************************************************************/

class Tag_article_model extends MY_Model
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
}