<?php
namespace Omnipay\EPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class LinkRequest
 * @package Omnipay\EPay\Message
 */
class LinkRequest extends AbstractRequest
{
	/**
	 * @return array
	 * @throws InvalidRequestException
	 */
	public function getData(): array
	{
		$this->validate('merchantnumber', 'currency', 'amount');

		$this->setAmount($this->getAmountInteger());
		$this->setHash();
		return $this->parameters->all();
	}

	/**
	 * @param mixed $mData
	 * @return ResponseInterface
	 */
	public function sendData($mData): ResponseInterface
	{
		return new LinkResponse($this, $mData);
	}
}