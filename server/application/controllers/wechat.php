<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wechat extends CI_Controller {

	public function __construct() {
    	parent::__construct();
	}

	private function curl_get($url){
        $testurl = $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $testurl);
        //参数为1表示传输数据，为0表示直接输出显示。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //参数为0表示不带头文件，为1表示带头文件
        curl_setopt($ch, CURLOPT_HEADER,0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

	public function get_user_info() {
		$code = $this->input->post('code', TRUE);

		if (!$code) {
			echo json_encode(array('ret' => false, 'data' => array()));
			return;
		}

		$result = json_decode(
			$this->curl_get("https://api.weixin.qq.com/sns/jscode2session?appid=wxeb8c70d2f9b9d1d3&secret=36f62742513b979e0927217f7aa06caa&js_code=$code&grant_type=authorization_code")
		);

		if (isset($result->openid)) {
			echo json_encode(array('ret' => true, 'data' => $result));
		}else{
			echo json_encode(array('ret' => false, 'data' => array()));
		}

	}

}
