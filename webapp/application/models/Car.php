<?php 

class Car extends ActiveRecord\Model
{
	private $wheels;
	private $side_mirrors; 
	private $doors;

	public function set_number_doors($door)
	{		
		$this->doors = $door;
	}

	public function set_wheels()
	{
		$this->wheels= 4;
	}

	public function set_side_mirrors()
	{
		$this->side_mirrors=2;
	}

	public static function create()
	{
		$car = new static;
		$car->set_number_doors(4);
		$car->wheels;
		$car->side_mirrors;
		return $car;
	}
}