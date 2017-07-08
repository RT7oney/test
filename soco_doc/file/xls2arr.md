# xls2arr

##  URL
    http://127.0.0.1/soco/back-end/index.php/file/xls2arr

##  支持格式
    json

##  HTTP请求方式
    post

##  是否需要登录
    false

##  请求参数
| 字段                     |   必选            |   类型及范围    | 说明                               |
|:-------------------------|:----------------- |:----------------|:-----------------------------------|
|file|true|file|.xls文件|


##  请求示例
```json
{
    file : 文件,
}
```

##  注意事项
    

##  返回结果
```json
{
    code : 400300,
	msg : excel转化成数组成功,
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
- startLine：78
- endLine：91
- sys_info：该方法占用12行, 代码块优化的很好!
