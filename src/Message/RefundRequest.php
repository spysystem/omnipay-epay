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
		$this->validate('merchantnumber', 'transactionReference', 'amount');

		return [
			'merchantnumber'		=> $this->getMerchantnumber(),
			'transactionReference'	=> $this->getTransactionReference(),
			'amount'				=> $this->getAmountInteger(),
			'pwd'					=> $this->getPwd()
		];
	}

	public function sendData($data): ResponseInterface
	{
		$oRefund	= new credit($data['merchantnumber'], $data['transactionReference'], $data['amount'], null, null);

		if($data['pwd'] !== null)
		{
			$oRefund->setPwd($data['pwd']);
		}

		$oRequest	= new Payment();
		$oResponse	= $oRequest->credit($oRefund);

		return new RefundResponse($this, $oResponse);
	}
}