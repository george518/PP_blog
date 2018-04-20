<?php
/************************************************************
** @Description: The file is ...
** @Author: haodaquan
** @Date:   2018-04-07 17:09:50
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-20 18:41:11
*************************************************************/

class Verify_code extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(false);
	}

	/**
	 * [set_verify_code 获取验证码]
	 */
	public function set_verify_code()
	{
		$verify_code = $this->verify_code();
		$img_url = $this->data['web_info']['host'].'/captcha/'.$verify_code['filename'];
		$this->session->set_userdata('verify_code', $verify_code['word']);
		$this->ajaxReturn([$img_url],200,'success');
	}

	protected function verify_code()
	{
		$this->load->helper('captcha');
		// $this->load->helper('url');
		$vals = array(
		    // 'word'      => 'Random word',
		    'img_path'  => 'captcha/',
		    'img_url'   => $this->data['web_info']['host'].'/captcha/',
		    // 'font_path' => 'static/public/font/TronRegular.ttf',
		    'font_path' => 'static/public/font/Racing.otf',

		    'img_width' => '100',
		    'img_height'    => 38,
		    'expiration'    => 300,
		    'word_length'   => 4,
		    'font_size' => 16,
		    'img_id'    => 'Imageid',
		    'pool'      => '23456789abcdefhijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		    
		    'colors'    => array(
		        'background' => array(255, 255, 255),
		        'border' => array(255, 255, 255),
		        'text' => array(0, 150, 136),
		        'grid' => array(0, 150, 136)
		    )
		);

		$cap = create_captcha($vals);
		return $cap;
	}
}