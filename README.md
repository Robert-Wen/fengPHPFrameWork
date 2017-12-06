# fengPHPFrameWork
个人PHP框架，帮助理解流行框架工作原理

1.目录结构
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
    |
    |-fengphp(框架核心)
    |    |
    |    |-core(核心功能)
    |    |
    |    |-model(核心类)
    |    |
    |    |-view(处理模板文件加载的类)
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
    |    |-model(处理业务的各种模型类)
    |
    |-...
````