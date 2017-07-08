# arr2xls

##  URL
    http://127.0.0.1/soco/back-end/index.php/file/arr2xls

##  支持格式
    json

##  HTTP请求方式
    post

##  是否需要登录
    false

##  请求参数
| 字段                     |   必选            |   类型及范围    | 说明                               |
|:-------------------------|:----------------- |:----------------|:-----------------------------------|
|name|true|string|excel保存后的名称|
|head|true|array|要保存的xls的首行标题|
|data|true|array|要保存的xls的数据|


##  请求示例
```json
{
    name : 测试,
	head : array(手机号,积分),
	data : array(array(phone=>123123123),array(phone=>1231235453),array(phone=>123123234233),array(phone=>142624624623),),
}
```

##  注意事项
    

##  返回结果
```json
{
    code : 400200,
	msg : 数组转化成excel成功,
	data : 数据,
}
```

##  返回字段说明
| 字段                     |   类型           | 说明                               |
|:-------------------------|:-----------------|:-----------------------------------|
|code|integer|接口返回码|
|msg|string|接口返回信息|
|data|array|接口返回数据|


### 系统信息
- method_attribute：public
- fileName：/www/code/soco/back-end/application/controllers/file.php
- startLine：54
- endLine：66
- sys_info：该方法占用11行, 代码块优化的很好!
