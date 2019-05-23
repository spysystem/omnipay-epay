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
		return [
			'merchantnumber'		=> $this->getMerchantnumber(),
			'transactionReference'	=> $this->getTransactionReference(),
			'amount'				=> $this->getAmountInteger(),
			'pwd'					=> $this->getPwd()
		];
	}

	/**
	 * @param mixed $mData
	 * @return ResponseInterface
	 * @throws \SoapFault
	 */
	public function sendData($mData): ResponseInterface
	{
		$oCapture	= new capture($mData['merchantnumber'], $mData['transactionReference'], $mData['amount'], 0, 0);

		if($mData['pwd'] !== null)
		{
			$oCapture->setPwd($mData['pwd']);
		}

		$oRequest	= new Payment();
		$oResponse	= $oRequest->capture($oCapture);

		return new CaptureResponse($this, $oResponse);
	}
}