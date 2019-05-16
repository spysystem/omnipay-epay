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
		return	self::Endpoint_Base . http_build_query($this->getData());
	}
}