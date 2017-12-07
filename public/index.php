<?php
	//动作：命名空间别名导入
	//功能：缩短要写的东西
	use \fengphp\core\Boot;

	//动作：用 require_once 加载类文件 autoload.php,
	//因此在类文件 autoload.php 加载失败时中止PHP脚本的运行
	//功能：实现类文件的自动加载
	require_once '../vendor/autoload.php';

	//动作：用 require_once 加载类文件 Boot.php 并且调用 run() 方法,
	//因此在类文件 Boot.php 加载失败时中止PHP脚本的运行
	//功能：初始化框架环境，为 MVC 框架的正常运行做好准备
	Boot::run();