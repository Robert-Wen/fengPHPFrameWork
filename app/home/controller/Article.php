<?php
namespace app\home\controller;

use fengphp\core\controller\Controller;
use fengphp\core\model\Model;

class Article extends Controller {
	public function index () {
		//动作；
		//动作：准备好渲染模板要用到的数据
		$arr = (new Model()) -> q ('select * from student;') ;
		$rows = (new Model()) -> e ('delete from student where age>48;');
		//动作：将变量名指定的变量压缩成一个关联数组，键名为变量名，键值为变量值
		//功能：将所有的数据打包成一个关联数组传递给 View 视图类，便于将数据导入到 View 视图类中
		$this -> data = compact('arr', 'rows');

		//动作（功能）：输出渲染后的页面
		$this -> show ();
	}

	public function add () {
		//动作：链式操作，先设置要跳转的url为上一个页面，然后输出提示消息
		$this -> setRedirect(u ('index')) -> message('添加成功，恭喜发财!');
	}
}