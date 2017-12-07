<?php
namespace fengphp\core\model;

//动作：导入命名空间别名
use Exception;
use PDO;

	class Model {
		/*
		 * 动作：声明Model类的属性
		 */
		//动作（功能）：将 $pdo 属性声明为静态是为了在整个PHP脚本中只进行一次数据库的连接，避免重复的连接
		private static $pdo = null;
		private static $driver = '';        //数据库类型，数据库驱动
		private static $host = '';          //主机地址
		private static $dbname = '';        //数据库名称
		private static $user = '';          //数据库用户
		private static $password = '';      //数据库密码

		public function __construct() {
			//动作：从数据库配置文件中读取数据库连接的所有配置项
			$driver = c ('database.driver');
			$host = c ('database.host');
			$dbname = c ('database.dbname');
			$user = c ('database.user');
			$password = c ('database.password');

			//动作：判断当前数据库连接请求和先前的数据库连接请求是不是同一个数据库连接
			//功能：如果是同一个数据库连接则尝试使用先前的数据库连接；
			//否则另外进行新的数据库连接
			if ($driver == self::$driver && $host == self::$host && $dbname == self::$dbname && $user == self::$user && $password == self::$password && !is_null(self::$pdo)) {
				//当前数据库连接和先前数据库连接是同一个连接的情况...

//				echo '老朋友，欢迎回来' . '<br />';
				//什么都不做，因为数据库连接早就已经存在了
			} else {
				//当前数据库连接是一个全新的连接...
//				echo '嘿，新来的家伙，我们欢迎你！' . '<br />';
				//进行数据库的连接
				try {
					//第1步
					//动作（功能）：指定数据库连接的数据源，包含信息：数据库类型、主机地址和数据库名称
					$dsn = $driver . ':host=' . $host . ';dbname=' . $dbname;

					//第2步
					//动作：实例化PDO类
					//功能：进行数据库的连接
					self::$pdo = new PDO($dsn, $user, $password);

					//第3步
					//动作：用 self::$pdo -> setAttribute() 设置PDO错误处理为抛出异常
					//功能：PDO方法出错时将会抛出一个异常
					self::$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					//第4步
					//动作：用 self::$pdo -> query() 设置客户端于SQL服务器通信过程中的字符集
					self::$pdo -> query('set names utf8');

					//到这里，一个正常的数据库连接就已经成功了...

					//动作（功能）：将当前的数据库连接参数保存起来，方便下次的连接请求
					self::$driver = $driver;
					self::$host = $host;
					self::$dbname = $dbname;
					self::$user = $user;
					self::$password = $password;

				} catch (Exception $e) {
					//动作（功能）：输出接收到的异常中的错误信息并且中止PHP脚本的执行
					die($e -> getMessage());
				}
			}
		}

		public function q($sql) {
			//动作：将查询数据库的代码放在try{}catch(){}块中，PDO方法操作失败时就会抛出一个异常
			try {
				//动作（功能）：将SQL语句发送到SQL服务器中执行，以 PDOStatement对象 的形式返回数据查询结果
				$res = self::$pdo -> query($sql);

				//动作（功能）：使用 $res -> fetchAll() 以关联数组的形式返回数据查询结果
				return $res -> fetchAll(PDO::FETCH_ASSOC);
			} catch(Exception $e) {
				//动作（功能）：输出捕获到的异常中的错误信息并中止PHP脚本的执行
				die($e -> getMessage());
			}
		}

		public function e($sql) {
			//动作：将查询数据库的代码放在try{}catch(){}块中，PDO方法操作失败时就会抛出一个异常
			try {
				//动作（功能）：将SQL语句发送到SQL服务器中执行，返回受影响的数据的行数
				return self::$pdo -> exec($sql);
			} catch (Exception $e) {
				//动作（功能）：输出捕获到的异常中的错误信息并中止PHP脚本的执行
				die($e -> getMessage());
			}
		}
	}