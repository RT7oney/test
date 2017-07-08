# pay

##  URL
    http://127.0.0.1/soco/back-end/index.php/pay/pay

##  支持格式
    json

##  HTTP请求方式
    post

##  是否需要登录
    false

##  请求参数
| 字段                     |   必选            |   类型及范围    | 说明                               |
|:-------------------------|:----------------- |:----------------|:-----------------------------------|
|pay_type|true|integer|支付的方式0：支付宝pc端 1：支付宝m端 2：微信PC端扫码支付 3：微信内浏览器网页jsapi支付（会直接跳转出jspay_view.php的页面）|
|token|true|string|订单的token索引|


##  请求示例
```json
{
    pay_type : 2,
	token : xxxxxxxxxxxx,
}
```

##  注意事项
    

##  返回结果
```json
{
    code : 200200,
	msg : 操作成功,
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
- fileName：/www/code/soco/back-end/application/controllers/pay.php
- startLine：67
- endLine：104
- sys_info：该方法占用36行, 代码块优化的比较好!
