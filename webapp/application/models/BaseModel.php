<?php 
	
	include_once('Exceptions.php');

	class BaseModel extends ActiveRecord\Model
	{
		

		public function set_is_active($bool)
		{
			$this->assign_attribute('is_active',$bool);
		}

		public function set_is_deleted($bool)
		{
			$this->assign_attribute('is_deleted',$bool);
		}

		public function check_deleted()
		{
			if($this->is_deleted)
			{	
				throw new ModelDeletedException("the model is deleted");
			}

			return;
		}

		public function check_is_active()
		{
			if(!$this->is_active)
			{
				throw new InactiveException("the model is inactive");
				
			}
			return;
		}

		public static function __callStatic($method, $args) {

			if (substr($method,0,17) == 'find_undeleted_by')
			{
				$method = 'find_by'.substr($method,17);

				$model = parent::__callStatic($method, $args);

				$model->check_is_deleted();

				return $model;
			}

			if(substr($method,0,14)=='find_active_by')
			{
				$method = 'find_by'.substr($method,14);
				$model = parent::__callStatic($method,$args);
				return $model;

			}

			if(substr($method,0,13)=='find_valid_by')
			{
				$method = 'find_by'.substr($method,13);
				$model = parent::__callStatic($method,$args);
				$model->check_is_active();
				return $model;	
			}


			$model = parent::__callStatic($method, $args);
			return $model;
		}



		

    	
	
	}
?>