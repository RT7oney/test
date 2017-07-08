<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
 */

/**
 * --------------------------------------------------------------------
 * 检查ip白名单
 * --------------------------------------------------------------------
 *
 * @author Ryan <ryantyler423@gmail.com>
 */
$hook['pre_system'] = function () {
	require 'soco.php';
	function ip() {
		static $realIP = '';
		if (isset($_SERVER)) {
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
				$realIP = $_SERVER["HTTP_X_FORWARDED_FOR"];
			} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
				$realIP = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$realIP = $_SERVER["REMOTE_ADDR"];
			}
		} else {
			if (getenv("HTTP_X_FORWARDED_FOR")) {
				$realIP = getenv("HTTP_X_FORWARDED_FOR");
			} else if (getenv("HTTP_CLIENT_IP")) {
				$realIP = getenv("HTTP_CLIENT_IP");
			} else {
				$realIP = getenv("REMOTE_ADDR");
			}
		}
		return $realIP;
	}
	if (!DEBUG) {
		if (!in_array(ip(), $config['soco']['allowed_ip'])) {
			die('您不在允许的ip里面');
		}
	}
};

/**
 * --------------------------------------------------------------------
 * 检查模型和控制器是否注册合法
 * --------------------------------------------------------------------
 *
 * @author Ryan <ryantyler423@gmail.com>
 */
$hook['pre_controller'] = function () {
	require 'soco_models.php';
	require 'soco_controllers.php';
	function search($array, $v) {
		$data = array();
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$result = search($value, $v);
				if (!empty($result)) {
					$data[$key] = $result;
				}
			} else {
				if ($value == $v) {
					$data[$key] = $v;
				}
			}
		}
		return $data;
	}
	function pre_check($params, $type, $config) {
		foreach ($params as $k => $val) {
			if (!in_array($val, $config[$type]['ignore'])) {
				$val = str_replace('.php', '', $val);
				if (!search($config[$type]['register'], $val)) {
					die(($type == 'soco_models' ? '模型' : '控制器') . '文件' . $val . '尚未注册');
				}
			}
		}
	}
	$mods = scandir(APPPATH . 'models/');
	pre_check($mods, 'soco_models', $config);
	$ctrs = scandir(APPPATH . 'controllers/');
	pre_check($ctrs, 'soco_controllers', $config);
};

/**
 * --------------------------------------------------------------------
 * 检查控制器是否继承合法
 * --------------------------------------------------------------------
 *
 * @author Ryan <ryantyler423@gmail.com>
 */
$hook['post_controller_constructor'] = function () {
	require 'soco.php';
	require 'soco_controllers.php';
	$path_info = str_replace($config['soco']['server_path'], '', $_SERVER['REQUEST_URI']);
	preg_match('/\/([^\/]*)\//', $path_info, $ctr);
	$classes = get_declared_classes();
	foreach ($classes as $k => $class) {
		$lower_class = strtolower($class);
		if ($lower_class == $ctr[1]) {
			if (!in_array($class . '.php', $config['soco_controllers']['ignore'])) {
				if (get_parent_class($class) !== 'Soco_Controller') {
					die('没有继承SocoCtr基础控制器，请联系该控制器开发者');
				}
			}
		}
	}
};
