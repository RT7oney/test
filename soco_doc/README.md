<div style="text-align:center;">
	<img src="http://bbs.supersoco.com/uc_server/data/avatar/000/00/01/66_avatar_middle.jpg">
</div>
#soco back-end 文档

作者：[Ryan](https://github.com/RT7oney)

---

```zsh
├── application 
│   ├── config
│	│  	├── soco.php -------------------------- 速珂配置
|	|	├── soco_controllers.php -------------- 速珂控制器注册配置  
│   │   └── soco_models.php ------------------ 速珂模型注册配置    
│   ├── controllers   
│   │   ├── file.php ------------------------- 文件服务
│   │   ├── goods.php ------------------------ 商品服务
│   │   ├── index.php ------------------------ 基础服务 
│   │   └── pay.php -------------------------- 支付服务    
│   ├── core 
│   │   ├── Soco_Controller.php -------------- 速珂基础控制器 
│   │   └── Soco_Model.php ------------------- 速珂基础模型 
│   ├── data 
│   │   ├── excel ---------------------------- excel文件目录 
│   │   └── image ---------------------------- 图片文件目录 
│   ├── helpers
│   │   └── soco_helper.php ------------------ 速珂帮助方法 
│   ├── libraries
│   │   ├── cert ----------------------------- 证书文件目录
│   │   ├── excel ---------------------------- php excel工具库目录
│   │   ├── phpdoc --------------------------- php 文档自动生成目录
│   │   ├── wechat_pay ----------------------- 微信支付工具库目录
│   │   ├── ExcelTool.php -------------------- excel工具库
│   │   ├── MongoTool.php -------------------- mongoDB工具库
│   │   ├── RedisTool.php -------------------- redis工具库
│   │   └── WeChatPay.php -------------------- 微信支付工具库 
│   ├── models
│   │   ├── goodsMod.php --------------------- 商品模型
│   │   ├── indexMod.php --------------------- 基础模型
│   │   ├── orderMod.php --------------------- 订单模型
│   │   └── userMod.php ---------------------- 用户模型 
│   └── views 
│   │   ├── doc.php -------------------------- 自动生成文档视图文件
│   │   └── jspay_view.php ------------------- 微信内网页jsapi支付视图文件  
├── index.php -------------------------------- 项目入口 (debug 开关在这里！)   
```
##速珂配置

该配置遵循CI框架的加载配置模式，并且在使用该soco架构的时候自动加载，具体的一些解释已经写入注释，请仔细阅读

##速珂控制器注册配置

ignore中包含着一些可以忽略扫描的文件，在register数组里面，注册过的文件会被检测是否继承了Soco_Controller文件

##速珂模型注册配置

同理速珂控制器注册配置

##文件服务

文件服务已经封装了

	1.以base64编码方式的上传图片方法（upimg）
	2.将请求的数组转化成excel文件的方法（arr2xls）
	3.将请求的.xls文件读取出其中的内容并且以数组的形式呈现（xls2arr）
	4.文件下载服务，请注意，下载目录为application/data/下的文件，不包含excel的tmp目录（down）

##商品服务

商品服务已经封装了

	1.添加商品（insert）
	2.获取所有商品列表（all）

##基础服务

基础服务已经封装了

	1.soco平台的控制器调用以及开发示例（index）
	2.用户登录（login）
	3.用户注册（signup）

##支付服务

支付服务已经封装了

	1.支付订单初始化（index）
	2.支付（pay）
	3.支付回调（未完成）

##速珂基础控制器
Soco_Controller.php

* 其他控制器的命名需全部为小写

因为我们使用了[CI文档插件](http://ym1623.github.io/codeigniter_apidoc/codeigniter_apidoc/setup/setup.html)该插件要求扫描到的控制器文件全部命名为小写，希望各位开发者注意在生成文档之后，为了在linux环境下兼容，还需要把控制器名称重新改为大写

* 其他控制器在调用之前需要继承该类

注册流程：

	1.当你新建了一个控制器文件的时候，比如你的控制器文件名为xxx.php，你需要在config/soco_controller.php里面的register里面添加你的控制器名称xxx
	2.然后你需要继承Soco_Controller，如果继承CI_Controller会在CI框架的钩子类方法拦截
	3.之后在你的控制器里面需要实现一个__construct()方法，需要调用Soco_Controller类里面的$this->__RegCtr()方法对你的控制器进行注册管理

该类在初始化的时候会：

	1.载入soco配置
	2.载入公共封装的辅助方法
	3.载入CI框架的SESSION类
	4.获取IP
	5.获取访问的uri
	6.从SESSION里取出用户的uuid（如果有）
	7.对所有入参和出参都进行日志记录
	8.验证系统级参数签名
* 请在业务控制器中严格使用方法<font style="color:red">$this->__Response()</font>对请求进行响应

##速珂基础模型
Soco_Model.php

* 其他模型在调用之前需要继承该模型

注册流程：
	
	1.当你新建了一个模型文件的时候，比如你的模型文件名为xxxMod.php，你需要在config/soco_models.php里面的register里面添加你的模型名称xxxMod
	2.需要注意的是，假如你的config/soco.php里面的use_table_prefix为true那么你需要在注册模型文件的时候在config/soco_models.php里面的register里面加上表的前缀，前缀规则遵循@张伟的“sc-数据库设计规范-1028-zw.doc”，比如你的xxxMod对应的表xxx的前缀是a_bc_那么你在注册的时候以数组的键值的形式指向你的模型xxxMod如下：
		'a'=>array(
			'bc'=>array(
				'xxxMod',
				'yyyMod',
			),
			'cd'=>array(
				'zzzMod'
			),
		)
		这样，你的xxxMod中使用$this->RegMod(__CLASS__,'xxx')//xxx为表名，此时对应的数据库中的具体的表为'a_bc_xxx'，以此类推，yyyMod对应的表为‘a_bc_yyy’，zzzMod对应的表为‘a_cd_zzz’
该类目前所包含的方法有：

	1.对其他模型的表注册
	2.增、删、改、查的数据库方法封装

##excel工具库

该类封装了：
	
	1.数组写入.xls辅助方法
	2..xls文件处理读取为数组辅助方法
注意：数组写入.xls方法中$head为一维数组，$data数组为多维数组，且第二维数组的键值必须为对应的$head标题中的值，而且同一维度的数组格式和数据内容需要保持一致

##mongoDB工具库

* 由于php5和php7mongoDB的驱动类型不一样，相对的扩展也不一样，所以针对不同的扩展该类封装了两个类，都实现了对mongodb的一些基础的增删改查操作，由于笔者对mongoDB也是属于刚刚接触，具体的封装都是参照了官方的文档，并没有加入其它特性，具体文档教程请[点击](http://www.runoob.com/mongodb/mongodb-tutorial.html)

##redis工具库

* 对redis一些常用操作的封装

##微信支付工具库

该类封装了：
	
	1.扫码支付（针对pc端）
	2.jsapi支付（针对微信内浏览器）
	
##商品模型

该模型类对应的表为：

```sql
SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `rt_test_goods`
-- ----------------------------
DROP TABLE IF EXISTS `rt_test_goods`;
CREATE TABLE `rt_test_goods` (
  `id` tinyint(255) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `amount` int(10) unsigned DEFAULT NULL COMMENT '商品库存总量',
  `price` int(10) unsigned DEFAULT NULL COMMENT '商品的价格',
  `name` varchar(30) DEFAULT NULL COMMENT '商品名称',
  `extra` text COMMENT '商品的其他属性如颜色，型号等',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_index` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
```
该类已经封装了：

	1.插入商品的方法
	2.获取所有商品的方法
	3.通过id索引查找商品的价格
	
##订单模型

该模型类对应的表为：

```sql
SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `rt_test_order`
-- ----------------------------
DROP TABLE IF EXISTS `rt_test_order`;
CREATE TABLE `rt_test_order` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) DEFAULT NULL COMMENT '订单号',
  `pay_type` tinyint(1) unsigned DEFAULT NULL COMMENT '支付方式1代表支付宝支付2代表微信支付',
  `pay_status` tinyint(1) unsigned DEFAULT '0' COMMENT '订单支付状态',
  `token` varchar(50) DEFAULT NULL COMMENT '根据订单号生成的唯一token索引',
  `total_price` int(10) DEFAULT NULL COMMENT '订单总价',
  `order_info` text COMMENT '订单详情',
  `good_id` int(50) DEFAULT NULL COMMENT '商品的id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `token_index` (`token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
```
该类已经封装了：

	1.生成订单方法，订单生成规则，通过商品的id+'00'来作为路由区分码，比如一个商品的id为1那么这个商品所产生的订单号都为100打头，商品id为4那么生成的订单号为400打头，订单的token标识了订单的唯一信息，在支付的时候，为了保证系统的安全性，在浏览器端不采用明文的形式传递订单信息，使用加密后的token处理
	2.通过订单token查询订单信息
	
##用户模型

该模型类对应的表为：

```sql
SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `b_uc_user`
-- ----------------------------
DROP TABLE IF EXISTS `b_uc_user`;
CREATE TABLE `b_uc_user` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(100) DEFAULT NULL COMMENT '根据用户的唯一信息生成的唯一索引',
  `phone` char(11) DEFAULT NULL COMMENT '用户手机号',
  `email` varchar(50) DEFAULT NULL COMMENT '用户的email',
  `password` varchar(100) DEFAULT NULL COMMENT '加盐密码',
  `salt` varchar(100) DEFAULT NULL COMMENT '密码盐值',
  `nick_name` varchar(50) CHARACTER SET utf16 DEFAULT NULL COMMENT '用户账户名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_index` (`phone`) USING BTREE,
  UNIQUE KEY `uuid_index` (`uuid`) USING BTREE,
  UNIQUE KEY `email_index` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
```
该类已经封装了：

	1.新增用户：在新增用户的时候会对用户的密码加盐取哈希，会在数据库中记录腌制过的哈希密码和盐值
	2.通过索引获取用户信息：索引的类型为用户的email,phone,uuid
	3.生成uuid方法

##钩子

为了统一管理控制器和模型，所有开发者编写的控制以及模型请在config/soco\_controllers.php 和 config/soco\_models.php下进行注册，这里使用CI框架里面的钩子类预埋在所有控制器调用之前对模型和控制器文件夹进行扫描，如果没有注册的控制器或者模型会报错
##接口调用规则：

每调用soco平台下接口，请在每个调用的uri后面加入参数timestamp(时间戳)和sign(签名)
##签名算法：

首先将所需要请求的post参数全部使用字典序排序，并且使用&key=value的形式进行字符串拼接得到字符串tmp\_string，然后把soco平台接口调用token(开发者请联系管理员索取)和当前时间戳timestamp和tmp\_string进行字符串拼接然后进行sha1加密得到签名sign

* 举例如下：
假如你要请求的url为http://xxxxx.soco.com/index/login，你的请求POST参数为
	
		{
			account: 18810101010,
			password: xxxxxxxxx
		}
	第一步：你需要将这个请求的参数数组字典排序，并且把每个参数进行&key=value的字符串拼接，得到结果（以下称为tmp_str）如下：
		
		&account=18810101010&password=xxxxxxxxx
	第二步：把config/soco.php中的开发者token（假设为xyz123），和当前的时间戳（假设为123456）字符串（tmp_str）拼接得到字符串使用sha1加密得到签名sign（以下称为sign_str）：
	
		sign_str = sha1(xyz123123456&account=18810101010&password=xxxxxxxxx)
	第三步：在你要请求的/index/login后面加上querystring，所以最终你要请求的url为：
	
		http://xxxxx.soco.com/index/login?timestamp=123456&sign=sign_str（刚才sha1获得的sign_str）
	
		
 