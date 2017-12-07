<?php
namespace fengphp\core;

class Controller {
	//提示消息以后用来跳转页面的js代码，默认跳转到上一个页面
	private $url = 'history.back();';

	/**
	 * 功能：加载操作结果提示页面并输出指定的提示消息，然后跳转到提前设置好的url
	 * @param $msg  提示消息
	 */
	public function message ($msg) {
		//动作：加载模板文件
		//功能：渲染模板
		include_once './view/message.php';
	}

	/**
	 * @param string $url       "模块/控制器/动作"形式的字符串
	 * @return $this            当前的对象，用于链式操作
	 */
	public function setRedirect ($url = '') {
		//动作：判断是否指定跳转的url
		if ($url) {
			//动作（功能）：指定了要跳转的url，生成跳转到指定页面的js代码。。。
			$this -> url = 'location.href="' . $url . '";';
		}

		//动作（功能）：返回当前的对象$this，用于链式操作
		return $this;
	}
}