<?php
namespace Omnipay\EPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class LinkResponse extends AbstractResponse
{
	private const Endpoint_Base			= 'https://ssl.ditonlinebetalingssystem.dk/integration/ewindow/Default.aspx?';
	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful(): bool
	{
		return true;
	}

	public function getRedirectUrl(): string
	{
		$arrData	= $this->getData();
		$strQueryString	= '';
		foreach($arrData as $strKey => $oValue)
		{
			if(strlen($strQueryString) === 0)
			{
				$strQueryString .= $strKey.'='.$oValue;
			}
			else
			{
				$strQueryString .= '&'.$strKey.'='.$oValue;
			}
		}

		return	self::Endpoint_Base . $strQueryString;
	}
}