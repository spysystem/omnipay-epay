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
		$this->validate('merchantnumber', 'currency', 'amount');

		$this->setHash();
		return $this->parameters->all();
	}

	public function sendData($data): ResponseInterface
	{
		return new LinkResponse($this, $data);
	}
}