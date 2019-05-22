<?php
namespace Omnipay\EPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class CaptureResponse extends AbstractResponse
{

	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful(): bool
	{
		return $this->getResponse()->getCaptureResult();
	}

	public function getResponse(): \EPay\captureResponse
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
		return $this->getResponse()->getPbsResponse();
	}
}