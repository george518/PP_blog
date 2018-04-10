<?php

/************************************************************
** @Description: The file is ...
** @Author: haodaquan
** @Date:   2018-04-07 17:47:43
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-07 17:56:48
*************************************************************/
class User_model extends MY_Model
{
    public $_table = 'uc_user';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * [get_user_by_username 根据用户名获取用户信息]
	 * @Date   2016-06-03
	 * @param  string     $username [用户名]
	 * @return array                [用户信息数组]
	 */
	function get_user_by_username($username='')
	{
		$username = addslashes($username);
		if (!$username) return false;

        $user_info = $this->getConditionData('*','`login_name`="'.$username.'"');
        if (empty($user_info)) return false;
		return $user_info[0];
	}



    /**
     * [get_user 获取user信息]
     * @Date   2016-06-03
     * @return [type]     [description]
     */
    function get_user()
    {
    	$user = $_SESSION['user_info'];
    	if (!$user) return false;
    	return $user;
    	
    }

    /**
     * [get_user_by_uid 根据uid获取用户信息]
     * @Date   2016-06-03
     * @param  integer    $uid [用户id]
     * @return [type]          [description]
     */
    function get_user_by_uid($uid = 0)
    {
        $uid = (int)$uid;
        if($uid==0) return false;
        $user_info = $this->getConditionData('*','`id`='.(int)$uid);
        if (empty($user_info)) return false;
        return $user_info[0];
    }

    /**
     * [check_user 检查登录]
     * @Date   2016-06-03
     * @return [type]     [description]
     */
    function check_user()
    {
        $login_user = $this->get_user();
        if(!$login_user){
            $url = "http://".$_SERVER['HTTP_HOST']."/login";
            header("Location:".$url);
            exit();
        }
        return $login_user;
    }
}