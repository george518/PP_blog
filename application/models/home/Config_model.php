<?php
/************************************************************
** @Description: 配置
** @Author: haodaquan
** @Date:   2017-01-12 02:27:30
** @Last Modified by:   haodaquan
** @Last Modified time: 2017-01-15 13:34:57
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