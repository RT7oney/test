<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>速珂订单测试</title>
    <script type="text/javascript">
    //调用微信JS api 支付
    function jsApiCall() {
        WeixinJSBridge.invoke(
            "getBrandWCPayRequest",
            "<?php echo $jsApiParameters; ?>",
            function(res) {
                WeixinJSBridge.log(res.err_msg);
                // alert(res.err_code+res.err_desc+res.err_msg);
            }
        );
    }

    function callpay() {
        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                document.addEventListener("WeixinJSBridgeReady", jsApiCall, false);
            } else if (document.attachEvent) {
                document.attachEvent("WeixinJSBridgeReady", jsApiCall);
                document.attachEvent("onWeixinJSBridgeReady", jsApiCall);
            }
        } else {
            jsApiCall();
        }
    }
    </script>
</head>

<body>
    <div align="center" style="margin-top: 20%;line-height: 2.5em">
    <font color="#000"><b>订单号：<font style="color:#000"><?php echo $order_id; ?></font><br/>待支付：<span style="color:#ff9100;font-size:26px">￥<?php echo $total_price; ?></span></b></font>
        <br/>
        <br/>
    </div>
    <div align="center">
    <button style="width:250px; height:50px; border-radius: 5px;background: #2f9833 url('') center no-repeat ;background-size:contain;border:0px #2f9833 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()"><img src="<?php echo base_url('assets/img/wxlogo.png'); ?>" width="40" height="40"><span style="position: relative;display: inline-block;bottom: 14px;">立即支付</span></button>
    </div>
</body>

</html>
