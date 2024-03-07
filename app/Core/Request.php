<?php 
	class Request{
		public function is_post():bool{
			if($_SERVER['REQUEST_METHOD'] == "POST" && count($_POST) > 0){
				return true;
			}
			return false;
		}

		public function is_get():bool {
			if($_SERVER['REQUEST_METHOD'] == "GET" && count($_GET) > 0){
				return true;
			}
			return false;
		}

		public function get_value_post(string $key = '', mixed $default = ''):mixed{
			if(empty($key)){
				return $_POST;
			}elseif(isset($_POST[$key])){
				return $_POST[$key];
			}
			return $default;
		}
	}