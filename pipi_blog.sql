/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50712
 Source Host           : localhost
 Source Database       : pipi_blog

 Target Server Version : 50712
 File Encoding         : utf-8

 Date: 07/29/2018 12:04:07 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `pp_ad`
-- ----------------------------
DROP TABLE IF EXISTS `pp_ad`;
CREATE TABLE `pp_ad` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(128) NOT NULL DEFAULT '0' COMMENT '广告位置名称',
  `ad_detail` varchar(255) NOT NULL COMMENT '广告位备注',
  `ad_code` text NOT NULL COMMENT '广告位代码',
  `add_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `edit_time` int(11) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态0-正常1-删除',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '99' COMMENT '排序越大越往前',
  `ad_tag` varchar(32) NOT NULL DEFAULT 'index' COMMENT '广告位置',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `pp_article`
-- ----------------------------
DROP TABLE IF EXISTS `pp_article`;
CREATE TABLE `pp_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '0' COMMENT '标题',
  `from` varchar(20) DEFAULT 'admin' COMMENT '发布人',
  `cate_id` int(11) DEFAULT '0' COMMENT '栏目id',
  `img_src` varchar(100) DEFAULT NULL COMMENT '封面信息',
  `content` text COMMENT '内容',
  `html` text COMMENT 'html',
  `recommand` tinyint(1) unsigned DEFAULT '0' COMMENT '推荐0-不推荐，1-表示推荐',
  `headline` tinyint(1) unsigned DEFAULT '0' COMMENT '头条0-正常，1-头条',
  `tag` varchar(30) NOT NULL COMMENT '关键字',
  `detail` char(255) NOT NULL COMMENT '描述',
  `hits` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '点击量',
  `prise` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '赞数量',
  `is_original` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否原创 0-非原创，1-原创',
  `add_time` varchar(11) DEFAULT '0',
  `edit_time` varchar(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0' COMMENT '是否删除0-正常，1-删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pp_article`
-- ----------------------------
BEGIN;
INSERT INTO `pp_article` VALUES ('1', 'golang实现算法（1）-二分查找', 'george518', '1', '/Uploads/article/2018-04-19/152414947912273.png', '\n\n\n\n\n\n####什么是二分查找\n二分查找也称折半查找（Binary Search），它是一种效率较高的查找方法。但是，折半查找要求线性表必须采用顺序存储结构，而且表中元素按关键字有序排列。\n\n####算法时间\n\nO(log(n))\n\n### 满足条件\n- 必须采用顺序存储结构。\n- 必须按关键字大小有序排列。\n\n```go\n/************************************************************\n** @Description: binary_search 二分查找法\n** @Author: haodaquan\n** @Date:   2018-03-25 23:33\n** @Last Modified by:   haodaquan\n** @Last Modified time: 2018-03-25 23:33\n*************************************************************/\npackage main\nimport (\n   \"fmt\"\n)\nfunc main() {\n   a := []int{0, 1, 2, 3, 4, 5, 6}\n   mid := binary(a, -4)\n   fmt.Println(mid)\n}\nfunc binary(s []int, search int) int {\n   left, right, mid := 0, len(s)-1, 0\n   for {\n      if s[mid] > search {\n         right = mid - 1\n         mid = (left + right) / 2\n      } else if s[mid] == search {\n         break\n      } else {\n         left = mid + 1\n         mid = (left + right) / 2\n      }\n      if right < left {\n         mid = -1\n         break\n      }\n   }\n   return mid\n}\n```\n', '<h4 id=\"h4-u4EC0u4E48u662Fu4E8Cu5206u67E5u627E\"><a name=\"什么是二分查找\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>什么是二分查找</h4><p>二分查找也称折半查找（Binary Search），它是一种效率较高的查找方法。但是，折半查找要求线性表必须采用顺序存储结构，而且表中元素按关键字有序排列。</p>\n<h4 id=\"h4-u7B97u6CD5u65F6u95F4\"><a name=\"算法时间\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>算法时间</h4><p>O(log(n))</p>\n<h3 id=\"h3-u6EE1u8DB3u6761u4EF6\"><a name=\"满足条件\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>满足条件</h3><ul>\n<li>必须采用顺序存储结构。</li><li>必须按关键字大小有序排列。</li></ul>\n<pre><code class=\"lang-go\">/************************************************************\n** @Description: binary_search 二分查找法\n** @Author: haodaquan\n** @Date:   2018-03-25 23:33\n** @Last Modified by:   haodaquan\n** @Last Modified time: 2018-03-25 23:33\n*************************************************************/\npackage main\nimport (\n   &quot;fmt&quot;\n)\nfunc main() {\n   a := []int{0, 1, 2, 3, 4, 5, 6}\n   mid := binary(a, -4)\n   fmt.Println(mid)\n}\nfunc binary(s []int, search int) int {\n   left, right, mid := 0, len(s)-1, 0\n   for {\n      if s[mid] &gt; search {\n         right = mid - 1\n         mid = (left + right) / 2\n      } else if s[mid] == search {\n         break\n      } else {\n         left = mid + 1\n         mid = (left + right) / 2\n      }\n      if right &lt; left {\n         mid = -1\n         break\n      }\n   }\n   return mid\n}\n</code></pre>\n', '1', '0', 'Golang,算法,二分查找,Go', '什么是二分查找二分查找也称折半查找（BinarySearch），它是一种效率较高的查找方法。但是，折半查找要求线性表', '92', '0', '1', '1524149692', '1532830047', '0'), ('2', '这是一篇如何写markDown写法的', 'george518', '4', '/Uploads/article/2018-04-19/152415004035375.png', '\n\n\n\n\n\n\n### 主要特性\n\n- 支持“标准”Markdown / CommonMark和Github风格的语法，也可变身为代码编辑器；\n- 支持实时预览、图片（跨域）上传、预格式文本/代码/表格插入、代码折叠、搜索替换、只读模式、自定义样式主题和多语言语法高亮等功能；\n- 支持ToC（Table of Contents）、Emoji表情、Task lists、@链接等Markdown扩展语法；\n- 支持TeX科学公式（基于KaTeX）、流程图 Flowchart 和 时序图 Sequence Diagram;\n- 支持识别和解析HTML标签，并且支持自定义过滤标签解析，具有可靠的安全性和几乎无限的扩展性；\n- 支持 AMD / CMD 模块化加载（支持 Require.js & Sea.js），并且支持自定义扩展插件；\n- 兼容主流的浏览器（IE8+）和Zepto.js，且支持iPad等平板设备；\n- 支持自定义主题样式；\n\n# Editor.md\n\n![](https://pandao.github.io/editor.md/images/logos/editormd-logo-180x180.png)\n\n![](https://img.shields.io/github/stars/pandao/editor.md.svg) ![](https://img.shields.io/github/forks/pandao/editor.md.svg) ![](https://img.shields.io/github/tag/pandao/editor.md.svg) ![](https://img.shields.io/github/release/pandao/editor.md.svg) ![](https://img.shields.io/github/issues/pandao/editor.md.svg) ![](https://img.shields.io/bower/v/editor.md.svg)\n\n**目录 (Table of Contents)**\n\n[TOCM]\n\n[TOC]\n\n# Heading 1\n## Heading 2\n### Heading 3\n#### Heading 4\n##### Heading 5\n###### Heading 6\n# Heading 1 link [Heading link](https://github.com/pandao/editor.md \"Heading link\")\n## Heading 2 link [Heading link](https://github.com/pandao/editor.md \"Heading link\")\n### Heading 3 link [Heading link](https://github.com/pandao/editor.md \"Heading link\")\n#### Heading 4 link [Heading link](https://github.com/pandao/editor.md \"Heading link\") Heading link [Heading link](https://github.com/pandao/editor.md \"Heading link\")\n##### Heading 5 link [Heading link](https://github.com/pandao/editor.md \"Heading link\")\n###### Heading 6 link [Heading link](https://github.com/pandao/editor.md \"Heading link\")\n\n#### 标题（用底线的形式）Heading (underline)\n\nThis is an H1\n=============\n\nThis is an H2\n-------------\n\n### 字符效果和横线等\n                \n----\n\n~~删除线~~ <s>删除线（开启识别HTML标签时）</s>\n*斜体字*      _斜体字_\n**粗体**  __粗体__\n***粗斜体*** ___粗斜体___\n\n上标：X<sub>2</sub>，下标：O<sup>2</sup>\n\n**缩写(同HTML的abbr标签)**\n\n> 即更长的单词或短语的缩写形式，前提是开启识别HTML标签时，已默认开启\n\nThe <abbr title=\"Hyper Text Markup Language\">HTML</abbr> specification is maintained by the <abbr title=\"World Wide Web Consortium\">W3C</abbr>.\n\n### 引用 Blockquotes\n\n> 引用文本 Blockquotes\n\n引用的行内混合 Blockquotes\n                    \n> 引用：如果想要插入空白换行`即<br />标签`，在插入处先键入两个以上的空格然后回车即可，[普通链接](http://localhost/)。\n\n### 锚点与链接 Links\n\n[普通链接](http://localhost/)\n\n[普通链接带标题](http://localhost/ \"普通链接带标题\")\n\n直接链接：<https://github.com>\n\n[锚点链接][anchor-id] \n\n[anchor-id]: http://www.this-anchor-link.com/\n\nGFM a-tail link @pandao\n\n> @pandao\n\n### 多语言代码高亮 Codes\n\n#### 行内代码 Inline code\n\n执行命令：`npm install marked`\n\n#### 缩进风格\n\n即缩进四个空格，也做为实现类似`<pre>`预格式化文本(Preformatted Text)的功能。\n\n    <?php\n        echo \"Hello world!\";\n    ?>\n    \n预格式化文本：\n\n    | First Header  | Second Header |\n    | ------------- | ------------- |\n    | Content Cell  | Content Cell  |\n    | Content Cell  | Content Cell  |\n\n#### JS代码　\n\n```javascript\nfunction test(){\n	console.log(\"Hello world!\");\n}\n \n(function(){\n    var box = function(){\n        return box.fn.init();\n    };\n\n    box.prototype = box.fn = {\n        init : function(){\n            console.log(\'box.init()\');\n\n			return this;\n        },\n\n		add : function(str){\n			alert(\"add\", str);\n\n			return this;\n		},\n\n		remove : function(str){\n			alert(\"remove\", str);\n\n			return this;\n		}\n    };\n    \n    box.fn.init.prototype = box.fn;\n    \n    window.box =box;\n})();\n\nvar testBox = box();\ntestBox.add(\"jQuery\").remove(\"jQuery\");\n```\n\n#### HTML代码 HTML codes\n\n```html\n<!DOCTYPE html>\n<html>\n    <head>\n        <mate charest=\"utf-8\" />\n        <title>Hello world!</title>\n    </head>\n    <body>\n        <h1>Hello world!</h1>\n    </body>\n</html>\n```\n\n### 图片 Images\n\nImage:\n\n![](https://pandao.github.io/editor.md/examples/images/4.jpg)\n\n> Follow your heart.\n\n![](https://pandao.github.io/editor.md/examples/images/8.jpg)\n\n> 图为：厦门白城沙滩\n\n图片加链接 (Image + Link)：\n\n[![](https://pandao.github.io/editor.md/examples/images/7.jpg)](https://pandao.github.io/editor.md/examples/images/7.jpg \"李健首张专辑《似水流年》封面\")\n\n> 图为：李健首张专辑《似水流年》封面\n                \n----\n\n### 列表 Lists\n\n#### 无序列表（减号）Unordered Lists (-)\n                \n- 列表一\n- 列表二\n- 列表三\n     \n#### 无序列表（星号）Unordered Lists (*)\n\n* 列表一\n* 列表二\n* 列表三\n\n#### 无序列表（加号和嵌套）Unordered Lists (+)\n                \n+ 列表一\n+ 列表二\n    + 列表二-1\n    + 列表二-2\n    + 列表二-3\n+ 列表三\n    * 列表一\n    * 列表二\n    * 列表三\n\n#### 有序列表 Ordered Lists (-)\n                \n1. 第一行\n2. 第二行\n3. 第三行\n\n#### GFM task list\n\n- [x] GFM task list 1\n- [x] GFM task list 2\n- [ ] GFM task list 3\n    - [ ] GFM task list 3-1\n    - [ ] GFM task list 3-2\n    - [ ] GFM task list 3-3\n- [ ] GFM task list 4\n    - [ ] GFM task list 4-1\n    - [ ] GFM task list 4-2\n                \n----\n                    \n### 绘制表格 Tables\n\n| 项目        | 价格   |  数量  |\n| --------   | -----:  | :----:  |\n| 计算机      | $1600   |   5     |\n| 手机        |   $12   |   12   |\n| 管线        |    $1    |  234  |\n                    \nFirst Header  | Second Header\n------------- | -------------\nContent Cell  | Content Cell\nContent Cell  | Content Cell \n\n| First Header  | Second Header |\n| ------------- | ------------- |\n| Content Cell  | Content Cell  |\n| Content Cell  | Content Cell  |\n\n| Function name | Description                    |\n| ------------- | ------------------------------ |\n| `help()`      | Display the help window.       |\n| `destroy()`   | **Destroy your computer!**     |\n\n| Left-Aligned  | Center Aligned  | Right Aligned |\n| :------------ |:---------------:| -----:|\n| col 3 is      | some wordy text | $1600 |\n| col 2 is      | centered        |   $12 |\n| zebra stripes | are neat        |    $1 |\n\n| Item      | Value |\n| --------- | -----:|\n| Computer  | $1600 |\n| Phone     |   $12 |\n| Pipe      |    $1 |\n                \n----\n\n#### 特殊符号 HTML Entities Codes\n\n© &  ¨ ™ ¡ £\n& < > ¥ € ® ± ¶ § ¦ ¯ « · \n\nX² Y³ ¾ ¼  ×  ÷   »\n\n18ºC  \"  \'\n\n### Emoji表情 :smiley:\n\n> Blockquotes :star:\n\n#### GFM task lists & Emoji & fontAwesome icon emoji & editormd logo emoji :editormd-logo-5x:\n\n- [x] :smiley: @mentions, :smiley: #refs, [links](), **formatting**, and <del>tags</del> supported :editormd-logo:;\n- [x] list syntax required (any unordered or ordered list supported) :editormd-logo-3x:;\n- [x] [ ] :smiley: this is a complete item :smiley:;\n- [ ] []this is an incomplete item [test link](#) :fa-star: @pandao; \n- [ ] [ ]this is an incomplete item :fa-star: :fa-gear:;\n    - [ ] :smiley: this is an incomplete item [test link](#) :fa-star: :fa-gear:;\n    - [ ] :smiley: this is  :fa-star: :fa-gear: an incomplete item [test link](#);\n \n#### 反斜杠 Escape\n\n\\*literal asterisks\\*\n            \n### 科学公式 TeX(KaTeX)\n                    \n$$E=mc^2$$\n\n行内的公式$$E=mc^2$$行内的公式，行内的$$E=mc^2$$公式。\n\n$$\\(\\sqrt{3x-1}+(1+x)^2\\)$$\n                    \n$$\\sin(\\alpha)^{\\theta}=\\sum_{i=0}^{n}(x^i + \\cos(f))$$\n\n多行公式：\n\n```math\n\\displaystyle\n\\left( \\sum\\_{k=1}^n a\\_k b\\_k \\right)^2\n\\leq\n\\left( \\sum\\_{k=1}^n a\\_k^2 \\right)\n\\left( \\sum\\_{k=1}^n b\\_k^2 \\right)\n```\n\n```katex\n\\displaystyle \n    \\frac{1}{\n        \\Bigl(\\sqrt{\\phi \\sqrt{5}}-\\phi\\Bigr) e^{\n        \\frac25 \\pi}} = 1+\\frac{e^{-2\\pi}} {1+\\frac{e^{-4\\pi}} {\n        1+\\frac{e^{-6\\pi}}\n        {1+\\frac{e^{-8\\pi}}\n         {1+\\cdots} }\n        } \n    }\n```\n\n```latex\nf(x) = \\int_{-\\infty}^\\infty\n    \\hat f(\\xi)\\,e^{2 \\pi i \\xi x}\n    \\,d\\xi\n```\n                \n### 绘制流程图 Flowchart\n\n```flow\nst=>start: 用户登陆\nop=>operation: 登陆操作\ncond=>condition: 登陆成功 Yes or No?\ne=>end: 进入后台\n\nst->op->cond\ncond(yes)->e\ncond(no)->op\n```\n                    \n### 绘制序列图 Sequence Diagram\n                    \n```seq\nAndrew->China: Says Hello \nNote right of China: China thinks\\nabout it \nChina-->Andrew: How are you? \nAndrew->>China: I am good thanks!\n```\n\n### End', '<h3 id=\"h3-u4E3Bu8981u7279u6027\"><a name=\"主要特性\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>主要特性</h3><ul>\n<li>支持“标准”Markdown / CommonMark和Github风格的语法，也可变身为代码编辑器；</li><li>支持实时预览、图片（跨域）上传、预格式文本/代码/表格插入、代码折叠、搜索替换、只读模式、自定义样式主题和多语言语法高亮等功能；</li><li>支持ToC（Table of Contents）、Emoji表情、Task lists、@链接等Markdown扩展语法；</li><li>支持TeX科学公式（基于KaTeX）、流程图 Flowchart 和 时序图 Sequence Diagram;</li><li>支持识别和解析HTML标签，并且支持自定义过滤标签解析，具有可靠的安全性和几乎无限的扩展性；</li><li>支持 AMD / CMD 模块化加载（支持 Require.js &amp; Sea.js），并且支持自定义扩展插件；</li><li>兼容主流的浏览器（IE8+）和Zepto.js，且支持iPad等平板设备；</li><li>支持自定义主题样式；</li></ul>\n<h1 id=\"h1-editor-md\"><a name=\"Editor.md\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Editor.md</h1><p><img src=\"https://pandao.github.io/editor.md/images/logos/editormd-logo-180x180.png\" alt=\"\"></p>\n<p><img src=\"https://img.shields.io/github/stars/pandao/editor.md.svg\" alt=\"\"> <img src=\"https://img.shields.io/github/forks/pandao/editor.md.svg\" alt=\"\"> <img src=\"https://img.shields.io/github/tag/pandao/editor.md.svg\" alt=\"\"> <img src=\"https://img.shields.io/github/release/pandao/editor.md.svg\" alt=\"\"> <img src=\"https://img.shields.io/github/issues/pandao/editor.md.svg\" alt=\"\"> <img src=\"https://img.shields.io/bower/v/editor.md.svg\" alt=\"\"></p>\n<p><strong>目录 (Table of Contents)</strong></p>\n<p>[TOCM]</p>\n<div class=\"markdown-toc editormd-markdown-toc\">[TOC]</div><h1 id=\"h1-heading-1\"><a name=\"Heading 1\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 1</h1><h2 id=\"h2-heading-2\"><a name=\"Heading 2\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 2</h2><h3 id=\"h3-heading-3\"><a name=\"Heading 3\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 3</h3><h4 id=\"h4-heading-4\"><a name=\"Heading 4\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 4</h4><h5 id=\"h5-heading-5\"><a name=\"Heading 5\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 5</h5><h6 id=\"h6-heading-6\"><a name=\"Heading 6\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 6</h6><h1 id=\"h1-heading-1-link-heading-link\"><a name=\"Heading 1 link   Heading link\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 1 link <a href=\"https://github.com/pandao/editor.md\" title=\"Heading link\">Heading link</a></h1><h2 id=\"h2-heading-2-link-heading-link\"><a name=\"Heading 2 link   Heading link\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 2 link <a href=\"https://github.com/pandao/editor.md\" title=\"Heading link\">Heading link</a></h2><h3 id=\"h3-heading-3-link-heading-link\"><a name=\"Heading 3 link   Heading link\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 3 link <a href=\"https://github.com/pandao/editor.md\" title=\"Heading link\">Heading link</a></h3><h4 id=\"h4-heading-4-link-heading-link-heading-link-heading-link\"><a name=\"Heading 4 link   Heading link  Heading link   Heading link\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 4 link <a href=\"https://github.com/pandao/editor.md\" title=\"Heading link\">Heading link</a> Heading link <a href=\"https://github.com/pandao/editor.md\" title=\"Heading link\">Heading link</a></h4><h5 id=\"h5-heading-5-link-heading-link\"><a name=\"Heading 5 link   Heading link\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 5 link <a href=\"https://github.com/pandao/editor.md\" title=\"Heading link\">Heading link</a></h5><h6 id=\"h6-heading-6-link-heading-link\"><a name=\"Heading 6 link   Heading link\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Heading 6 link <a href=\"https://github.com/pandao/editor.md\" title=\"Heading link\">Heading link</a></h6><h4 id=\"h4--heading-underline-\"><a name=\"标题（用底线的形式）Heading (underline)\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>标题（用底线的形式）Heading (underline)</h4><h1 id=\"h1-this-is-an-h1\"><a name=\"This is an H1\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>This is an H1</h1><h2 id=\"h2-this-is-an-h2\"><a name=\"This is an H2\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>This is an H2</h2><h3 id=\"h3-u5B57u7B26u6548u679Cu548Cu6A2Au7EBFu7B49\"><a name=\"字符效果和横线等\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>字符效果和横线等</h3><hr>\n<p><del>删除线</del> &lt;s&gt;删除线（开启识别HTML标签时）&lt;/s&gt;<br><em>斜体字</em>      <em>斜体字</em><br><strong>粗体</strong>  <strong>粗体</strong><br><strong><em>粗斜体</em></strong> <strong><em>粗斜体</em></strong></p>\n<p>上标：X&lt;sub&gt;2&lt;/sub&gt;，下标：O&lt;sup&gt;2&lt;/sup&gt;</p>\n<p><strong>缩写(同HTML的abbr标签)</strong></p>\n<blockquote>\n<p>即更长的单词或短语的缩写形式，前提是开启识别HTML标签时，已默认开启</p>\n</blockquote>\n<p>The &lt;abbr title=&quot;Hyper Text Markup Language&quot;&gt;HTML&lt;/abbr&gt; specification is maintained by the &lt;abbr title=&quot;World Wide Web Consortium&quot;&gt;W3C&lt;/abbr&gt;.</p>\n<h3 id=\"h3--blockquotes\"><a name=\"引用 Blockquotes\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>引用 Blockquotes</h3><blockquote>\n<p>引用文本 Blockquotes</p>\n</blockquote>\n<p>引用的行内混合 Blockquotes</p>\n<blockquote>\n<p>引用：如果想要插入空白换行<code>即&lt;br /&gt;标签</code>，在插入处先键入两个以上的空格然后回车即可，<a href=\"http://localhost/\">普通链接</a>。</p>\n</blockquote>\n<h3 id=\"h3--links\"><a name=\"锚点与链接 Links\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>锚点与链接 Links</h3><p><a href=\"http://localhost/\">普通链接</a></p>\n<p><a href=\"http://localhost/\" title=\"普通链接带标题\">普通链接带标题</a></p>\n<p>直接链接：<a href=\"https://github.com\">https://github.com</a></p>\n<p><a href=\"http://www.this-anchor-link.com/\">锚点链接</a> </p>\n<p>GFM a-tail link <a href=\"https://github.com/pandao\" title=\"&#64;pandao\" class=\"at-link\">@pandao</a></p>\n<blockquote>\n<p><a href=\"https://github.com/pandao\" title=\"&#64;pandao\" class=\"at-link\">@pandao</a></p>\n</blockquote>\n<h3 id=\"h3--codes\"><a name=\"多语言代码高亮 Codes\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>多语言代码高亮 Codes</h3><h4 id=\"h4--inline-code\"><a name=\"行内代码 Inline code\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>行内代码 Inline code</h4><p>执行命令：<code>npm install marked</code></p>\n<h4 id=\"h4-u7F29u8FDBu98CEu683C\"><a name=\"缩进风格\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>缩进风格</h4><p>即缩进四个空格，也做为实现类似<code>&lt;pre&gt;</code>预格式化文本(Preformatted Text)的功能。</p>\n<pre><code>&lt;?php\n    echo &quot;Hello world!&quot;;\n?&gt;\n</code></pre><p>预格式化文本：</p>\n<pre><code>| First Header  | Second Header |\n| ------------- | ------------- |\n| Content Cell  | Content Cell  |\n| Content Cell  | Content Cell  |\n</code></pre><h4 id=\"h4-js-\"><a name=\"JS代码\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>JS代码　</h4><pre><code class=\"lang-javascript\">function test(){\n    console.log(&quot;Hello world!&quot;);\n}\n\n(function(){\n    var box = function(){\n        return box.fn.init();\n    };\n\n    box.prototype = box.fn = {\n        init : function(){\n            console.log(&#39;box.init()&#39;);\n\n            return this;\n        },\n\n        add : function(str){\n            alert(&quot;add&quot;, str);\n\n            return this;\n        },\n\n        remove : function(str){\n            alert(&quot;remove&quot;, str);\n\n            return this;\n        }\n    };\n\n    box.fn.init.prototype = box.fn;\n\n    window.box =box;\n})();\n\nvar testBox = box();\ntestBox.add(&quot;jQuery&quot;).remove(&quot;jQuery&quot;);\n</code></pre>\n<h4 id=\"h4-html-html-codes\"><a name=\"HTML代码 HTML codes\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>HTML代码 HTML codes</h4><pre><code class=\"lang-html\">&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n    &lt;head&gt;\n        &lt;mate charest=&quot;utf-8&quot; /&gt;\n        &lt;title&gt;Hello world!&lt;/title&gt;\n    &lt;/head&gt;\n    &lt;body&gt;\n        &lt;h1&gt;Hello world!&lt;/h1&gt;\n    &lt;/body&gt;\n&lt;/html&gt;\n</code></pre>\n<h3 id=\"h3--images\"><a name=\"图片 Images\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>图片 Images</h3><p>Image:</p>\n<p><img src=\"https://pandao.github.io/editor.md/examples/images/4.jpg\" alt=\"\"></p>\n<blockquote>\n<p>Follow your heart.</p>\n</blockquote>\n<p><img src=\"https://pandao.github.io/editor.md/examples/images/8.jpg\" alt=\"\"></p>\n<blockquote>\n<p>图为：厦门白城沙滩</p>\n</blockquote>\n<p>图片加链接 (Image + Link)：</p>\n<p><a href=\"https://pandao.github.io/editor.md/examples/images/7.jpg\" title=\"李健首张专辑《似水流年》封面\"><img src=\"https://pandao.github.io/editor.md/examples/images/7.jpg\" alt=\"\"></a></p>\n<blockquote>\n<p>图为：李健首张专辑《似水流年》封面</p>\n</blockquote>\n<hr>\n<h3 id=\"h3--lists\"><a name=\"列表 Lists\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>列表 Lists</h3><h4 id=\"h4--unordered-lists-\"><a name=\"无序列表（减号）Unordered Lists (-)\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>无序列表（减号）Unordered Lists (-)</h4><ul>\n<li>列表一</li><li>列表二</li><li>列表三</li></ul>\n<h4 id=\"h4--unordered-lists-\"><a name=\"无序列表（星号）Unordered Lists (*)\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>无序列表（星号）Unordered Lists (*)</h4><ul>\n<li>列表一</li><li>列表二</li><li>列表三</li></ul>\n<h4 id=\"h4--unordered-lists-\"><a name=\"无序列表（加号和嵌套）Unordered Lists (+)\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>无序列表（加号和嵌套）Unordered Lists (+)</h4><ul>\n<li>列表一</li><li>列表二<ul>\n<li>列表二-1</li><li>列表二-2</li><li>列表二-3</li></ul>\n</li><li>列表三<ul>\n<li>列表一</li><li>列表二</li><li>列表三</li></ul>\n</li></ul>\n<h4 id=\"h4--ordered-lists-\"><a name=\"有序列表 Ordered Lists (-)\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>有序列表 Ordered Lists (-)</h4><ol>\n<li>第一行</li><li>第二行</li><li>第三行</li></ol>\n<h4 id=\"h4-gfm-task-list\"><a name=\"GFM task list\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>GFM task list</h4><ul>\n<li>[x] GFM task list 1</li><li>[x] GFM task list 2</li><li>[ ] GFM task list 3<ul>\n<li>[ ] GFM task list 3-1</li><li>[ ] GFM task list 3-2</li><li>[ ] GFM task list 3-3</li></ul>\n</li><li>[ ] GFM task list 4<ul>\n<li>[ ] GFM task list 4-1</li><li>[ ] GFM task list 4-2</li></ul>\n</li></ul>\n<hr>\n<h3 id=\"h3--tables\"><a name=\"绘制表格 Tables\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>绘制表格 Tables</h3><table>\n<thead>\n<tr>\n<th>项目</th>\n<th style=\"text-align:right\">价格</th>\n<th style=\"text-align:center\">数量</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td>计算机</td>\n<td style=\"text-align:right\">$1600</td>\n<td style=\"text-align:center\">5</td>\n</tr>\n<tr>\n<td>手机</td>\n<td style=\"text-align:right\">$12</td>\n<td style=\"text-align:center\">12</td>\n</tr>\n<tr>\n<td>管线</td>\n<td style=\"text-align:right\">$1</td>\n<td style=\"text-align:center\">234</td>\n</tr>\n</tbody>\n</table>\n<table>\n<thead>\n<tr>\n<th>First Header</th>\n<th>Second Header</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td>Content Cell</td>\n<td>Content Cell</td>\n</tr>\n<tr>\n<td>Content Cell</td>\n<td>Content Cell </td>\n</tr>\n</tbody>\n</table>\n<table>\n<thead>\n<tr>\n<th>First Header</th>\n<th>Second Header</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td>Content Cell</td>\n<td>Content Cell</td>\n</tr>\n<tr>\n<td>Content Cell</td>\n<td>Content Cell</td>\n</tr>\n</tbody>\n</table>\n<table>\n<thead>\n<tr>\n<th>Function name</th>\n<th>Description</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td><code>help()</code></td>\n<td>Display the help window.</td>\n</tr>\n<tr>\n<td><code>destroy()</code></td>\n<td><strong>Destroy your computer!</strong></td>\n</tr>\n</tbody>\n</table>\n<table>\n<thead>\n<tr>\n<th style=\"text-align:left\">Left-Aligned</th>\n<th style=\"text-align:center\">Center Aligned</th>\n<th style=\"text-align:right\">Right Aligned</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td style=\"text-align:left\">col 3 is</td>\n<td style=\"text-align:center\">some wordy text</td>\n<td style=\"text-align:right\">$1600</td>\n</tr>\n<tr>\n<td style=\"text-align:left\">col 2 is</td>\n<td style=\"text-align:center\">centered</td>\n<td style=\"text-align:right\">$12</td>\n</tr>\n<tr>\n<td style=\"text-align:left\">zebra stripes</td>\n<td style=\"text-align:center\">are neat</td>\n<td style=\"text-align:right\">$1</td>\n</tr>\n</tbody>\n</table>\n<table>\n<thead>\n<tr>\n<th>Item</th>\n<th style=\"text-align:right\">Value</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td>Computer</td>\n<td style=\"text-align:right\">$1600</td>\n</tr>\n<tr>\n<td>Phone</td>\n<td style=\"text-align:right\">$12</td>\n</tr>\n<tr>\n<td>Pipe</td>\n<td style=\"text-align:right\">$1</td>\n</tr>\n</tbody>\n</table>\n<hr>\n<h4 id=\"h4--html-entities-codes\"><a name=\"特殊符号 HTML Entities Codes\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>特殊符号 HTML Entities Codes</h4><p>© &amp;  ¨ ™ ¡ £<br>&amp; &lt; &gt; ¥ € ® ± ¶ § ¦ ¯ « · </p>\n<p>X² Y³ ¾ ¼  ×  ÷   »</p>\n<p>18ºC  “  ‘</p>\n<h3 id=\"h3-emoji-smiley-\"><a name=\"Emoji表情 :smiley:\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Emoji表情 :smiley:</h3><blockquote>\n<p>Blockquotes :star:</p>\n</blockquote>\n<h4 id=\"h4-gfm-task-lists-amp-emoji-amp-fontawesome-icon-emoji-amp-editormd-logo-emoji-editormd-logo-5x-\"><a name=\"GFM task lists &amp; Emoji &amp; fontAwesome icon emoji &amp; editormd logo emoji :editormd-logo-5x:\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>GFM task lists &amp; Emoji &amp; fontAwesome icon emoji &amp; editormd logo emoji :editormd-logo-5x:</h4><ul>\n<li>[x] :smiley: <a href=\"https://github.com/mentions\" title=\"&#64;mentions\" class=\"at-link\">@mentions</a>, :smiley: #refs, <a href=\"\">links</a>, <strong>formatting</strong>, and &lt;del&gt;tags&lt;/del&gt; supported :editormd-logo:;</li><li>[x] list syntax required (any unordered or ordered list supported) :editormd-logo-3x:;</li><li>[x] [ ] :smiley: this is a complete item :smiley:;</li><li>[ ] []this is an incomplete item <a href=\"#\">test link</a> :fa-star: <a href=\"https://github.com/pandao\" title=\"&#64;pandao\" class=\"at-link\">@pandao</a>; </li><li>[ ] [ ]this is an incomplete item :fa-star: :fa-gear:;<ul>\n<li>[ ] :smiley: this is an incomplete item <a href=\"#\">test link</a> :fa-star: :fa-gear:;</li><li>[ ] :smiley: this is  :fa-star: :fa-gear: an incomplete item <a href=\"#\">test link</a>;</li></ul>\n</li></ul>\n<h4 id=\"h4--escape\"><a name=\"反斜杠 Escape\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>反斜杠 Escape</h4><p>*literal asterisks*</p>\n<h3 id=\"h3--tex-katex-\"><a name=\"科学公式 TeX(KaTeX)\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>科学公式 TeX(KaTeX)</h3><p class=\"editormd-tex\">E=mc^2</p>\n<p>行内的公式<span class=\"editormd-tex\">E=mc^2</span>行内的公式，行内的<span class=\"editormd-tex\">E=mc^2</span>公式。</p>\n<p class=\"editormd-tex\">(\\sqrt{3x-1}+(1+x)^2)</p>\n<p class=\"editormd-tex\">\\sin(\\alpha)^{\\theta}=\\sum_{i=0}^{n}(x^i + \\cos(f))</p>\n<p>多行公式：</p>\n<p class=\"editormd-tex\">\\displaystyle\n\\left( \\sum\\_{k=1}^n a\\_k b\\_k \\right)^2\n\\leq\n\\left( \\sum\\_{k=1}^n a\\_k^2 \\right)\n\\left( \\sum\\_{k=1}^n b\\_k^2 \\right)</p><p class=\"editormd-tex\">\\displaystyle \n    \\frac{1}{\n        \\Bigl(\\sqrt{\\phi \\sqrt{5}}-\\phi\\Bigr) e^{\n        \\frac25 \\pi}} = 1+\\frac{e^{-2\\pi}} {1+\\frac{e^{-4\\pi}} {\n        1+\\frac{e^{-6\\pi}}\n        {1+\\frac{e^{-8\\pi}}\n         {1+\\cdots} }\n        } \n    }</p><p class=\"editormd-tex\">f(x) = \\int_{-\\infty}^\\infty\n    \\hat f(\\xi)\\,e^{2 \\pi i \\xi x}\n    \\,d\\xi</p><h3 id=\"h3--flowchart\"><a name=\"绘制流程图 Flowchart\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>绘制流程图 Flowchart</h3><div class=\"flowchart\">st=>start: 用户登陆\nop=>operation: 登陆操作\ncond=>condition: 登陆成功 Yes or No?\ne=>end: 进入后台\n\nst->op->cond\ncond(yes)->e\ncond(no)->op</div><h3 id=\"h3--sequence-diagram\"><a name=\"绘制序列图 Sequence Diagram\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>绘制序列图 Sequence Diagram</h3><div class=\"sequence-diagram\">Andrew->China: Says Hello \nNote right of China: China thinks\\nabout it \nChina-->Andrew: How are you? \nAndrew->>China: I am good thanks!</div><h3 id=\"h3-end\"><a name=\"End\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>End</h3>', '1', '1', 'markdown,Go,Golang', '主要特性支持“', '6', '0', '0', '1524150051', '1532829720', '0'), ('3', '测试tag', 'george518', '1', '', '\n\n\n\n\n###写下你的故事...\nsdfdsf', '<h3 id=\"h3--\"><a name=\"写下你的故事…\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>写下你的故事…</h3><p>sdfdsf</p>\n', '0', '0', 'Layui,二分查找', '写下', '7', '0', '0', '1525477954', '1532829688', '0'), ('4', 'sdfdsf', 'george518', '2', '/Uploads/article/2018-04-19/152414947912273.png', '\n\n\n\n###写下你的故事...\nsdfsdfdsfds\n\nsdfdsfdsf##\n###sfsdfs ', null, '1', '0', 'Golang,二分查找,Javascript', '写下', '1', '0', '0', '1532790705', '1532822111', '0'), ('5', '是打发第三方', 'admin', '1', '/Uploads/article/2018-04-19/152415004035375.png', '\n\n\n###线程必须的双丰收', null, '0', '0', 'PHP方法,Javascript', '线程', '1', '0', '1', '1532790773', '1532822010', '0'), ('6', '是的范德萨', 'george518', '3', '/Uploads/article/2018-04-19/152415004035375.png', '\n\n\n###写下你的故事...\n是的范德萨', null, '1', '0', '算法,markdown', '写下', '1', '0', '0', '1532791026', '1532821988', '0');
COMMIT;

-- ----------------------------
--  Table structure for `pp_article_tag`
-- ----------------------------
DROP TABLE IF EXISTS `pp_article_tag`;
CREATE TABLE `pp_article_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `article_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章ID',
  `tag_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '标签ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pp_article_tag`
-- ----------------------------
BEGIN;
INSERT INTO `pp_article_tag` VALUES ('51', '6', '5'), ('52', '6', '10'), ('53', '5', '12'), ('54', '5', '3'), ('55', '4', '2'), ('56', '4', '9'), ('57', '4', '3'), ('77', '3', '4'), ('78', '3', '9'), ('79', '2', '10'), ('80', '2', '14'), ('81', '2', '2'), ('102', '1', '2'), ('103', '1', '5'), ('104', '1', '9'), ('105', '1', '14');
COMMIT;

-- ----------------------------
--  Table structure for `pp_article_topic`
-- ----------------------------
DROP TABLE IF EXISTS `pp_article_topic`;
CREATE TABLE `pp_article_topic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `article_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章ID',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '标签ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '顺序',
  `status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0-正常，1-删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pp_article_topic`
-- ----------------------------
BEGIN;
INSERT INTO `pp_article_topic` VALUES ('1', '6', '1', '1', '0'), ('2', '6', '2', '1', '0'), ('3', '4', '1', '1', '0'), ('4', '3', '2', '2', '0'), ('5', '3', '1', '1', '0'), ('6', '5', '2', '3', '0'), ('7', '4', '2', '4', '0'), ('8', '2', '2', '5', '0'), ('9', '2', '1', '1', '0'), ('10', '1', '2', '6', '0'), ('11', '1', '1', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `pp_banner`
-- ----------------------------
DROP TABLE IF EXISTS `pp_banner`;
CREATE TABLE `pp_banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '0' COMMENT '标题',
  `detail` varchar(500) DEFAULT '0' COMMENT '备注',
  `img_src` varchar(500) DEFAULT NULL COMMENT '封面信息',
  `url` varchar(500) DEFAULT NULL COMMENT '内容',
  `sort` tinyint(1) DEFAULT '0' COMMENT '排序 越小越往前',
  `add_time` varchar(11) DEFAULT '0',
  `edit_time` varchar(11) DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '是否删除0-正常，1-删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pp_banner`
-- ----------------------------
BEGIN;
INSERT INTO `pp_banner` VALUES ('1', '技术无止境，一直在路上', '在路上', '/Uploads/banner/2018-04-19/152414913163427.png', 'http://www.haodaquan.com', '2', '1524149141', '1524149196', '0'), ('2', '简约不简单', '简约而不简单', '/Uploads/banner/2018-04-19/152414917615215.png', 'http://www.haodaquan.com', '1', '1524149185', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `pp_category`
-- ----------------------------
DROP TABLE IF EXISTS `pp_category`;
CREATE TABLE `pp_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(30) NOT NULL COMMENT '分类名称',
  `pid` int(11) NOT NULL COMMENT '分类父id',
  `is_nav` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1为导航，0为不在导航显示',
  `sort` int(11) NOT NULL DEFAULT '99' COMMENT '排序',
  `keywords` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `add_time` varchar(11) DEFAULT '0',
  `edit_time` varchar(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0' COMMENT '是否删除0-正常，1-删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='栏目分类表';

-- ----------------------------
--  Records of `pp_category`
-- ----------------------------
BEGIN;
INSERT INTO `pp_category` VALUES ('1', '编程语言', '0', '1', '1', 'PHP、Go等WEB编程语言技术分享', '这里介绍的是编程语言的分享', '1524148865', '0', '0'), ('2', '数据库', '0', '1', '2', 'Mysql,Redis等主流数据库使用分享', 'Mysql,Redis等主流数据库使用分享', '1524148908', '0', '0'), ('3', '算法&架构', '0', '1', '3', '常见算法和架构学习', '常见算法和架构学习', '1524148950', '0', '0'), ('4', '学习点滴', '0', '1', '4', '学习点滴', '学习点滴', '1524148993', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `pp_config`
-- ----------------------------
DROP TABLE IF EXISTS `pp_config`;
CREATE TABLE `pp_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '0' COMMENT '键值',
  `value` varchar(1000) NOT NULL DEFAULT '0' COMMENT '内容',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-正常1-删除',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edit_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pp_config`
-- ----------------------------
BEGIN;
INSERT INTO `pp_config` VALUES ('1', 'web_name', '在路上_技术分享博客', '0', '0', '1524148713'), ('2', 'keywords', 'c,go,php,python,mysql,redis,linux', '0', '0', '1524148713'), ('3', 'description', '分享技术之路上所得所思,php,golang,python,mysql,redis,linux等技术使用心得,坚信技术一直在路上,在路上,勤思考,重实践,懂分享.', '0', '0', '1524148713'), ('4', 'slogan', '技术无止境，一直在路上。 年过而立，惴惴不安，愈加发奋，孜孜求学。', '0', '0', '1524148713'), ('6', 'foot', 'Copyright © 2017.<a href=\'http://www.haodaquan.com\'>在路上</a> All rights reserved.', '0', '0', '1524148713'), ('7', 'host', 'http://ppblog.com', '0', '0', '1492180786'), ('8', 'logo', '0', '0', '0', '1492180786'), ('9', 'github', 'https://github.com/george518', '0', '0', '1524148713'), ('10', 'copyright', '欢迎转载，但任何转载必须保留完整文章，在显要地方显示署名以及原文链接。如您有任何疑问，请给我留言。', '0', '0', '1524148713'), ('11', 'short_web_name', '在路上', '0', '0', '1524148713'), ('12', 'mail', 'haodaquan2008@163.com', '0', '0', '1524148713'), ('13', 'qq', '//shang.qq.com/wpa/qunwpa?idkey=d397ca330efe29380d3eeaed846e88cd5eddd7a62f469200125b1d13c906485d', '0', '0', '1524148713');
COMMIT;

-- ----------------------------
--  Table structure for `pp_image`
-- ----------------------------
DROP TABLE IF EXISTS `pp_image`;
CREATE TABLE `pp_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key_id` varchar(64) NOT NULL COMMENT 'md5(title+size+width+height)',
  `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '图片大小',
  `width` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '宽',
  `height` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '高度',
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '名字',
  `img_src` varchar(255) NOT NULL DEFAULT '0' COMMENT '图片地址',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '0-banner,1-face_img,2-md_img',
  `add_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `edit_time` int(11) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态0-正常1-删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_key_id` (`key_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pp_image`
-- ----------------------------
BEGIN;
INSERT INTO `pp_image` VALUES ('1', '5d52f819ebefa0a0f49f369646481be1', '62379', '752', '280', 'clumb.png', '/Uploads/banner/2018-04-19/152414913163427.png', '0', '1524149131', '0', '0'), ('2', '1c67c48321693b4650a0ef8e1d10b77c', '60692', '752', '280', 'way.png', '/Uploads/banner/2018-04-19/152414917615215.png', '0', '1524149176', '0', '0'), ('3', '26864cca00f64161505d1c0b4565574e', '72644', '440', '300', 'go.png', '/Uploads/article/2018-04-19/152414947912273.png', '1', '1524149479', '0', '0'), ('4', 'de831b181de6da5be58e3ee260bd3d72', '7963', '180', '180', 'editormd-logo-180x180.png', '/Uploads/article/2018-04-19/152415004035375.png', '1', '1524150040', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `pp_link`
-- ----------------------------
DROP TABLE IF EXISTS `pp_link`;
CREATE TABLE `pp_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(128) NOT NULL DEFAULT '0' COMMENT '友情连接关键字',
  `link_url` text NOT NULL COMMENT '网址',
  `add_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `edit_time` int(11) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态0-正常1-删除',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '99' COMMENT '排序越大越往前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pp_link`
-- ----------------------------
BEGIN;
INSERT INTO `pp_link` VALUES ('1', '在路上', 'http://www.haodaquan.com', '1524148727', '0', '0', '1');
COMMIT;

-- ----------------------------
--  Table structure for `pp_tag`
-- ----------------------------
DROP TABLE IF EXISTS `pp_tag`;
CREATE TABLE `pp_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tag_name` varchar(64) NOT NULL DEFAULT '0' COMMENT '标签名',
  `is_top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶1-置顶，0-不置顶',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edit_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态，0-正常，1-删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pp_tag`
-- ----------------------------
BEGIN;
INSERT INTO `pp_tag` VALUES ('1', 'PHP', '1', '1524149231', '1524149238', '0'), ('2', 'Golang', '1', '1524149254', '1524149259', '0'), ('3', 'Javascript', '0', '1524149274', '0', '0'), ('4', 'Layui', '0', '1524149283', '1524149293', '0'), ('5', '算法', '0', '1524149308', '0', '0'), ('6', 'Mysql', '0', '1524149330', '0', '0'), ('7', 'Redis', '0', '1524149339', '0', '0'), ('8', 'MongoDB', '0', '1524149351', '0', '0'), ('9', '二分查找', '0', '1524149692', '0', '0'), ('10', 'markdown', '0', '1524150051', '0', '0'), ('11', '你好', '0', '1525478824', '0', '0'), ('12', 'PHP方法', '0', '1525478824', '0', '0'), ('13', 'pp_blog', '0', '1525478824', '0', '0'), ('14', 'Go', '0', '1525482062', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `pp_topic`
-- ----------------------------
DROP TABLE IF EXISTS `pp_topic`;
CREATE TABLE `pp_topic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(64) NOT NULL DEFAULT '0' COMMENT '标签名',
  `detail` varchar(255) NOT NULL DEFAULT '0' COMMENT '说明',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edit_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态，0-正常，1-删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pp_topic`
-- ----------------------------
BEGIN;
INSERT INTO `pp_topic` VALUES ('1', 'PPGo专题', '测试标题', '1532787437', '1532795451', '0'), ('2', 'Golang专题', '所发生的会计师劳动法会计师的方式来东方嘉盛水电费就开始弗兰克斯就爱发牢骚方会计师的浪费空间四防坑精神分裂的会计师的弗兰克的时间飞逝漏洞看非技术的', '1532788636', '1532836644', '0');
COMMIT;

-- ----------------------------
--  Table structure for `uc_user`
-- ----------------------------
DROP TABLE IF EXISTS `uc_user`;
CREATE TABLE `uc_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login_name` varchar(32) NOT NULL DEFAULT '0',
  `password` varchar(32) NOT NULL DEFAULT '0' COMMENT '密码',
  `user_name` varchar(32) NOT NULL COMMENT '用户名称',
  `add_time` int(11) NOT NULL,
  `edit_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `uc_user`
-- ----------------------------
BEGIN;
INSERT INTO `uc_user` VALUES ('1', 'admin', 'd93a5def7511da3d0f2d171d9c344e91', '管理员', '1484023044', '1523371836');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
