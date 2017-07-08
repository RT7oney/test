# upimg

##  URL
    http://127.0.0.1/soco/back-end/index.php/file/upimg

##  支持格式
    json

##  HTTP请求方式
    post

##  是否需要登录
    false

##  请求参数
| 字段                     |   必选            |   类型及范围    | 说明                               |
|:-------------------------|:----------------- |:----------------|:-----------------------------------|
|file|true|string|图片的base64编码|
|name|true|string|图片名称|


##  请求示例
```json
{
    name : test,
	file : data:image/png;base64,/9j/4AAQSkZJRxxxxxxxx,
}
```

##  注意事项
    

##  返回结果
```json
{
    code : 400100,
	msg : 图片保存成功,
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
- startLine：28
- endLine：40
- sys_info：该方法占用11行, 代码块优化的很好!
