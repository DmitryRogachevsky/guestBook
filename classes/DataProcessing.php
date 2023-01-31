<?php

class DataProcessing{

	public function __construct(){
		self::sendDataFromFormByDB();
	}
	public static function sendDataFromFormByDB(){
        $params = [
            'user_name' => '',
            'message'   => '',
        ];
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$params['user_name'] = trim(strip_tags($_POST['user_name']));
			$params['message'] = trim(strip_tags($_POST['message']));
			
		}	
		return $params;
	}

	public static function getData(){
		return Database::getDataFromDB();
	}

	public static function sortData($order){
        $dataArray = self::getData();
		foreach($dataArray as $key => $value)
		{
			$date[$key] = $value['date'];
		}
		if($order == 'desc')
			array_multisort($date, SORT_DESC, $dataArray);
		if($order == 'asc')
			array_multisort($date, SORT_ASC, $dataArray);
		return $dataArray;
	}

}