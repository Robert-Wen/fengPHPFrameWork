<?php
namespace fengphp\core\controller;

use fengphp\core\view\View;

/**
 * Class Controller-------所有控制器类的基类，提供控制器类常用的功能。
 * @package fengphp\core\controller
 */
class Controller {
	//提示消息以后用来跳转页面的js代码，默认跳转到上一个页面
	protected $url = 'history.back();';
	//经过 compact 处理后的渲染数据，用于后续的模板渲染
	protected $data = [];

	/**
	 * 功能：加载操作结果提示页面并输出指定的提示消息，然后跳转到提前设置好的url。
	 * 这个方法使用的是默认的模板 message.php 。如果需要使用其他的模板则可以在
	 * 继承 Controller 后重写这个方法，使用 View 类加载其他的模板。
	 * @param $msg  提示消息
	 */
	public function message ($msg) {
		//动作：加载模板文件
		//功能：渲染模板
		include_once './view/message.php';
	}

	/**
	 * 功能：设置页面跳转的url地址
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


	/**
	 * 功能：输出渲染后的模板
	 * @param string $view  模板路径，没有指定的话使用
	 * '当前模块/view/当前控制器/当前方法.html' 这个模板文件
	 */
	public function show ($view = '') {
		/**
		 * 功能：用于实例化一个 View 类：
		 * 1.将渲染数据传递给 View 实例
		 * 2.给模板的路径传递给 View 实例
		 * 3.输出一个 View 实例，这样就会触发 __toString() 魔术方法，最后输出渲染后的模板文件
		 */
		echo (new View()) -> with ($this -> data) -> make ($view);
	}
}