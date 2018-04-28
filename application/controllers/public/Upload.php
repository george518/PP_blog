<?php

/************************************************************
** @Description: 文件上传
** @Author: george
** @Date:   2018-04-11 15:23:44
** @Last Modified by:   george
** @Last Modified time: 2018-04-28 10:55:21
*************************************************************/
class Upload extends MY_Controller
{
    public $file_path    = UPLOAD_PATH;
    public $allow_type   = ["jpg", "png", "gif",'xlsx','jpeg','ico'];//允许上传文件格式 
    public $allow_size   = 2097152;//上传文件大小 2M2*1024*1024

    public $img_type = [
        'banner'=>0,
        'article'=>1,
        'md_img'=>2,
        'config'=>3
    ];

    public function __construct()
	{
		parent::__construct(false);
        $this->load->model('admin/image_model');
	}


    public function image()
    {
        $file   = $this->input->post('file_path');
        $width  = $this->input->post('w');
        $height = $this->input->post('h');

        if (!$file) $this->return_data(300,'上传文件配置有误');
        if (!isset($this->img_type[$file])){
            $this->return_data(300,'存储位置不允许');
        } 
        $style = $this->img_type[$file];#类型
        
        if (isset($_FILES['myfile']) && count($_FILES['myfile'])==5) {
            $name     = $_FILES['myfile']['name']; 
            $size     = $_FILES['myfile']['size']; 
            $name_tmp = $_FILES['myfile']['tmp_name']; 
           
            if (empty($name)) $this->return_data(300,'您还未选择图片');
            $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型 
            if (!in_array($type, $this->allow_type)) $this->return_data(300,'请上传正确类型的图片！');
            if ($size > $this->allow_size) $this->return_data(300,'图片大小已超过2M限制！');
            
            $imageInfo = $this->getImageInfo($name_tmp);
            if($width!=0 && $imageInfo['width']!=$width) $this->return_data(300,'图片宽度不符合要求！');
            if($height!=0 && $imageInfo['height']!=$height) $this->return_data(300,'图片高度不符合要求！');

            //如果有则直接返回
            $img_source = $this->check_image($name,$size,$imageInfo['width'],$imageInfo['height']);
            if ($img_source===false && $img_source) {
                $this->return_data(0,'上传成功',$img_source,$name);
            }

            $time = date('Y-m-d',time()); 
            $path = $this->file_path.$file.'/'.$time.'/';
            if(!is_dir($path)) make_dir($path);
            $pic_name = time() . rand(10000, 99999) . "." . $type;//图片名称 
            // $path_arr = explode('/', $file);
            // $img_path = isset($path_arr[1]) ? '/'.$path_arr[1] : '';
            $pic_url = $path . $pic_name;//上传后图片路径+名称
            //$img_url = $img_path.'/'.$time.'/'.$pic_name; #访问名称
            if (move_uploaded_file($name_tmp, $pic_url)) 
            {
                $this->save_img('/'.$pic_url,$name,$size,$style,$imageInfo['width'],$imageInfo['height']);
            	$this->return_data(0,'上传成功','/'.$pic_url,$pic_name);
            } else 
            { 
                $this->return_error(300,'上传有误，请检查服务器配置！');
            } 
        }
    }


