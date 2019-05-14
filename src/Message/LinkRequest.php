<?php
namespace Omnipay\EPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;

class LinkRequest extends AbstractRequest
{
	/**
	 * @return array|mixed
	 * @throws InvalidRequestException
	 */
	public function getData()
	{
		$this->validate('merchant_number', 'currency', 'amount');

		return [
			'merchant_number'	=> $this->getMerchantNumber(),
			'currency'			=> $this->getCurrency(),
			'amount'			=> $this->getAmountInteger(),
			'callback_url'		=> $this->getCallbackUrl()
		];
	}

	public function sendData($data): ResponseInterface
	{
		return new LinkResponse($this, $data);
	}
}