<?php
/************************************************************
** @Description: 管理员
** @Author: haodaquan
** @Date:   2018-04-10 21:53:57
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-10 23:17:43
*************************************************************/

class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function edit()
	{
		$this->data['page_title'] = '修改密码';
		$this->display('admin/admin_edit.html');
	}

	public function save()
	{
		$_data = $this->input->post();
		
        $data = [];
        foreach ($_data as $key => $value) {  
        	if(!$value) $this->ajaxReturn($value,300,'请填写数据完整');
            $data[$key]  = $value;
        }

        $user_info = $this->user_model->get_user_by_uid($this->data['user']['id']);

        if(md5(sha1($data['password']))!==$user_info['password']){
			$this->ajaxReturn($user_info['user_name'],300,'请输入正确的原密码');
		}

		//密码要6位-32位
        if(strlen($data['password1'])<6 || strlen($data['password1'])>20)
        {
           $this->ajaxReturn($user_info['user_name'],300,'密码位数不对，请重新输入');
        }

		if(trim($data['password1'])!==trim($data['password2']))
		{
			$this->ajaxReturn($user_info['user_name'],300,'两次密码不一致，请重新输入');
		}

		$data['password'] = md5(sha1($data['password1']));
		unset($data['password1']);
		unset($data['password2']);

         $res = $this->user_model->saveData($data,' id='.(int)$user_info['id']);
        if (!$res) {
            $this->ajaxReturn($res,300,'保存错误');
        }else
        {
            $this->ajaxReturn($res,0,'修改成功，请退出重新登录');
        }
	}

}
