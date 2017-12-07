<?php
namespace app\home\controller;

use fengphp\core\Controller;

class Article extends Controller {
	public function index () {
		echo 'home 文章首页 <br />';
	}

	public function add () {
		//动作：链式操作，先设置要跳转的url为上一个页面，然后输出提示消息
		$this -> setRedirect(u ('index')) -> message('添加成功，恭喜发财!');
	}
}