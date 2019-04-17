<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trade extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	$this->load->model('Trade_model');
	}

	public function get_list() {
		$result = $this->Trade_model->get_list();
		echo json_encode(array('ret' => true, 'data' => $result ));
	}

	public function get_search_list() {
		$keyword = $this->input->post('keyword', TRUE);
		$result = $this->Trade_model->get_search_list($keyword);
		if (count($result) > 0) {
			echo json_encode(array('ret' => true, 'data' => $result ));
		}else {
			echo json_encode(array('ret' => false));
		}
		
	}

	public function check_location_valid() {
		$latitude = $this->input->post('latitude', TRUE);
		$longitude = $this->input->post('longitude', TRUE);
		if(!$latitude || !$longitude) {return;}
		$result = $this->Trade_model->get_around_points($latitude, $longitude);
		$points_num = count($result);
		if ($points_num > 0) {
			echo json_encode(array('ret' => false));
		}else {
			echo json_encode(array('ret' => true));
		}
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

    public function get_item() {
    	$id = $this->input->post('id', TRUE);
    	if (!!$id) {
    		$result = $this->Trade_model->get_item($id);
    		echo json_encode(array('ret' => true, 'data' => $result));
    	}else {
    		echo json_encode(array('ret' => false, 'data' => array()));
    	}
    }

	public function add_item() {
		$address = $this->input->post('address', TRUE);
		$latitude = $this->input->post('latitude', TRUE);
		$longitude = $this->input->post('longitude', TRUE);
		$message = $this->input->post('message', TRUE);
		$contact = $this->input->post('contact', TRUE);
		$type = $this->input->post('type', TRUE);
		$openid = $this->input->post('openid', TRUE);

		if (!$latitude || !$longitude || !$message || !$contact || !$type) {
			echo json_encode(array('ret' => false, 'data' => array()));
			return;
		}

		if ($type !== 'sell' && $type !== 'buy') {
			echo json_encode(array('ret' => false, 'data' => array()));
			return;
		}

		$data = array(
			'address' => $address,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'message' => $message,
			'contact' => $contact,
			'type' => $type,
			'openid' => $openid 
		);

		$area_info = json_decode(
			$this->curl_get("http://api.map.baidu.com/geocoder/v2/?ak=D0ba2606b334fb2565df2646e9f8a479&location=$latitude,$longitude&output=json")
		);

		if ($area_info && $area_info->result && $area_info->result->addressComponent) {
			$zone_info = $area_info->result->addressComponent;
			if (!$data['address']) {
				$data['address'] = $area_info->result->formatted_address.'('.$area_info->result->sematic_description.')';
			}
			$data['province'] = $zone_info->province;
			$data['city'] = $zone_info->city;
			$data['district'] = $zone_info->district;
		}

		if($this->Trade_model->add_item($data)){
			echo json_encode(array('ret' => true, 'data' => array()));
		}else{
			echo json_encode(array('ret' => false, 'data' => array()));
			return;
		}
	}

}

