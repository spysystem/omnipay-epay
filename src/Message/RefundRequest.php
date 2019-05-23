<?php
namespace Omnipay\EPay\Message;

use EPay\credit;
use EPay\Payment;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;
use SoapFault;

/**
 * Class RefundRequest
 * @package Omnipay\EPay\Message
 */
class RefundRequest extends AbstractRequest
{
	/**
	 * @return array
	 * @throws InvalidRequestException
	 */
	public function getData(): array
	{
		$this->validate('merchantnumber', 'transactionReference', 'amount');

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
	 * @throws SoapFault
	 */
	public function sendData($mData): ResponseInterface
	{
		$oRefund	= new credit($mData['merchantnumber'], $mData['transactionReference'], $mData['amount'], null, null);

		if($mData['pwd'] !== null)
		{
			$oRefund->setPwd($mData['pwd']);
		}

		$oRequest	= new Payment();
		$oResponse	= $oRequest->credit($oRefund);

		return new RefundResponse($this, $oResponse);
	}
}