<?php

/************************************************************
** @Description: file
** @Author: george
** @Date:   2018-04-11 16:16:48
** @Last Modified by:   george
** @Last Modified time: 2018-04-11 16:17:14
*************************************************************/
class Topic_model extends MY_Model
{
	protected $_table;
	/**
	 * [__construct 初始化方法]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'pp_topic';
	}


	public function get_topic()
	{
		$where = 'status=0';
		$topic = [];
		$topic_ = $this->getConditionData('*',$where);
		if (count($topic_)<1) {
			return [];
		}
		foreach ($topic_ as $key => $value) {
			$topic[$value['id']] = $value['title'];
		}

		return $topic;
	}

}