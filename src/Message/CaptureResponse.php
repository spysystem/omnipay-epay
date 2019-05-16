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

	public function getResponse(): \EPay\WebService\captureResponse
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

		if($iErrorCode === 0 && $oResponse->getPbsResponse() !== null)
		{
			return $oResponse->getPbsResponse();
		}

		return $iErrorCode;
	}
}