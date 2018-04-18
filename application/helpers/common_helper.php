<?php
/************************************************************
** @Description: The file is ...
** @Author: haodaquan
** @Date:   2018-04-07 12:08:45
** @Last Modified by:   haodaquan
** @Last Modified time: 2018-04-18 08:41:20
*************************************************************/

/**
 * 浏览器友好的变量输出,调试函数
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}


/**
 * [make_dir 创建文件夹]
 * @Date   2016-06-30
 * @param  string     $file_path [文件地址]
 * @return [type]                [description]
 */
function make_dir($file_path)
{
    //$date_file_path = $file_path;
    if (!is_dir($file_path)) return  mkdir($file_path,0777,true);
    return true;
}

/**
 * [U url生成器]
 * @param string $param1 [参数1]
 * @param string $param2 [参数2]
 */
function U($param1='',$param2='')
{
    $url = '/';

    $url .= $param1 ? $param1.'/' : '';
    $url .= $param2 ? $param2 : '';

    return $url.'.html';
}

/**
 * [PU url参数解析]
 */
function PU()
{
    $param = rtrim($_SERVER['REQUEST_URI'],'.html');
    return explode('/',ltrim($param,'/'));
}



