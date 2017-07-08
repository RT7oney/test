<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 * 控制器调用参考
 * @author Ryan <ryantyler423@gmail.com>
 * @group(name="business", description="短信服务控制器")
 */
class sms extends Soco_Controller {

	function __construct() {
		parent::__construct();
		$this->__RegCtr(__CLASS__, 0); // 注册该控制器是否需要用户登录
	}

	/**
	 * @ApiDescription(section="index", method="get", description="短信服务控制器")
	 * @ApiRoute(name="/sms/index")
	 * @ApiSuccess(value="{'code' : '500100', 'msg'  : '请求成功', 'data' : '这里是数据'}")
	 * @ApiParams(name="timestamp", type="string", is_selected=true, description="调用接口的时间戳")
	 * @ApiParams(name="sign", type="string", is_selected=true, description="调用接口的签名")
	 * @ApiReturn(name="", type="string", description="返回json数据")
	 */
	public function index() {
		echo 'this is sms controller <hr>';
		$this->__Response(100, '请求成功');
	}

}
?>