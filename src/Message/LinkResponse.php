<?php
namespace Omnipay\EPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class LinkResponse extends AbstractResponse
{
	private const Endpoint_Base			= 'https://ssl.ditonlinebetalingssystem.dk/integration/ewindow/Default.aspx?merchantnumber=';
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
		$strUrl		= self::Endpoint_Base;
		$arrData	= $this->getData();

		$strUrl .= $arrData['merchant_number'].'&amount='.$arrData['amount'].'&currency='.$arrData['currency'].'&windowstate=3';

		return	$strUrl;
	}
}