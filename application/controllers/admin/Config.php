<?php
/************************************************************
** @Description: 站点配置
** @Author: haodaquan
** @Date:   2018-04-10 22:59:39
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-10 23:37:43
*************************************************************/

class Config extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

	}

	public function edit()
	{
		$this->data['page_title'] = '站点配置';
		$this->display('admin/config_edit.html');
	}

	public function save()
	{
		$_data = $this->input->post();

        $this->load->model('admin/config_model');
        foreach ($_data as $key => $value) {
            $data = [];
            $data['key'] = $key;
            $data['value']   = $value;
            $data['status']    = 0;
            $res[] = $this->config_model->saveData($data,' `key`="'.$key.'"');
        }
        if (in_array(false,$res) || in_array(-1,$res)) {
            $this->ajaxReturn($res,300,'保存错误');
        }else
        {
            $this->ajaxReturn($res,0);
        }
	}
}