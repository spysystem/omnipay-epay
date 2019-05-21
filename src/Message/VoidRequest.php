<?php
namespace Omnipay\EPay\Message;

use EPay\delete;
use EPay\Payment;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class VoidRequest
 * @package Omnipay\EPay\Message
 */
class VoidRequest extends AbstractRequest
{
	public function getData()
	{
		$this->validate('merchantnumber', 'transactionReference');

		return [
			'merchantnumber'		=> $this->getMerchantnumber(),
			'transactionReference'	=> $this->getTransactionReference(),
			'pwd'					=> $this->getPwd()
		];
	}

	public function sendData($data): ResponseInterface
	{
		$oDelete	= new delete($data['merchantnumber'], $data['transactionReference'], null);

		if($data['pwd'] !== null)
		{
			$oDelete->setPwd($data['pwd']);
		}

		$oRequest	= new Payment();
		$oResponse	= $oRequest->delete($oDelete);

		return new VoidResponse($this, $oResponse);
	}
}