<?php
/**
* Quaderno Invoice
*
* @package   Quaderno PHP
* @author    Quaderno <hello@quaderno.io>
* @copyright Copyright (c) 2015, Quaderno
* @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
*/

class QuadernoInvoice extends QuadernoDocument
{
	static protected $model = 'invoices';

	public function deliver()
	{
		return $this->execDeliver();
	}

	public function addPayment($payment)
	{
		return $this->execAddPayment($payment);
	}

	public function getPayments()
	{
		return $this->execGetPayments();
	}

	public function removePayment($payment)
	{
		return $this->execRemovePayment($payment);
	}
        
        public static function findByContact($contact_id)
	{
                $return = false;
		$class = get_called_class();
		$response = QuadernoBase::apiCall('GET', self::$model, '',array('contact'=>$contact_id));
                if (QuadernoBase::responseIsValid($response))
                {
                        $return = array();
                        $length = count($response['data']);
                        for ($i = 0; $i < $length; $i++)
                                $return[$i] = new $class($response['data'][$i]);
                }
                return $return;
	}
        
        public static function findLastInvoiceByContact($contact_id)
	{
                $return = false;
                $invoices = self::findByContact($contact_id);
                if(is_array($invoices)){
                    $return =  array_values($invoices)[0];
                }
                return $return;
	}
        
        public static function findInvoiceByChargeId($charge_id)
	{
                $return = false;
		$class = get_called_class();
                $model = 'stripe/charges';
		$response = QuadernoBase::apiCall('GET', $model, $charge_id);
                if (QuadernoBase::responseIsValid($response)) $return = new $class($response['data']);
                return $return;
	}
}
?>