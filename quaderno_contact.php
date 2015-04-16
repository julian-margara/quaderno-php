<?php
/**
* Quaderno Contact
*
* @package   Quaderno PHP
* @author    Quaderno <hello@quaderno.io>
* @copyright Copyright (c) 2015, Quaderno
* @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
*/

class QuadernoContact extends QuadernoModel {
	static protected $model = 'contacts';
        
        public static function findByCustomerID($cutomer_id)
	{
                $return = false;
		$class = get_called_class();
                $model = 'stripe/customers';
		$response = QuadernoBase::apiCall('GET', $model, $cutomer_id);
                if (QuadernoBase::responseIsValid($response)) $return = new $class($response['data']);
                return $return;
	}
}
?>