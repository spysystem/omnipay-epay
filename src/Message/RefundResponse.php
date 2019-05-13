<?php


namespace Omnipay\EPay\Message;


use EPay\creditResponse;
use Omnipay\Common\Message\AbstractResponse;

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

	public function getResponse(): creditResponse
	{
		return $this->data;
	}

	public function getErrorCode(): int
	{
		if($this->isSuccessful())
		{
			return 0;
		}

		$oResponse	= $this->getResponse();

		$iErrorCode	= $oResponse->getEpayresponse() ?? 0;

		if($iErrorCode === 0 && $oResponse->getPbsresponse() !== null)
		{
			return $oResponse->getPbsresponse();
		}

		return $iErrorCode;
	}
}