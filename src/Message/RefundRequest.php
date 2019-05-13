<?php
namespace Omnipay\EPay\Message;

use EPay\credit;
use EPay\Payment;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class RefundRequest
 * @package Omnipay\EPay\Message
 */
class RefundRequest extends AbstractRequest
{
	public function getData()
	{
		$this->validate('merchant_number', 'transaction_reference', 'amount');

		return [
			'merchant_number'		=> $this->getMerchantNumber(),
			'transaction_reference'	=> $this->getTransactionReference(),
			'amount'				=> $this->getAmountInteger(),
			'pwd'					=> $this->getPwd()
		];
	}

	public function sendData($data): ResponseInterface
	{
		$oRefund	= new credit($data['merchant_number'], $data['transaction_reference'], $data['amount'], null, null);

		if($data['pwd'] !== null)
		{
			$oRefund->setPwd($data['pwd']);
		}

		$oRequest	= new Payment();
		$oResponse	= $oRequest->credit($oRefund);

		return new RefundResponse($this, $oResponse);
	}
}