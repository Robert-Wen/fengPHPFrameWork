<?php
	/**
	 * Created by PhpStorm.
	 * User: Mr.Robot
	 * Date: 2017-11-8
	 * Time: 14:10
	 * E-mail: fengze_wen@163.com
	 */

	//动作：判断指定函数是否已定义
	//功能：避免重复定义函数
	if (!function_exists('preVarDump')) {
		/*
		 * 功能：以漂亮的格式显示变量类型和值
		 * @param null $var  需要显示的变量
		 */
		function preVarDump($var=null) {
			//动作：输出有样式的pre标签
			//功能：使var_dump的输出在网页中保持原样
			echo '<pre style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background: tan; width: 98%; border-radius: 5px; margin: 10px 1%; font-size: 18px; line-height: 22px;padding: 10px;">';
			//动作：输出变量的类型和值
			var_dump($var);
			//动作：输出</pre>
			//功能：将$var的类型和值包含在pre标签中，避免影响到后面的输出
			echo '</pre>';
		}
	}

	//动作：判断指定函数是否已定义
	//功能：避免重复定义函数
	if (!function_exists('prePrint')) {

		/**
		 * 功能：漂亮打印所有类型变量的值，仅包含少量的类型信息
		 * @param null $var  需要漂亮显示的变量
		 */
		function prePrint($var=null) {
			//动作：输出有样式的pre标签
			//功能：使var_dump的输出在网页中保持原样
			echo '<pre style="box-sizing: border-box; background: tan; width: 98%; border-radius: 5px; margin: 10px 1%; font-size: 18px; line-height: 22px; padding: 10px;">';
			//动作：判断是布尔值或者null
			//功能：根据类型安排输出方式
			if (is_bool($var) || is_null($var)) {
				//动作：var_dump布尔值和null
				//功能：使不可视的变量可视化
				var_dump($var);
			} else {
				//动作：print_r除布尔值和null外的所有变量类型
				//功能：使可视化的变量简洁输出
				echo htmlspecialchars(print_r($var, true));
			}
			//动作：输出</pre>
			//功能：将$var的类型和值包含在pre标签中，避免影响到后面的输出
			echo '</pre>';
		}
	}

	if (!function_exists('u')) {
		/**
		 * 功能：将 '/模块/控制器/方法' 形式的字符串转化为合法的形式 '?s=模块/控制器/方法'，
		 * 提供了访问当前模块或者当前控制器中的方法的便利
		 * @param $url
		 * @return mixed
		 */
		function u ($url = '') {
//			prePrint($url);die();

			//动作：用 explode 将字符串拆分成数组
			//功能：从 $url 中提取出模块、控制器和动作
			$info = explode('/', $url);

			//动作：通过判断数组元素的个数去确定要使用的模块、控制器和动作
			//功能：实现对当前模块或者当前控制器的便利调用
			if (count($info) == 1) {
				//只传递进来动作，使用当前的模块和控制器...

				//动作：判断$info[0]是否为空字符串，不是空字符串则使用$info[0]；是空字符串则使用默认的动作 index
				$info[0] = $info[0] ? $info[0] : 'index';

				//动作：使用当前模块、当前控制器、用户指定的动作拼接成合法的url请求
				$res = '?s=' . MODULE . '/' . CONTROLLER . '/' . $info[0];
			} else if (count($info) == 2) {
				//传递进来控制器和动作，使用当前模块...

				//动作：判断$info[0]是否为空字符串，不是空字符串则使用$info[0]；是空字符串则使用默认的控制器 Index
				$info[0] = $info[0] ? $info[0] : 'Index';

				//动作：判断$info[1]是否为空字符串，不是空字符串则使用$info[1]；是空字符串则使用默认的动作 index
				$info[1] = $info[1] ? $info[1] : 'index';

				//动作：使用当前模块、用户指定的控制器、用户指定的动作拼接成合法的url请求
				$res = '?s=' . MODULE . '/' . $info[0] . '/' . $info[1];
			} else {
				//传递进来模块、控制器和动作...

				//动作：判断$info[0]是否为空字符串，不是空字符串则使用$info[0]；是空字符串则使用默认的模块 home
				$info[0] = $info[0] ? $info[0] : 'home';

				//动作：判断$info[1]是否为空字符串，不是空字符串则使用$info[1]；是空字符串则使用默认的控制器 Index
				$info[1] = $info[1] ? $info[1] : 'Index';

				//动作：判断$info[2]是否为空字符串，不是空字符串则使用$info[2]；是空字符串则使用默认的动作 index
				$info[2] = $info[2] ? $info[2] : 'index';

				//动作：使用用户指定的模块、用户指定的控制器、用户指定的动作拼接成合法的url请求
				$res = '?s=' . $info[0] . '/' . $info[1] . '/' . $info[2];
			}

			//动作：返回拼接好的合法url请求
			return $res;
		}
	}

	/**
	 * 定义常量IS_POST用来检测当前请求的方式
	 * $_SERVER['REQUEST_METHOD']提供了
	 * 更加准确的方法去判断当前请求方式
	 * 使用常量的原因：常量的作用域是全局的
	 */
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//动作：定义常量IS_POST，值为true
		//功能：表示当前请求方式post
		define('IS_POST', true);
	} else {
		//动作：定义常量IS_POST，值为false
		//功能：表示当前请求方式get
		define('IS_POST', false);
	}


	/**
	 * 定义常量IS_AJAX用来检测当前请求是不是ajax请求
	 * $_SERVER['HTTP_X_REQUESTED_WITH']提供了
	 * 更加准确的方法去判断当前请求方式
	 * 使用常量的原因：常量的作用域是全局的
	 */
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
		//ajax请求的时候...

		//动作：定义常量IS_AJAX，值为true
		//功能：表示当前请求为ajax请求
		define('IS_AJAX', true);
	} else {
		//不是ajax请求的时候...

		//动作：定义常量IS_AJAX，值为false
		//功能：表示当前请求不是ajax请求
		define('IS_AJAX', false);
	}