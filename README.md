# fengPHPFrameWork
个人PHP框架，帮助理解流行框架工作原理

###1.目录结构
````
项目目录 
    |
    |-app(开发者写代码的地方，存放着Model, View, Controller)
    |    |
    |    |-home(前台模块)
    |    |    |
    |    |    |-model(模型类)
    |    |    |
    |    |    |-controller(控制器类)
    |    |    |
    |    |    |-view(模板文件)
    |    |
    |    |-admin(后台模块)
    |    |
    |    |-...
    |
    |-fengphp(框架核心)
    |    |
    |    |-core(核心功能)
    |    |   |
    |    |   |-controller(放置控制器基类)
    |    |   |
    |    |   |-model(放置模型基类)
    |    |   |
    |    |   |-view(处理模板文件加载的类)
    |    |
    |    |-...
    |
    |-public(入口，放置单入口文件和静态资源)
    |    |
    |    |-static(静态资源)
    |    |
    |    |-view(公共模板文件)
    |    |
    |    |-index.php(单入口文件)
    |
    |-system(系统配置)
    |    |
    |    |-config(配置文件)
    |    |
    |    |-helper.php(助手函数文件)
    |
    |-runtime(运行时产生的文件放置在这里，例如，session 文件)
    |
    |-vendor(第三方类库放置在这里，例如 composer 类库)
    |
    |-...
````
###2.框架构建的基本步骤
#####第1步：从 `Github` 中将项目库(repository)拉取到本地
````
这样子就可以在本地修改项目，然后提交同步到 Github 上面
````
#####第2步：创建出框架的目录结构
````
按照上面的目录结构创建目录即可
````
#####第3步：往框架目录（fengphp）中导入composer类库
````
composer类库的作用：音乐指挥家的角色，负责协调各种类库文件的加载，可以方便地实现类库的自动加载。
用法：
1.composer init
作用：在框架目录中初始化 composer ，生成 composer.json 配置文件
2.composer dump
作用：在框架目录中创建 vendor/composer 目录和 vendor/autoload.php 类文件
3.修改 composer.json 配置文件，添加配置项 autoload:
{
    ...,
    /*这个只能用双引号括住配置项*/
    "autoload": {
        /*这个指定自动加载的文件*/
        "files": ["system/helper.php"],
        /*psr-4：自动加载规范。这个指定命名空间和目录的映射关系*/
        "psr-4": {
            /*命名空间: 目录*/
            "app\\": "app\\",
            "feng\\": "fengphp\\"
        }
    }
}
4.composer dump
作用：根据 composer.json 配置文件重新生成 vendor 目录下面的内容
5.在单入口文件 index.php 中将 vendor/autoload.php 类文件加载进来，
然后只需要指定类的完全限定名称 new \fengphp\core\Boot() 或者导入别名
use fengphp\core\Boot; new Boot();  就能使用到 Boot 类。
````
#####第4步：创建单入口文件
````
//动作：别名导入（phpstorm自动生成）
use fengphp\core\Boot;

//动作：用 require_once 加载类文件 autoload.php, 
//因此在类文件 autoload.php 加载失败时中止PHP脚本的运行
//功能：实现类文件的自动加载
require_once '../vendor/autoload.php';

//动作：用 require_once 加载类文件 Boot.php 并且调用 run() 方法, 
//因此在类文件 Boot.php 加载失败时中止PHP脚本的运行
//功能：初始化框架环境，为 MVC 框架的正常运行做好准备
Boot::run();
````
#####第5步：创建框架的引导类文件 ``Boot.php`` 
````
class Boot {
    public static function run() {
        //第1步：错误处理
        self::handler();
        
        //第2步：初始化框架环境
        self::init();
        
        //第3步：运行应用程序，将url请求路由到指定的模块/控制器/方法
        self::appRun();
    }
    public static function init() {
        //1.设置正确的头部
        //2.设置正确的时区
        //3.开启一个会话
    }
    public static function handler() {
        //进行错误的处理
        //1.首先到 packagist 上面找到 flip/whoops
        //2.在 phpStorm 的命令行输入 composer require flip/whoops 将下载到目录中
        //3.在这个方法中粘贴下面的代码就行了
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
    public static function appRun() {
        //1.接收用户的url请求参数
        //2.将接收到的url参数拆分成module, controller, action
        //3.实例化指定的控制器类后调用指定的方法
    }
}
````
#####第6步：在 fengphp/core/controller 中创建一个控制器基类文件 Controller.php
````
Controller.php 控制器基类文件主要实现所有的控制器类共用的方法，
例如，成功失败提示message()等功能
````
#####第7步：在 fengphp/core/model 中创建一个模型基类文件 Model.php
````
Model.php 模型基类文件主要实现所有的模型类共用的方法，
例如，数据库的连接，数据增删改查，数据库链式操作等功能
````
#####第8步：在 fengphp/core/view 中创建一个视图类文件 View.php
````
View.php 视图基类文件用于加载和渲染模板等功能。
例如，获得模板渲染需要的数据，用模板数据渲染模板等功能
````
######经过上面的步骤后一个渣渣的框架基本完成了，以下的4个步骤都是属于
######用户测试或者使用框架的步骤！！
#####第9步：创建模块
````
在 app 目录下创建项目需要的模块:
home -- 前台模块
admin -- 后台管理模块
member -- 会员模块
...
````
#####第10步：在模块中创建控制器 Controller 
（用户自定义的控制器类文件）
````
Controller 作用：负责调度页面，处理模型类提供的数据，然后用这些数据渲染模板，最终将页面输出发送到浏览器中呈现给用户
home模块中的测试控制器：
Index.php -- 首页控制器类文件，实现首页中可以执行的各种操作
Article.php -- 文章控制器类文件，实现文章的增删编辑等操作

member模块中的测试控制器：
Index.php -- 首页控制器类文件，实现首页中可以执行的各种操作
Login.php -- 登录控制器类文件，实现登录、退出登录和注册等功能
````
#####第11步：在模块中创建模型 Model
（用户自定义模型类，通常与数据库对应起来）
````
Model 作用：为网站提供数据的支持
User.php -- 用户模型类
Article.php -- 文章模型类，和上面的 Article.php 控制器类不一样
...
````
#####第12步：在模块中创建视图 View
（各种各样的前端页面，模板）
````
View 作用：直接面对用户，是一个网站的门面，十分重要。
通常模板都是事先做好，然后才在框架中加上后端的支持。
index.html -- 网站首页模板
edit.html -- 文章编辑的页面模板
login.html -- 登录页面的模板
...
````