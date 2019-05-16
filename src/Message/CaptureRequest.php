<?php
namespace Omnipay\EPay\Message;

use EPay\capture;
use EPay\Payment;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class CaptureRequest
 * @package Omnipay\EPay\Message
 */
class CaptureRequest extends AbstractRequest
{
	/**
	 * @return array
	 * @throws InvalidRequestException
	 */
	public function getData(): array
	{
		$this->validate('merchantnumber', 'transaction_reference', 'amount');

		return [
			'merchantnumber'		=> $this->getMerchantnumber(),
			'transaction_reference'	=> $this->getTransactionReference(),
			'amount'				=> $this->getAmountInteger(),
			'pwd'					=> $this->getPwd()
		];
	}

	public function sendData($data): ResponseInterface
	{
		$oCapture	= new capture($data['merchantnumber'], $data['transaction_id'], $data['amount'], null, null);

		if($data['pwd'] !== null)
		{
			$oCapture->setPwd($data['pwd']);
		}

		$oRequest	= new Payment();
		$oResponse	= $oRequest->capture($oCapture);

		return new CaptureResponse($this, $oResponse);
	}
}