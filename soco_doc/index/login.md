# login

##  URL
    http://127.0.0.1/soco/back-end/index.php/index/login

##  支持格式
    json

##  HTTP请求方式
    post

##  是否需要登录
    false

##  请求参数
| 字段                     |   必选            |   类型及范围    | 说明                               |
|:-------------------------|:----------------- |:----------------|:-----------------------------------|
|account|true|string|用户的手机号或者邮箱|
|password|true|string|用户密码|


##  请求示例
```json
{
    account : 188xxxxxxxx,
	password : 123qweasd,
}
```

##  注意事项
    

##  返回结果
```json
{
    code : 100200,
	msg : 登录成功,
	data : 用户的数据,
}
```

##  返回字段说明
| 字段                     |   类型           | 说明                               |
|:-------------------------|:-----------------|:-----------------------------------|
||string|返回json数据|


### 系统信息
- method_attribute：public
- fileName：/www/code/soco/back-end/application/controllers/index.php
- startLine：45
- endLine：70
- sys_info：该方法占用24行, 代码块优化的比较好!
