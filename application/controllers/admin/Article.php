<?php
/************************************************************
** @Description: 文章管理
** @Author: haodaquan
** @Date:   2018-04-10 21:34:11
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-23 10:42:08
*************************************************************/
class Article extends MY_Controller
{

	protected $model_name;
	protected $category;

	public function __construct()
	{
		parent::__construct();
		$this->model_name = "article_model";

		$this->load->model('admin/category_model');
	}

	public function index()
	{
		$this->data['page_title'] = '文章列表';
		$this->display('admin/article_list.html');
	}

	public function table()
	{
		$post = $this->input->post();
        $post['status|='] = 0;
        $post['sort'] = "recommand.DESC,id.DESC";
		$this->query($post);
	}

	public function listDataFormat($data)
    {
    	$category = $this->category_model->get_category();

    	$recommand_tag = ' <span class="layui-badge layui-bg-green">荐</span> ';
    	$top_tag = ' <span class="layui-badge">头</span> ';
    	$original_tag = ' <span class="layui-badge layui-bg-blue">原</span> ';
        if(empty($data)) return [];
        foreach ($data['data'] as $key => $value) {
        	$data['data'][$key]['cate_name'] = isset($category[$value['cate_id']]) ? $category[$value['cate_id']] : '未知';
            $data['data'][$key]['title'] = '<a href="/'.$value['id'].'" target="_blank">'.$value['title'].'</a>';
        	if($value['recommand']==1){
        		$data['data'][$key]['title'] = $data['data'][$key]['title'].$recommand_tag;
        	}

        	if($value['headline']==1){
        		$data['data'][$key]['title'] = $data['data'][$key]['title'].$top_tag;
        	}

        	$data['data'][$key]['add_time'] = date('Y-m-d',$value['add_time']);
        	
        }
        return $data;
    }

    public function add()
    {
    	$this->data['cate'] = $this->category_model->get_category();
        $this->load->model('admin/topic_model');
        $this->data['topic'] = $this->topic_model->get_topic();
        $this->data['topics'] = [];
    	$this->data['page_title'] = '新增文章';
    	$this->display('admin/article_add.html');
    }

    public function edit()
    {
        // implode(, pieces)

    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$id = $this->input->get('id');
    	$article = $this->$model->getConditionData("*",'id='.(int)$id);
        $this->load->model('admin/topic_model');
        $this->data['topic'] = $this->topic_model->get_topic();
        $this->load->model('admin/article_topic_model');
        $this->data['topics'] = $this->article_topic_model->get_topic_aid($id);
    	$this->data['art'] = $article[0];
    	$this->data['cate'] = $this->category_model->get_category();
    	$this->data['page_title'] = '编辑文章';
    	$this->display('admin/article_edit.html');
    }

    public function tag_add()
    {
    	$this->load->model('admin/tag_model');
    	$this->data['tag'] = $this->tag_model->getConditionData('id,tag_name','status=0',' is_top DESC,id DESC');
    	$this->display('admin/article_tag_add.html');
    }

    public function img_add()
    {
        $this->load->model($this->module.'/'.$this->model_name);
        $model = $this->model_name;
       	$img = $this->$model->getConditionData('distinct(img_src),id','status=0',' id desc','50');
	$path = dirname(BASEPATH);
       	$this->data['img'] = [];
        $imgs = [];
       	foreach ($img as $key => $value) {

	    $filename = $path.$value['img_src'];
            $md5 = md5($value['img_src']);
		if(!file_exists($filename)) continue;
       		if (isset($imgs[$md5])) continue;
		$this->data['img'][] = $value;
                $imgs[$md5] = 1;
            	
       	}
        $this->data['page_title'] = '最近图片';
        $this->display('admin/article_img_add.html');
    }

    public function del(){
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	#判断分类下有无内容
    	$id = $this->input->post('id');
    	$data['id'] = (int)$id;
    	$data['status'] = 1;
    	$result = $this->$model->editData($data,'id='.(int)$id);

    	if (!$result) {
    		$this->ajaxReturn($result,300,'删除失败');
    	}else{
    		$this->ajaxReturn($result);
    	}
    }

    public function save()
    {
    	$this->load->model($this->module.'/'.$this->model_name);
    	$model = $this->model_name;
    	$form_data = $this->input->post();

        unset($form_data['myfile']);

        $detail = strip_tags($form_data['art-editormd-html-code']);//去除html标签
        $pattern = '/\s/';//去除空白
        $content = preg_replace($pattern, '', $detail);
        $form_data['detail'] =  mb_substr($content,0,150,'utf-8');
        $form_data['html'] =  $form_data['art-editormd-html-code'];
        // $form_data['content'] = $form_data['art-editormd-html-code'];
        unset($form_data['art-editormd-html-code']);
        unset($form_data['editormd-image-file']);
        unset($form_data['topic']);


        $topic = $form_data['topic_ids'];
        unset($form_data['topic_ids']);

        $id  = $type = 0;
        if (isset($form_data['id'])) {
             $result = $this->$model->editData($form_data,'id='.(int)$form_data['id']);
             $id     = $form_data['id'];
        }else
        {
            $result = $this->$model->addData($form_data);
            $id     = $result;
            $type   = 1;
        }
        if($result===false || $result<1)
        {
            $this->ajaxReturn($result,300,'保存失败');
        }else
        {
            $this->tag_handle($id,$form_data['tag'],$type);
            $this->load->model('admin/article_topic_model');
            if ($topic) {
                $topic_id_arr = explode(",", $topic);
                $this->article_topic_model->save_art_topic($id,$topic_id_arr,$type);
            }else{
                 $this->article_topic_model->editData(['status'=>1],' article_id='.$id);
            }
            $this->ajaxReturn($result);
        }
    }

    // public function test(){
    //     $id = 1;
    //     $tags = '你好,PHP方法,pp_blog';
    //     $type = 1;
    //    echo  $this->tag_handle($id,$tags,$type);
    // }

        /**
     * [tag_handle 标签处理]
     * @param  [type]  $tags [标签字符串，逗号隔开]
     * @param  integer $type [1-新增，0-修改]
     * @return [type]        [description]
     */
    private function tag_handle($aid,$tags,$type=1)
    {
        $tags_arr = explode(',',trim($tags,','));
        $this->load->model('admin/tag_model');
        $this->load->model('admin/article_tag_model');
        $tag_id_arr = [];
        foreach ($tags_arr as $key => $value) {
            if(!$value) continue;
            #判断是否存在
            $res = $this->tag_model->getConditionData('*','tag_name="'.$value.'"');
            if(!isset($res[0]['id']))
            {
                $tag_id = $this->tag_model->addData(['tag_name'=>$value]);
                $tag_id_arr[] = $tag_id;
            }else
            {
                $tag_id_arr[] = $res[0]['id'];
            }
        }
        return $this->article_tag_model->save_art_tag($aid,$tag_id_arr,$type);
    }

}
