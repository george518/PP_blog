<?php

/************************************************************
** @Description: The file is ...
** @Author: haodaquan
** @Date:   2018-04-07 19:22:03
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-07 19:33:28
*************************************************************/
class Config_model extends MY_Model
{
	protected $_table;
	/**
	 * [__construct 初始化方法]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'pp_config';
	}

	/**
	 * [get_config 获取全局配置]
	 * @return [type] [description]
	 */
	public function get_config()
	{
		$config_ = $this->getConditionData('*','status=0');
        $config = [];
        foreach ($config_ as $key => $value) {
            $config[$value['key']] = $value['value'];
        }
       	return $config;
	}
}