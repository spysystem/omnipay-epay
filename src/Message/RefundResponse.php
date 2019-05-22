<?php
namespace Omnipay\EPay\Message;

use EPay\creditResponse;
use Omnipay\Common\Message\AbstractResponse;
/**
 * Class RefundResponse
 * @package Omnipay\EPay\Message
 */
class RefundResponse extends AbstractResponse
{

	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful(): bool
	{
		return $this->getResponse()->getCreditResult();
	}

	/**
	 * @return creditResponse
	 */
	public function getResponse(): creditResponse
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

	/**
	 * @return int|null
	 */
	public function getPbsErrorCode(): ?int
	{
		return $this->getResponse()->getPbsresponse();
	}
}