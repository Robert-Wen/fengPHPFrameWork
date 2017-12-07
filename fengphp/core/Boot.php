<?php
namespace fengphp\core;

	class Boot {
		public static function run() {
			//第1步：初始化框架环境
			self::init();

			//第2步：错误处理
			self::handler();

			//第3步：运行应用程序，将url请求路由到指定的模块/控制器/方法
			self::appRun();
		}

		public static function init() {
			//1.设置正确的头部
			//动作：头部内容声明
			//功能：正常显示中文
			header('Content-type:text/html; charset="utf8"');

			//2.设置正确的时区
			//动作：时区设置
			//功能：将时区设置为东八区，使时间信息显示正常
			date_default_timezone_set('PRC');

			//3.开启一个会话
			//动作：用session_save_path()指定会话文件存放的路径，
			//session_name()指定会话cookie的名字为 SID ，
			//session_start()开启一个会话
			//功能：session_start 首先判断是否接收到会话cookie，
			//如果接收到会话cookie则会从对应的会话文件中恢复先前的会话数据；
			//否则开启一个新的会话，创建一个新的会话文件，向浏览器发送一个对应的会话cookie
			session_save_path('../runtime/session_files');
			session_name('SID');
			session_start();
		}

		public static function handler() {
			//1.进行错误的处理
		}

		public static function appRun() {
//			//测试能否在实例化控制器时加载相应的类文件
//			//动作：调用home/Index/index
//			(new \app\home\controller\Index()) -> index ();
//			//动作：调用home/Article/index
//			(new \app\home\controller\Article()) -> index();
//			//动作：调用home/Article/add
//			(new \app\home\controller\Article()) -> add ();
//			//动作：调用member/Login/index
//			(new \app\member\controller\Login()) -> index ();
//			//动作：调用member/Login/register
//			(new \app\member\controller\Login()) -> register ();


			//1.接收用户的url请求参数
			//动作：判断url请求中是否带有参数$_GET['s']
			//功能：如果有url请求参数且参数不是空字符串则对URL参数进行拆分；
			//否则直接使用默认的模块，控制器和动作
			if (isset($_GET['s']) && $_GET['s'] != '') {
				//url请求中带有参数?s=module/controller/action时...

//				prePrint($_GET);

				//动作（功能）：接收url参数
				$s = $_GET['s'];

				//2.将接收到的url参数拆分成module, controller, action
				//动作：用 explode 将字符串拆分成数组
				//功能：在url参数中提取出module, controller, action的名称
				$info = explode('/', $s);

//				prePrint($info); die();

				//动作：获得url参数中指定的module
				//功能：如果指定了module则使用指定的module；否则使用默认的module
				$m = (isset($info[0]) && $info[0] != '') ? $info[0] : 'home';
				//动作：获得url参数中指定的controller
				//功能：如果指定了controller则使用指定的controller；否则使用默认的controller
				$c = (isset($info[1]) && $info[1] != '') ? ucfirst($info[1]) : 'Index';
				//动作：获得url参数中指定的action
				//功能：如果指定了action则使用指定的action；否则使用默认的action
				$a = (isset($info[2]) && $info[2] != '') ? $info[2] : 'index';
			} else {
				//url请求中没有参数时...

				$m = 'home';  //默认的模块
				$c = 'Index'; //默认的控制器
				$a = 'index'; //默认的方法
			}

//			prePrint($res); die();

			//动作：将提取出来的模块，控制器拼接成命名空间中的类名
			$controller = '\app\\' . $m . '\controller\\' . $c;

			//动作：定义三个常量：MODULE, CONTROLLER, ACTION
			//功能：方便助手函数u('action')生成url，因为define定义的常量
			//在任何地方都能够被访问到
			define('MODULE', $m);
			define('CONTROLLER', $c);
			define('ACTION', $a);

//			prePrint($controller); die();

			//3.实例化指定的控制器类后调用指定的方法
			//动作：实例化url请求中指定的模块中的控制器，然后调用指定的动作
			//功能：将用户的url请求路由到指定的模块/控制器/方法
			(new $controller()) -> $a();
		}
	}
