<?php
namespace fengphp\core\view;

class View {
	private $view = '';  //模板的路径
	private $data = [];  //渲染模板要用到的数据

	/**
	 * 功能：生成模板文件的路径。在没有指定模板文件路径时，
	 * 使用 '当前模块/view/当前控制器/当前方法.html' 这个模板文件；
	 * 指定了则使用用户指定的模板文件
	 * @param string $view  模板文件路径
	 * @return $this        当前类的一个实例，用于支持链式操作
	 */
	public function make ($view = '') {
		//1.接收用户指定的模板路径
		//动作：判断用户是否指定了模板文件路径
		//功能：如果指定了则使用用户指定路径；
		//否则使用 '当前模块/view/当前控制器/当前方法.html' 这个模板文件
		if ($view) {
			//用户指定了模板路径...

			$this -> view = $view;
		} else {
			//用户没有指定模板文件路径...

			$this -> view = '../app/' . MODULE . '/view/' . strtolower(CONTROLLER) . '/' . ACTION . '.' . c ('view.suffix');
		}

//		prePrint($this -> view);

		//2.返回一个对象以支持链式操作
		//动作：返回 $this
		//功能：支持链式操作
		return $this;
	}

	/**
	 * 功能：接收渲染模板要用到的数据
	 * @param array $data       渲染模板要用到的数据
	 * @return $this            返回当前类的对象以支持链式操作
	 */
	public function with ($data = []) {
		//1.接收渲染模板需要的数据
		$this -> data = $data;

//		prePrint($this -> data);

		//2.返回一个对象以支持链式操作
		//动作：返回 $this
		//功能：支持链式操作
		return $this;
	}

	public function __toString() {
		//1.将渲染要用到的数据导入当前作用域
		extract($this -> data);

//		prePrint($str);
//		prePrint($arr);

		//2.判断模板文件是否存在，存在则加载进来；不存在则输出模板不存在
		if (is_file($this -> view)) {
			//文件存在...

			//动作：加载模板文件
			//功能：用接收到的数据渲染模板文件
			include_once $this -> view;
		} else {
			//文件不存在...

			prePrint('模板文件不存在！');
		}

		//3.返回空字符串，因为 __toString 要求返回一个字符串
		return '';
	}
}