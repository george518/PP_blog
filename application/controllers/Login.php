<?php
/************************************************************
** @Description: The file is ...
** @Author: haodaquan
** @Date:   2018-04-07 10:48:03
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-11 08:50:03
*************************************************************/

class Login extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct(false);
	}

	/**
	 * [index 登录页面]
	 * @return [type] [description]
	 */
	public function index()
	{
       	$this->load->view('login/login.html',$this->data);
	}


	public function login_in()
	{
		$data = $this->input->post();

    	$username = $this->input->post("username");
        $password = $this->input->post("password");
        $code = $this->input->post("code");

        //用户名只能是字母+数字，4位-20位
        if(!preg_match("/^[a-zA-Z0-9][a-zA-Z0-9]{3,19}$/", $username))
        {
            $this->ajaxReturn([],300,'用户名格式有误');
        }

        //密码要6位-32位
        if(strlen($password)<6 || strlen($password)>32)
        {
            $this->ajaxReturn([],300,'密码位数有误');
        }

        $username = htmlentities($username);
        $this->load->model('public/user_model');
        $user = $this->user_model->get_user_by_username($username);
        
        if(!$user || !$user["password"])
        {
            $this->ajaxReturn([],300,'用户不存在');
        }
        
        if($user["password"] != md5(sha1($password)))
        {
            $this->ajaxReturn([],300,'密码有误');
        }
        $verify_code = $this->session->verify_code;
        if (strtolower($verify_code)!==strtolower(trim($code))) {
        	$this->ajaxReturn([strtolower($verify_code),strtolower(trim($code)),$this->session],300,'验证码有误');
        }

        unset($user['password']);
        $_SESSION['user_info'] = $user;
        $this->ajaxReturn('',0,'登录成功');
	}

    public function login_out()
    {
        unset($_SESSION['user_info']);
        $url = isset($this->data['web_info']['host']) ? $this->data['web_info']['host'] :  "http://".$_SERVER['HTTP_HOST']."/";
        header("Location:".$url."/login");
        exit(); 
    }
}