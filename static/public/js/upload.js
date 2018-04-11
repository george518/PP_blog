/*
* @Author: george
* @Date:   2018-04-11 14:50:01
* @Last Modified by:   george
* @Last Modified time: 2018-04-11 14:53:36
*/



layui.use('upload', function(){
	var upload = layui.upload;
	upload.render({
		elem: '#myfile'
		,url: '/api/upload/'
		,auto: false //选择文件后不自动上传
		,bindAction: '#testListAction' //指向一个按钮触发上传
		,choose: function(obj){
			//将每次选择的文件追加到文件队列
			var files = obj.pushFile();

			//预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
			obj.preview(function(index, file, result){
			console.log(index); //得到文件索引
			console.log(file); //得到文件对象
			console.log(result); //得到文件base64编码，比如图片

			//这里还可以做一些 append 文件列表 DOM 的操作

			//obj.upload(index, file); //对上传失败的单个文件重新上传，一般在某个事件中使用
			//delete files[index]; //删除列表中对应的文件，一般在某个事件中使用
			});
		}
	});      
})