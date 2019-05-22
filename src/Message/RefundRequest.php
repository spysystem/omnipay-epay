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
	 * @param mixed $data
	 * @return ResponseInterface
	 * @throws SoapFault
	 */
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