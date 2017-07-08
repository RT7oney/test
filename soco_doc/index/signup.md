# signup

##  URL
    http://127.0.0.1/soco/back-end/index.php/index/signup

##  支持格式
    json

##  HTTP请求方式
    post

##  是否需要登录
    false

##  请求参数
| 字段                     |   必选            |   类型及范围    | 说明                               |
|:-------------------------|:----------------- |:----------------|:-----------------------------------|
|phone|true|string|用户注册的手机号|
|email|true|string|用户注册的邮箱（手机号邮箱二选一可多选）|
|password|true|string|用户密码|
|nick_name|true|string|用户昵称|


##  请求示例
```json
{
    phone : 188xxxxxxxx,
	password : 123qweasd,
}
```

##  注意事项
    

##  返回结果
```json
{
    code : 100300,
	msg : 注册成功,
	data : 这里是数据,
}
```

##  返回字段说明
| 字段                     |   类型           | 说明                               |
|:-------------------------|:-----------------|:-----------------------------------|
||string|返回json数据|


### 系统信息
- method_attribute：public
- fileName：/www/code/soco/back-end/application/controllers/index.php
- startLine：83
- endLine：119
- sys_info：该方法占用35行, 代码块优化的比较好!
