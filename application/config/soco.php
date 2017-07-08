<?php
$config['soco'] = array(
	'server_path' => '/soco/back-end', // 除去域名之后的二三级目录，请开发者注意配置正确，确保该目录下可以直接访问到index.php
	'use_table_prefix' => true, // 在注册模型的时候如果需要使用带前缀的表名注册，请设置为true
	'token' => 'supersoco', // 在调用soco平台时安全签名的秘密口令
	'https_request' => array( // soco_helper.php里面的__HttpRequest()方法如果在使用https请求的时候，需要配置ssl证书的路径
		'sslcert_path' => '路径地址',
		'sslkey_path' => '路径地址',
		'rootca_path' => '路径地址',
	),
	'doc_admin' => array( // 文档自动生成的管理员账号和密码
		'name' => 'admin',
		'password' => 'admin@soco',
	),
	'wechat_pay' => array( // 微信支付的相关配置
		'mch_id' => '1385373702',
		'notify' => '',
		'app_id' => 'wx898f13df6bf0ea41',
		'app_secret' => '8318b4d4511c90f8ba963e0b5a8b74d3',
		'sslcert_path' => '/www/code/soco/back-end/application/libraries/cert/apiclient_cert.pem',
		'sslkey_path' => '/www/code/soco/back-end/application/libraries/cert/apiclient_key.pem',
		'pay_key' => '1qazxsw23edcvfr45tgbnhy67ujmki89',
	),
	'redis' => array( // redis主机端口相关配置
		'host' => '127.0.0.1',
		'port' => 6379,
	),
	'allowed_ip' => array( // IP白名单，不在此名单里的访问会通过CI框架的钩子类方法被拒绝
		'127.0.0.1',
		'192.168.0.44',
		'192.168.0.26',
		'192.168.0.28',
	),
);
?>