    public function image_md()
    {
        $file = 'editormd';
        $fname = 'editormd-image-file';
        $style = $this->img_type['md_img'];

        if (isset($_FILES[$fname]) && count($_FILES[$fname])==5) {
            $name     = $_FILES[$fname]['name']; 
            $size     = $_FILES[$fname]['size']; 
            $name_tmp = $_FILES[$fname]['tmp_name']; 
           
            if (empty($name)) $this->return_md_data(300,'您还未选择图片');
            $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型 
            if (!in_array($type, $this->allow_type)) $this->return_md_data(300,'请上传正确类型的图片！');
            if ($size > $this->allow_size) $this->return_md_data(300,'图片大小已超过2M限制！');
            
            $imageInfo = $this->getImageInfo($name_tmp);

            //如果有则直接返回
            $img_source = $this->check_image($name,$size,$imageInfo['width'],$imageInfo['height']);
            if ($img_source===false && $img_source) {
                $this->return_md_data(1,'上传成功了',$img_source,$name);
            }

            $time = date('Y-m-d',time()); 
            $path = $this->file_path.$file.'/'.$time.'/';
            if(!is_dir($path)) make_dir($path);
            $pic_name = time() . rand(10000, 99999) . "." . $type;//图片名称 
            // $path_arr = explode('/', $file);
            // $img_path = isset($path_arr[1]) ? '/'.$path_arr[1] : '';
            $pic_url = $path . $pic_name;//上传后图片路径+名称
            //$img_url = $img_path.'/'.$time.'/'.$pic_name; #访问名称
            if (move_uploaded_file($name_tmp, $pic_url)) 
            {
                $this->save_img('/'.$pic_url,$name,$size,$style,$imageInfo['width'],$imageInfo['height']);
                $this->return_md_data(1,'上传成功了','/'.$pic_url,$pic_name);
            } else 
            { 
                $this->return_md_data(300,'上传有误，请检查服务器配置！');
            } 
        }
    }

    /**
     * [getImageInfo 获取图片信息]
     * @Author haodaquan
     * @Date   2016-04-14
     * @param  [type]     $img [图片临时存储地址]
     * @return [type]          [description]
     */
    private function getImageInfo($img)
    {
        $imageInfo = getimagesize($img);
        if ($imageInfo !== false) 
        {
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
            $imageSize = filesize($img);
            $info = array(
                "width" => $imageInfo[0],
                "height" => $imageInfo[1],
                "type" => $imageType,
                "size" => $imageSize,
                "mime" => $imageInfo['mime']
            );
            return $info;
        } else 
        {
            return false;
        }
    }

    /**
     * [return_data 返回数据格式]
     * @param  [type] $code     [0-成功]
     * @param  string $msg      [description]
     * @param  string $src      [description]
     * @param  string $img_name [description]
     * @return [type]           [description]
     */
    private function return_data($code,$msg='',$src='',$img_name='')
    {
    	$data = [
    		'code'=>$code,
    		'msg'=>$msg,
    		'data'=>[
    			'src'=>$src,
    			'img_name'=>$img_name
    		]
    	];
    	echo json_encode($data);
    	exit();
    }

    /**
     * [return_md_data description]
     * @param  [type] $code     [description]
     * @param  string $msg      [description]
     * @param  string $src      [description]
     * @param  string $img_name [description]
     * @return [type]           [description]
     */
    private function return_md_data($code,$msg='',$src='',$img_name='')
    {
        $data = [
            'success'=>$code,
            'message'=>$msg,
            'url'=>$src,
            // 'data'=>[
            //     'src'=>$src,
            //     'img_name'=>$img_name
            // ]
        ];
        echo json_encode($data);
        exit();
    }

        /**
     * [save_img 存储图片信息]
     * @param  [type] $pic_url [description]
     * @param  [type] $name    [description]
     * @param  [type] $size    [description]
     * @param  [type] $type    [0-banner,1-face_img,2-md_img]
     * @return [type]          [description]
     */
    private function save_img($pic_url,$name,$size,$type,$width=0,$height=0)
    {
        $data = [
            'title'=>$name,
            'img_src'=>$pic_url,
            'size'=>$size,
            'type'=>$type,
            'width'=>$width,
            'height'=>$height,
            'key_id'=>md5($name.$size.$width.$height)
        ];

        return $this->image_model->addData($data);
    }

    /**
     * [check_image 检查图片信息]
     * @param  integer $name   [description]
     * @param  integer $size   [description]
     * @param  integer $width  [description]
     * @param  integer $height [description]
     * @return [type]          [description]
     */
    private function check_image($name=0,$size=0,$width=0,$height=0)
    {
        $key_id = md5($name.$size.$width.$height);

        $img = $this->image_model->getConditionData('img_src','key_id="'.$key_id.'"');
        if (isset($img[0]['img_src'])) {
            return $img[0]['img_src'];
        }

        return false;
    }


    
}