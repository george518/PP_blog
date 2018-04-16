<?php
/************************************************************
** @Description: file
** @Author: george
** @Date:   2018-04-11 13:36:30
** @Last Modified by:   george
** @Last Modified time: 2018-04-11 13:36:50
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

	public function count_by_date($start_time,$end_time)
	{
		$sql = "SELECT  
				    count(*) AS counter,timedate  
				FROM  
				    (  
				        SELECT  
				            *, date_format(  
				                from_unixtime(c.add_time),  
				                '%Y-%m-%d'  
				            ) AS timedate  
				        FROM  
				            pp_article AS c  
				    ) temp  
				WHERE  
				    timedate >= '".$start_time."'  
				AND timedate <= '".$end_time."'  
				GROUP BY  
				    timedate 
				ORDER BY timedate ASC";

		$data = $this->db_pp->query($sql)->result_array();
		return $data;
	}
}