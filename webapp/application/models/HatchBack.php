<?php 

class HatchBack extends Car
{

	private $name = "HatchBack";
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

		public static function create_hatchback($data)
		{
			$HatchBack = static::create();
			$HatchBack->model_name = $data['model_name'];
			$HatchBack->model_mileage = $data['mileage'];
			$HatchBack->model_length = $data['length'];
			$HatchBack->model_capacity = $data['capacity'];
			return $HatchBack;
		}


}

?>