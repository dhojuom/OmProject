<?php
	class Sedan extends Car
	{
		private $name = "SEDAN";
		private $model_name;
		private $mileage;
		private $capacity;
		private $length;

		public function set_model_name($name)
		{
			$this->model_name = $name; 
		}

		public function set_model_mileage($mileage)
		{
			$this->mileage = $mileage;
		}

		public function set_model_length($length)
		{
			$this->length = $length;
		}

		public function set_model_capacity($capacity)
		{
			$this->capacity = $capacity;
		}		

		public static function create_sedan($data)
		{
			$sedan = static::create();
			$sedan->model_name = $data['model_name'];
			$sedan->model_mileage = $data['mileage'];
			$sedan->model_length = $data['length'];
			$sedan->model_capacity = $data['capacity'];
			
			return $sedan;

		}
	}

?>