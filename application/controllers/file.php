<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 * 文件系统控制器
 * @author Ryan <ryantyler423@gmail.com>
 * @group(name="business", description="文件控制器")
 */
class file extends Soco_Controller {

	function __construct() {
		parent::__construct();
		$this->__RegCtr(__CLASS__, 0); // 注册该控制器是否需要用户登录
	}

	/**
	 * @ApiDescription(section="upimg", method="post", description="上传base64编码图片")
	 * @ApiRoute(name="/file/upimg")
	 * @ApiSuccess(value="{'code':'400100','msg':'图片保存成功','data':'数据'}")
	 * @ApiExample(value="{'name':'test','file':'data:image/png;base64,/9j/4AAQSkZJRxxxxxxxx'}")
	 * @ApiParams(name="file", type="string", is_selected=true, description="图片的base64编码")
	 * @ApiParams(name="name", type="string", is_selected=true, description="图片名称")
	 * @ApiReturn(name="code", type="integer", description="接口返回码")
	 * @ApiReturn(name="msg", type="string", description="接口返回信息")
	 * @ApiReturn(name="data", type="array", description="接口返回数据")
	 */
	public function upimg() {
		// 上传文件测试
		if ($this->input->post('file') && $this->input->post('name')) {
			$name = __SaveImg($this->input->post('file'), $this->input->post('name'));
			if ($name) {
				$this->__Response(100, '图片保存成功', $name);
			} else {
				$this->__Response(102, '保存失败');
			}
		} else {
			$this->__Response(101, '参数不完整');
		}
	}

	/**
	 * @ApiDescription(section="arr2xls", method="post", description="把数组转化为excel中的.xls格式文件")
	 * @ApiRoute(name="/file/arr2xls")
	 * @ApiSuccess(value="{'code':'400200','msg':'数组转化成excel成功', 'data' : '数据'}")
	 * @ApiExample(value="{'name':'测试','head':'array(手机号,积分)','data':'array(array(phone=>123123123),array(phone=>1231235453),array(phone=>123123234233),array(phone=>142624624623),)'}")
	 * @ApiParams(name="name", type="string", is_selected=true, description="excel保存后的名称")
	 * @ApiParams(name="head", type="array", is_selected=true, description="要保存的xls的首行标题")
	 * @ApiParams(name="data", type="array", is_selected=true, description="要保存的xls的数据")
	 * @ApiReturn(name="code", type="integer", description="接口返回码")
	 * @ApiReturn(name="msg", type="string", description="接口返回信息")
	 * @ApiReturn(name="data", type="array", description="接口返回数据")
	 */
	public function arr2xls() {
		if ($this->input->post('head') && $this->input->post('data') && $this->input->post('name')) {
			$this->load->library('ExcelTool');
			$name = $this->exceltool->writeExcel($this->input->post('head'), $this->input->post('data'), $this->input->post('name'));
			if ($name) {
				$this->__Response(200, '数组转化成excel成功', $name);
			} else {
				$this->__Response(201, '失败');
			}
		} else {
			$this->__Response(201, '参数不完整');
		}
	}

	/**
	 * @ApiDescription(section="xls2arr", method="post", description="上传xls转化成数组")
	 * @ApiRoute(name="/file/xls2arr")
	 * @ApiSuccess(value="{'code':'400300','msg':'excel转化成数组成功','data':'数据'}")
	 * @ApiExample(value="{'file':'文件'}")
	 * @ApiParams(name="file", type="file", is_selected=true, description=".xls文件")
	 * @ApiReturn(name="code", type="integer", description="接口返回码")
	 * @ApiReturn(name="msg", type="string", description="接口返回信息")
	 * @ApiReturn(name="data", type="array", description="接口返回数据")
	 */
	public function xls2arr() {
		$tmp = $_FILES['file']['tmp_name'] ? $_FILES['file']['tmp_name'] : $_POST['file']['name'];
		if ($tmp) {
			$this->load->library('ExcelTool');
			$data = $this->exceltool->readExcel($tmp);
			if ($data) {
				$this->__Response(300, 'excel转化成数组成功', $data);
			} else {
				$this->__Response(302, '失败');
			}
		} else {
			$this->__Response(301, '请求参数有误');
		}
	}

	/**
	 * @ApiDescription(section="down", method="get", description="下载application/data文件夹下面的文件")
	 * @ApiRoute(name="/file/down")
	 * @ApiSuccess(value="文件会直接下载")
	 * @ApiExample(value="")
	 * @ApiParams(name="type", type="string", is_selected=true, description="如果是图片文件请填写（image）如果是excel文件请填写（excel）")
	 * @ApiParams(name="name", type="string", is_selected=true, description="通过上传图片接口upimg和arr2xls接口得到的文件名称，需要带上扩展名如：.xls和.png")
	 * @ApiReturn()
	 * @ApiNotice(description="")
	 */
	public function down() {
		$filename = APPPATH . 'data/' . $this->input->get('type') . '/' . $this->input->get('name');
		if ($this->input->get('type') == 'image') {
			header('Content-type: image/png');
			header("Content-Disposition: attachment; filename=$filename");
			@readfile($filename);
		} elseif ($this->input->get('type') == 'excel') {
			$file = fopen($filename, "r");
			Header("Content-type:application/octet-stream");
			Header("Accept-Ranges:bytes");
			header("Content-Type:application/msexcel");
			Header("Accept-Length:" . filesize($filename));
			Header("Content-Disposition:attachment;filename=$filename");
			echo fread($file, filesize($filename));
			fclose($file);
		}
	}

}
?>