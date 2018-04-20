<?php

/************************************************************
** @Description: file
** @Author: george
** @Date:   2018-04-20 16:20:34
** @Last Modified by:   george
** @Last Modified time: 2018-04-20 18:06:37
*************************************************************/
class Move extends MY_Controller
{
	public $test_str = '<p>前言：到现在为止，工厂模式讨论完了，可以我觉得还是差点事情，那就是没有uml图，另外，也想对工厂模式说说自己的一些理解。</p><p>内容概要：</p><p>1、三种工厂模式的UML图</p><p>2、工厂模式总结</p><p>一、三种工厂模式的UML图</p><p>太懒了，就没画出来，找出原先学习笔记里的图贴出来，也忘记图原作者是谁了，借用一下哈。</p><p><img src="/Uploads/ueditor/image/20170327/1490591947288638.png" title="1490591947288638.png" alt="blob.png"/></p><p><img src="/Uploads/ueditor/image/20170327/1490591954734187.png" title="1490591954734187.png" alt="blob.png"/></p><p><img src="/Uploads/ueditor/image/20170327/1490591963453670.png" title="1490591963453670.png" alt="blob.png"/></p><p>二、工厂模式总结</p><p>简单工厂模式：用来生产同一类型的任意产品，比如冰激凌是一种类型，有牛奶味的冰激凌，苹果味的冰激凌。对新增产品种类，需要修改代码，适合对象较少的情况。</p><p>工厂方法模式：用来生产同一类型的固定产品，支持增加任意产品，适合无法预知产品子类数量的情况。</p><p>抽象工厂模式：可以生产不同类型的全部商品。支持增加产品类型，但也不支持新增产品种类，适合生产不同产品组的全部产品。</p><p>总结：工厂方法在等级结构和产品类型两个方向的支持情况不同，需要根据实际情况来选择使用合适的工厂模式。&nbsp;</p><p><br/></p>';
	public $base_path;
	public function __construct()
	{
		parent::__construct(false);

		$this->base_path = $path = dirname(BASEPATH);
	}

	public function image_move()
	{
		$this->load->model('admin/article_model');
		$data = $this->article_model->getConditionData('id,img_src,content','status=0');
		foreach ($data as $key => $value) {

			$img_src[] = $value['img_src'];
			$art_img = $this->find_img($value['content']);
			$img_src = array_merge($img_src,$art_img);

			foreach ($img_src as $k => $v) {
				$old_img =  str_replace("/Uploads","/Uploads1" , $v);

				if (is_file($this->base_path.$v)) {
					// echo $this->base_path.$v.' success <br>';
					continue;
				}

				if (is_file($this->base_path.$old_img)) {
					$res = $this->move_img($this->base_path.$old_img,$this->base_path.$v);
					if ($res===true) {
						echo "success".'<br>'.PHP_EOL;
					}else{
						echo "error:".$res.'<br>'.PHP_EOL;
					}
				}else{
					// var_dump($old_img);
					echo $v." not exist!<br>".PHP_EOL;
				}
			}
		}
	}

	public function find_img($str)
	{
		// $str = $this->test_str;
		$preg = '/\/Uploads\/(.*).(gif|jpg|jpeg|bmp|png)/isU';
		preg_match_all($preg,$str,$arr);
		return $arr[0];	
	}

	public function move_img($file_path,$new_path)
	{
		// $file_path = $this->base_path.'/Uploads1/ueditor/image/20170327/1490591947288638.png';
		// $new_path = $this->base_path.'/Uploads/ueditor/image/20170327/1490591947288638.png';
		$path = str_replace(basename($new_path), '',$new_path );
		make_dir($path);
		$res = copy($file_path,$new_path);
		if ($res==1) {
			return true;
		}

		return false;
	}
}

