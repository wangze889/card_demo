###微信卡券后台

####项目说明
项目基于 Laravel5.5 框架，使用 EasyWeChat 微信SDK为前端提供接口

####开发环境
- php: php-7.1
- mysql: mysql-5.6

####目前使用到的 composer 包

- [overtrue/easywechat](https://www.easywechat.com/)

  composer require overtrue/wechat:~4.0 -vvv
  
- [overtrue/laravel-wechat](https://github.com/overtrue/laravel-wechat)

  composer require "overtrue/laravel-wechat:~4.0"
  
- [barryvdh/laravel-cors](https://github.com/barryvdh/laravel-cors)
    
  composer require barryvdh/laravel-cors
  
####自定义目录结构
#####app 目录
- Exceptions ------------异常类
- Helpers ---------------包含 api 处理的助手 class 或 trait
- Http
  - Controllers
    - Api-----------------Api的父控制器，引入 ApiResponse 和其他方法
    - UpLoad--------------上传类
    - WeChat--------------微信相关控制器
    - WeChatPush----------微信推送事件处理类
- Models -----------------模型
