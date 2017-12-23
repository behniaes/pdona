<?php

	//connect and modify database class
	class pdona
	{
		private $_url,$_user,$_pass,$_name,$_handler;
		//class constructor
		function __construct($dburl, $dbport, $dbuser, $dbpass, $dbname){
			$this->_url = $dburl.':'.$dbport;
			$this->_user = $dbuser;
			$this->_pass = $dbpass;
			$this->_name = $dbname;
			$this->_connect();
		}
		//connect to database private method
		private function _connect(){
			$this->_handler = new PDO("mysql:host=".$this->_url.";dbname=".$this->_name.";charset=utf8", $this->_user, $this->_pass);
		}
		//perform a sql query private method
		private function _query($query, $params = []){
			$stmt = $this->_handler->prepare($query);
			$stmt->execute($params);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		//perform a sql query and fetch result in return public method
		public function _run($query, $params = [], $json = false){
			$result = $this->_query($query, $params);
			if(is_bool($result)){
				return $result;
			} else {
				if($json){
					return json_encode($result);
				} else {
					return $result;
				}
			}
		}
		//disconnect from database public method
		public function _dconnect(){
			$this->_handler = NULL;
		}
	}

?>
