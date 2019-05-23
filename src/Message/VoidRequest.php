<?php
namespace Omnipay\EPay\Message;

use EPay\delete;
use EPay\Payment;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;
use SoapFault;

/**
 * Class VoidRequest
 * @package Omnipay\EPay\Message
 */
class VoidRequest extends AbstractRequest
{
	/**
	 * @return array
	 * @throws InvalidRequestException
	 */
	public function getData(): array
	{
		$this->validate('merchantnumber', 'transactionReference');

		return [
			'merchantnumber'		=> $this->getMerchantnumber(),
			'transactionReference'	=> $this->getTransactionReference(),
			'pwd'					=> $this->getPwd()
		];
	}

	/**
	 * @param mixed $mData
	 * @return ResponseInterface
	 * @throws SoapFault
	 */
	public function sendData($mData): ResponseInterface
	{
		$oDelete	= new delete($mData['merchantnumber'], $mData['transactionReference'], null);

		if($mData['pwd'] !== null)
		{
			$oDelete->setPwd($mData['pwd']);
		}

		$oRequest	= new Payment();
		$oResponse	= $oRequest->delete($oDelete);

		return new VoidResponse($this, $oResponse);
	}
}