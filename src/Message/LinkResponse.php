<?php
namespace Omnipay\EPay\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class LinkResponse
 * @package Omnipay\EPay\Message
 */
class LinkResponse extends AbstractResponse
{
	private const Endpoint_Base			= 'https://ssl.ditonlinebetalingssystem.dk/integration/ewindow/Default.aspx?';
	private const FieldName_CallbackURL	= 'callbackurl';
	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful(): bool
	{
		return true;
	}

	/**
	 * @return string
	 */
	public function getRedirectUrl(): string
	{
		$arrData		= $this->getData();
		$arrParameters	= [];

		foreach($arrData as $strKey => $mValue)
		{
			if($strKey === self::FieldName_CallbackURL)
			{
				$mValue	= urlencode($mValue);
			}
			$arrParameters[]	= $strKey.'='.$mValue;
		}

		$strQueryString	= implode('&', $arrParameters);

		return	self::Endpoint_Base . $strQueryString;
	}
}