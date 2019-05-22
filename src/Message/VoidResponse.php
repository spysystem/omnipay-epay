<?php
namespace Omnipay\EPay\Message;

use EPay\deleteResponse;
use Omnipay\Common\Message\AbstractResponse;

/**
 * Class VoidResponse
 * @package Omnipay\EPay\Message
 */
class VoidResponse extends AbstractResponse
{

	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful(): bool
	{
		return $this->getResponse()->getDeleteResult();
	}

	/**
	 * @return deleteResponse
	 */
	public function getResponse(): deleteResponse
	{
		return $this->data;
	}

	/**
	 * @return int|null
	 */
	public function getEPayErrorCode(): ?int
	{
		return $this->getResponse()->getEpayresponse();
	}
}